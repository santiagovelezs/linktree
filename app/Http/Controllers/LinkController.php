<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Http\Requests\v1\LinkRequest;
use App\Repositories\LinkRepository;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LinkRepository $linkRepository)
    {
        $links = $linkRepository->getAllById(Auth::id());
        
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
     * @param  \Illuminate\Http\Request\LinkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinkRequest $request, LinkRepository $linkRepository)
    {        
        $linkRepository->create($request, Auth::id());

        return redirect(route('links.index'))->with('_success', '¡Enlace creado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        return view('links.show', compact('link'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        return view('links.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\LinkRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LinkRequest $request, Link $link, LinkRepository $linkRepository)
    {
        $linkRepository->update($request, $link->id, Auth::id());

        return redirect(route('links.index'))->with('_success', '¡Enlace editado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link, LinkRepository $linkRepository)
    {
        if($linkRepository->delete($link->id, Auth::id()))
        {            

            return back()->with('_success', '¡Enlace borrado exitosamente!');
        }
        
        return back()->with('_failure', '¡No tiene permiso de borrar ese recurso!');
    }
}
