<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialNetwork;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SocialNetworkRequest;

class SocialNetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socialNetworks = SocialNetwork::ownedBy(Auth::id())->simplePaginate(5);
        //dd($links);
        return view('socialNetworks.index', compact('socialNetworks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$types = ['youtube', 'instagram', 'twitter', 'facebook'];
        //return view('socialNetworks.create', compact('types'));
        return view('socialNetworks.create')->with('types', SocialNetwork::$types); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocialNetwokRequest $request)
    {       
        $user = Auth::user();        
        $socialNetwork = new SocialNetwork();
        $socialNetwork->type = $request->input('type');
        $socialNetwork->url = $request->input('url');
        $socialNetwork->user_id = $user->id;
        $socialNetwork->save();
        return redirect(route('social-networks.index'))->with('_success', '!Red social creada exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SocialNetwork $socialNetwork)
    {
        return view('socialNetworks.show', compact('socialNetwork'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialNetwork $socialNetwork)
    {
        return view('socialNetworks.edit', compact('socialNetwork'))->with('types', SocialNetwork::$types);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SocialNetwokRequest $request, SocialNetwork $socialNetwork)
    {
        $socialNetwork->type = $request->input('type');
        $socialNetwork->url = $request->input('url');
        $socialNetwork->save();

        return redirect(route('social-networks.index'))->with('_success', '¡Red social editada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialNetwork $socialNetwork)
    {
        if($socialNetwork->owner->id == Auth::id())
        {
            $socialNetwork->delete();

            return back()->with('_success', '¡Red social borrada exitosamente!');
        }
        
        return back()->with('_failure', '¡No tiene permiso de borrar ese recurso!');
    }
}
