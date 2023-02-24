<?php

namespace App\Http\Controllers;

use App\Models\FormGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\Facades\Toast;

class SubscriptionController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::allows(['if_admin', 'if_company']);
        return view('subscriptions.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::allows('if_company');
        dd($request->subscription_option);
        $request->user()->subscriptions()->attach($request->subscription_option);
        Toast::title('Subscribed')->autoDismiss(2);
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
