<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\FormGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\Facades\Toast;

class EventFormGroupController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Event $event)
    {

        Gate::allows('if_admin');
        foreach ($request->groups as $group_id) {
            $event->formGroups()->attach($group_id);
        }
        Toast::title("Group(s) added")->success()->autoDismiss(2);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event, FormGroup $group)
    {
        Gate::allows('if_admin');
        $event->formGroups()->detach($group);
        Toast::title("Group deleted from event")->success()->autoDismiss(2);
        return redirect()->back();
    }
}
