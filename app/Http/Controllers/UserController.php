<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $validatedData = $request->validate([            
            'file' => ['required'],
        ]);
        $user = Auth::user();
        if($user->url_image)
        {
            Storage::disk('public')->delete($user->url_image);
        }
        $ext = $request->file->getClientOriginalExtension();
        $file_name_db = $user->username.".".$ext;
        //$store = $request->file->storeAs('public/images', $file_name_db);
        //$user->url_image = $user->username.$ext;
        //Storage::disk('public')->put('images/', $request->file);
        $path = Storage::disk('public')->putFileAs('images', new File($request->file), $file_name_db);
        //dd($path);
        
        $user->url_image = $path;
        $user->save();
        return redirect(route('user.edit', Auth::user()))->with('_success', 'Imagen actualizada exitosamente!');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //dd($request);
        $user->name = $request->input('name');        
        $user->save();

        return redirect(route('user.edit', Auth::user()))->with('_success', '¡Usuario editado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function mylinktree($username)
    {
        $user = User::where('username',$username)->first();
        $links = $user->links;
        $socialNetworks = $user->socialNetworks;
        return view('user.mylinktree')->with([
            'user' => $user,
            'links' => $links,
            'socialNetworks' => $socialNetworks
        ]);   
    }


}
