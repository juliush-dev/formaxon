<?php

namespace App\Http\Middleware;

use App\Enums\FormFieldType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ValidateFormFieldStoreRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        Gate::authorize('if_admin');
        $nextValidator = "{$request->string('type')}FieldValidator";
        $validator = $this->$nextValidator($request, $this->getCommonRules());
        $validator->validate();
        return $next($request);
    }

    private function getCommonRules()
    {
        return  [
            'type' => [
                'required',
                Rule::in(FormFieldType::values())
            ],
            'value_required' => ['nullable', 'boolean'],
            'field_visible_by_target' => 'nullable|boolean',
            'value_editable_by_target' => 'nullable|boolean',
            'checked' => 'nullable|boolean',
            'value_is_unique' => 'nullable|boolean',
            'value_is_reference' => 'nullable|boolean',
            'value_is_a_sets' => 'nullable|boolean',
            'code_name' => ['required', 'regex:/[a-z]+(_[a-z]+)*/s'],
            'label' => ['required', 'min:4'],
            'referenced_field_id' => 'nullable|required_with_all:value_is_reference|exists:form_fields,id',
            'default_value_ref_id' => 'nullable|required_with_all:referenced_field_id|exists:form_field_data',
            'value_min_length' => ['nullable', 'required_with_all:value_max_length', 'integer', 'lte:value_max_length'],
            'value_max_length' => ['nullable', 'required_with_all:value_min_length', 'integer', 'gte:value_min_length'],
        ];
    }

    protected function textFieldValidator(Request $request, $commonRules = [])
    {
        $validator = Validator::make($request->all(), $commonRules)
            ->sometimes('default_value', ['nullable', 'max:value_max_length'], function ($request) {
                return $request->has('value_max_length');
            })->sometimes('default_value', ['nullable', 'min:value_min_length'], function ($request) {
                return $request->has('value_min_length');
            });

        return $validator;
    }
    protected function emailFieldValidator(Request $request, $commonRules = [])
    {
        $validator = Validator::make($request->all(), $commonRules);
        return $validator;
    }
    protected function passwordFieldValidator(Request $request, $commonRules = [])
    {
        $validator = Validator::make($request->all(), $commonRules);
        return $validator;
    }
    protected function radioFieldValidator(Request $request, $commonRules = [])
    {
        $validator = Validator::make($request->all(), [...$commonRules, 'default_value' => 'required|regex:/[a-z]+(_[a-z]+)*/']);
        return $validator;
    }
    protected function checkboxFieldValidator(Request $request, $commonRules = [])
    {
        $commonRules['code_name'] = ['required', 'regex:/[a-z]+(_[a-z]+)*(\[\])?/'];
        $validator = Validator::make($request->all(), [
            ...$commonRules,
            'checked' => 'nullable|boolean'
        ]);
        return $validator;
    }
    protected function selectFieldValidator(Request $request, $commonRules = [])
    {
        $validator = Validator::make($request->all(), [
            ...$commonRules,
            'default_value_ref_ids' => 'nullable_with_all:referenced_field_id,value_is_a_sets|array',
            'default_value_ref_ids.*' => 'nullable_with_all:default_value_ref_ids|distinct|exists:form_field_data',
            'value_options' => 'nullable|prohibit:value_is_reference|prohibit:default_value_ref_ids|prohibit:default_value_ref_id|regex:/[a-z]+(_[a-z]+)*(,[a-z]+(_[a-z]+)*)*/',
            'default_value' => [
                'sometimes',
                'required_with_all:value_options',
                'prohibit:value_is_a_set',
                'prohibit:value_is_reference',
                Rule::in(explode(',', $request->string('value_options')))
            ],
            'default_value_set' => [
                'sometimes',
                'required_with_all:value_options,value_is_a_set',
                'prohibit:value_is_reference',
                'regex:/[a-z]+(_[a-z]+)*(,[a-z]+(_[a-z]+)*)*/'
            ],
            'default_value_set.*' => [
                Rule::in(explode(',', $request->string('value_options')))
            ],
            'default_value_set' => 'nullable_with_all:value_options,value_is_a_set|array',
            'default_value_set.*' => 'nullable_with_all:value_options|in_array:value_options|max:value_options|min:1',
        ]);
        return $validator;
    }
}