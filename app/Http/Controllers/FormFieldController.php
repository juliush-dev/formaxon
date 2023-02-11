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
        $this->middleware("validate-form-field-store-request")->only('store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
            'field' => $field,
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
        // FormField::upda($request->all());
        Toast::title('New field added')->autoDismiss(2);
        return redirect()->route('forms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormField  $formField
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormField $formField)
    {
        //
    }
}