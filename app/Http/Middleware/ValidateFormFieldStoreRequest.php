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
    const VALUE_OPTIONS_PATTERN_RULE = "regex:/^(\b\w+\b)(\s+\b\w+\b)*(,\s*\b\w+\b(\s+\b\w+\b)*)*$/";
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
            'label' => ['required'],
            'value_required' => ['nullable', 'boolean'],
            'field_visible_by_target' => 'nullable|boolean',
            'value_editable_by_target' => 'nullable|boolean',
            'value_is_unique' => 'nullable|boolean',
        ];
    }

    protected function textFieldValidator(Request $request, $commonRules = [])
    {
        $validator = Validator::make($request->all(), [
            ...$commonRules,
            'value_min_length' => ['nullable', 'required_with_all:value_max_length', 'integer', 'lte:value_max_length'],
            'value_max_length' => ['nullable', 'required_with_all:value_min_length', 'integer', 'gte:value_min_length'],
        ])
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
        $validator = Validator::make($request->all(), [
            ...$commonRules,
            'value_min_length' => [
                'required',
                'lte:value_max_length'
            ],
            'value_max_length' => [
                'required',
                'gte:value_min_length'
            ],
        ]);
        return $validator;
    }
    protected function numberFieldValidator(Request $request, $commonRules = [])
    {
        $validator = Validator::make($request->all(), [
            ...$commonRules,
            'value_min_length' => [
                'required',
                'lte:value_max_length'
            ],
            'value_max_length' => [
                'required',
                'gte:value_min_length'
            ],
        ]);
        return $validator;
    }
    protected function radioFieldValidator(Request $request, $commonRules = [])
    {
        $validator = Validator::make(
            $request->all(),
            [
                ...$commonRules,
                'value_options' => [
                    'required',
                    self::VALUE_OPTIONS_PATTERN_RULE
                ],
                'default_value' => [
                    'nullable',
                    Rule::in(array_map(fn ($elt) => trim($elt), explode(',', $request->string('value_options'))))
                ]
            ]
        );
        return $validator;
    }
    protected function checkboxFieldValidator(Request $request, $commonRules = [])
    {
        $validator = Validator::make(
            $request->all(),
            [
                ...$commonRules,
                'value_options' => [
                    'required',
                    self::VALUE_OPTIONS_PATTERN_RULE
                ],
                'default_value_set' => [
                    'nullable',
                    self::VALUE_OPTIONS_PATTERN_RULE,
                    Rule::in(array_map(fn ($elt) => trim($elt), explode(',', $request->string('value_options'))))
                ]
            ]
        );
        return $validator;
    }
    protected function selectFieldValidator(Request $request, $commonRules = [])
    {
        $validator = Validator::make($request->all(), [
            ...$commonRules,
            'value_options' => [
                'required',
                self::VALUE_OPTIONS_PATTERN_RULE
            ],
            'value_is_reference' => 'nullable|boolean',
            'value_is_a_sets' => 'nullable|boolean',
            /* 'referenced_field_id' => 'nullable|required_without:value_options|exists:form_fields,id',
            'default_value_ref_id' => 'nullable|required_without:value_is_a_sets|exists:form_field_data,form_field_id',
            'default_value_ref_ids' => 'nullable|required_with:value_is_a_sets|array',
            'default_value_ref_ids.*' => 'nullable|exists:form_field_data,form_field_id',
            'value_options' => 'required_without:value_is_reference',
            'default_value' => [
                'nullable',
                Rule::in(explode(',', $request->string('value_options')))
            ],
            'default_value_set' => [
                'nullable',
                'required_with:value_is_a_sets',
                self::VALUE_OPTIONS_PATTERN_RULE
            ], */
        ]);
        return $validator;
    }
}
