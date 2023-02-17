<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\Facades\Toast;

class FormFieldController extends Controller
{

    protected $form;
    public function __construct()
    {
        $this->middleware("validate-form-field-store-request")->only([
            'store',
            'update'
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Form $form)
    {
        Gate::allows('if_admin');
        return response()->json(
            FormField::where('form_id', $form->id)->get()->mapWithKeys(fn ($field) => [$field['id'] => $field['label']])->toArray()
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Form $form)
    {
        return view('components.fields.create.index', [
            'form' => $form,
            'fieldType' => $request->query('field_type')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Form $form)
    {
        Gate::authorize('if_admin');
        $request->merge(['form_id' => $form->id]);
        FormField::create($request->all());
        Toast::title('New field added')->autoDismiss(2);
        return redirect()->route('forms.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormField  $formField
     * @return \Illuminate\Http\Response
     */
    public function show(FormField $formField)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormField  $formField
     * @return \Illuminate\Http\Response
     */
    public function edit(Form $form, FormField $field)
    {
        return view('components.fields.edit.index', [
            'form' => $form,
            'field' => $field
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormField  $formField
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $form, FormField $field)
    {
        Gate::authorize('if_admin');
        $request->merge(['form_id' => $form->id]);
        $field->form_id = $request->input('form_id');
        $field->type = $request->input('type');
        $field->label = $request->input('label');
        $field->value_required = $request->input('value_required');
        $field->field_visible_by_target = $request->input('field_visible_by_target');
        $field->value_editable_by_target = $request->input('value_editable_by_target');
        $field->value_is_unique = $request->input('value_is_unique');
        $field->value_is_reference = $request->input('value_is_reference');
        $field->value_is_a_set = $request->input('value_is_a_set');
        $field->referenced_field_id = $request->input('referenced_field_id');
        $field->default_value_ref_id = $request->input('default_value_ref_id');
        $field->value_options = $request->input('value_options');
        $field->default_value = $request->input('default_value');
        $field->default_value_set = $request->input('default_value_set');
        $field->accepted_file_types = $request->input('accepted_file_types');
        $field->value_min_length = $request->input('value_min_length');
        $field->value_max_length = $request->input('value_max_length');

        $field->save();
        Toast::title('Field updated')->autoDismiss(2);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormField  $formField
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        FormField::destroy($request->field->id);
        Toast::title('Field deleted')->autoDismiss(2);
        return back();
    }
}
