<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\Facades\Toast;

class FormGroupFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\FormGroup  $group
     * @return \Illuminate\Http\Response
     */
    public function index(FormGroup $group)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\FormGroup  $group
     * @return \Illuminate\Http\Response
     */
    public function create(FormGroup $group)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormGroup  $group
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FormGroup $group)
    {
        Gate::allows('if_admin');
        $errorBagName = "group_{$group->id}_forms";
        $request->validateWithBag(
            $errorBagName,
            [
                "forms" => 'required|array',
            ]
        );
        foreach ($request->forms as $form_id) {
            $group->forms()->attach($form_id);
        }
        Toast::title("Form(s) addred")->success()->autoDismiss(2);
        return redirect()->back();
    }

    public static function getRequestErrorsBagName($group)
    {
        return "group_{$group->id}_forms";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormGroup  $group
     * @param  \{{ namespacedModel }}  ${{ modelVariable }}
     * @return \Illuminate\Http\Response
     */
    public function show(FormGroup $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormGroup  $group
     * @param  \{{ namespacedModel }}  ${{ modelVariable }}
     * @return \Illuminate\Http\Response
     */
    public function edit(FormGroup $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormGroup  $group
     * @param  \{{ namespacedModel }}  ${{ modelVariable }}
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormGroup $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormGroup  $group
     * @param  \{{ namespacedModel }}  ${{ modelVariable }}
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormGroup $group, Form $form)
    {
        Gate::allows('if_admin');
        $group->forms()->detach($form);
        Toast::title("Form deleted from group")->success()->autoDismiss(2);
        return redirect()->back();
    }
}
