<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Link;
use Illuminate\Support\Facades\Input;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::ownedBy(Auth::id())->simplePaginate(5);

        return view('links.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO: validaciones

        $link = new Link();
        $link->label = $request->input('label');
        $link->url = $request->input('url');
        $link->user_id = Auth::id();
        $link->save();

        return redirect(route('links.index'))->with('_success', '¡Enlace creado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        return view('links.show', compact('link'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        return view('links.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Link $link)
    {
        // TODO: validaciones

        $link->label = $request->input('label');
        $link->url = $request->input('url');
        $link->save();

        return redirect(route('links.index'))->with('_success', '¡Enlace editado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        if($link->owner->id == Auth::id())
        {
            $link->delete();

            return back()->with('_success', '¡Enlace borrado exitosamente!');
        }
        
        return back()->with('_failure', '¡No tiene permiso de borrar ese recurso!');
    }
}
