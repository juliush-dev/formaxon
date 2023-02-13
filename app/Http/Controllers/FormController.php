<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Tables\Forms;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use ProtoneMedia\Splade\Facades\Toast;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('forms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('if_admin');
        return view('components.forms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('if_admin');
        $request->validate([
            'title' => 'required|string|unique:forms|max:255|min:4'
        ]);
        Form::create([
            'title' => $request->title,
        ]);
        Toast::title('Form created')->autoDismiss(2);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function show(Form $form)
    {
        Gate::authorize('if_admin');
        return view('forms.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function edit(Form $form)
    {
        Gate::authorize('if_admin');
        return view('components.forms.edit', ['form' => $form]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $form)
    {
        Gate::authorize('if_admin');
        $request->validate([
            'title' => 'required|string|unique:forms|max:255|min:4'
        ]);
        $form->title = $request->title;
        $form->save();
        Toast::title('Form updated')->success($form->title)->autoDismiss(5);
        return redirect()->route('forms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form)
    {
        Gate::authorize('if_admin');
        $form->delete();
        Toast::title($form->title . ' deleted')->success()->autoDismiss(2);
        return redirect()->route('forms.index');
    }
}