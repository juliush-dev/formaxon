<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Form;
use App\Models\FormGroup;
use App\Models\Role;
use App\Tables\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use ProtoneMedia\Splade\Facades\Toast;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('event.index', [
            'events' => Events::class,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('if_admin');
        return view('event.create');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        if (Gate::allows('if_company')) {
            return view('event.show-for-company', ['event' => $event]);
        } elseif (Gate::allows('if_visitor')) {
            return view('event.show-for-visitor', ['event' => $event]);
        } else {
            return view('event.show', ['event' => $event]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        Gate::authorize('if_admin');
        return view('event.edit', [
            'event' => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        Gate::authorize('if_admin');
        $request->validate([
            'name' => 'required|unique:events,name|max:255',
            'description' => 'nullable',
            'target' => Rule::in([Event::TARGET_VISITOR, Event::TARGET_COMPANY]),
            'field_visible_by_target' => ['boolean'],
        ]);
        $event->name = $request->input('name');
        $event->location = $request->input('location');
        $event->description = $request->input('description');
        $event->target = $request->input('target');
        $event->thumbnail = $request->input('thumbnail', null);
        $event->at = $request->input('at');
        $event->save();
        Toast::title('Event updated')->autoDismiss(2);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        Gate::authorize('if_admin');
    }
}
