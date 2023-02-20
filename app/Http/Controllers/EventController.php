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
        return view('events.index', [
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
        return view('events.create');
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
            'name' => 'required|unique:events,name|max:255',
            'description' => 'required',
            'at' => 'required',
            'location' => 'required',
            'target' => Rule::in([Event::TARGET_VISITOR, Event::TARGET_COMPANY]),
            'location' => 'required',
            'visible_by_target' => 'required|boolean',
            'thumbnail' => 'nullable|file',
        ]);
        Event::create($request->all());
        Toast::title('Event created')->autoDismiss(2);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show', ['event' => $event]);
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
        return view('events.edit', [
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
            'description' => 'required',
            'at' => 'required',
            'location' => 'required',
            'target' => Rule::in([Event::TARGET_VISITOR, Event::TARGET_COMPANY]),
            'location' => 'required',
            'visible_by_target' => 'required|boolean',
            'thumbnail' => 'nullable|file',
        ]);
        $event->name = $request->input('name');
        $event->description = $request->input('description');
        $event->at = $request->input('at');
        $event->location = $request->input('location');
        $event->target = $request->input('target');
        $event->visible_by_target = $request->input('visible_by_target');
        $event->thumbnail = $request->input('thumbnail', null);
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
        $event->delete();
        Toast::title('Event deleted')->autoDismiss(2);
        return back();
    }
}
