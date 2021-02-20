<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialNetwork;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SocialNetworkRequest;
use App\Repositories\SocialNetworkRepository;

class SocialNetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SocialNetworkRepository $socialNetworkRepository)
    {
        $socialNetworks = $socialNetworkRepository->getAllById(Auth::id());
        
        return view('socialNetworks.index', compact('socialNetworks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('socialNetworks.create')->with('types', SocialNetwork::$types); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\SocialNetworkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocialNetworkRequest $request, SocialNetworkRepository $socialNetworkRepository)
    {       
        $socialNetworkRepository->create($request);

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
    public function update(SocialNetworkRequest $request, SocialNetwork $socialNetwork, SocialNetworkRepository $socialNetworkRepository)
    {
        $socialNetworkRepository->update($request, $socialNetwork->id);

        return redirect(route('social-networks.index'))->with('_success', '¡Red social editada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialNetwork $socialNetwork, SocialNetworkRepository $socialNetworkRepository)
    {
        if($socialNetwork->owner->id == Auth::id())
        {
            $socialNetworkRepository->delete($socialNetwork->id);

            return back()->with('_success', '¡Red social borrada exitosamente!');
        }
        
        return back()->with('_failure', '¡No tiene permiso de borrar ese recurso!');
    }
}
