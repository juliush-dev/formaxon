<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormFieldData;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;

class FormDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Form $form)
    {
        return view('form-fields-data.create', ['form' => $form]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Form $form)
    {
        $request->collect()->each(function ($fieldValue, $key) use ($request) {
            $fieldId = filter_var($key, FILTER_SANITIZE_NUMBER_INT);
            $fieldValue = is_array($fieldValue)
                ? implode(",", $fieldValue)
                : $fieldValue;
            FormFieldData::create([
                'form_field_id' => $fieldId,
                'subscriber_id' => auth()->check()
                    ? Subscriber::firstWhere('user_id', auth()->user()->id)->id
                    : null,
                'visitor_ip' => $request->ip(),
                'value' => $fieldValue,
            ]);
        });
        Toast::title('Data submitted')->success($form->title)->autoDismiss(5);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormData  $formData
     * @return \Illuminate\Http\Response
     */
    public function show(Form $form)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormData  $formData
     * @return \Illuminate\Http\Response
     */
    public function edit(Form $form)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormData  $formData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $form)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormData  $formData
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form)
    {
        //
    }
}
