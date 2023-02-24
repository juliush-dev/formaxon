<?php

namespace App\Http\Controllers;

use App\Models\FormGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\Facades\Toast;

class FormGroupController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth")->only([
            'store',
            'update',
            'edit'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('groups.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('if_admin');
        return view('components.groups.create');
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
            'name' => 'required|string|unique:form_groups|max:255|min:4'
        ]);
        FormGroup::create([
            'name' => $request->name,
        ]);
        Toast::title('Group created')->autoDismiss(2);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormGroup  $group
     * @return \Illuminate\Http\Response
     */
    public function show(FormGroup $group)
    {
        return view('components.groups.show', $group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormGroup  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(FormGroup $group)
    {
        Gate::authorize('if_admin');
        return view('components.groups.edit', ['group' => $group]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormGroup  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormGroup $group)
    {
        Gate::authorize('if_admin');
        $request->validate([
            'name' => 'required|string|unique:form_groups|max:255|min:4'
        ]);
        $group->name = $request->name;
        $group->save();
        Toast::title('Group updated')->success($group->name)->autoDismiss(5);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormGroup  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormGroup $group)
    {
        Gate::authorize('if_admin');
        $group->delete();
        Toast::title($group->name . ' deleted')->success()->autoDismiss(2);
        return redirect()->route('groups.index');
    }
}
