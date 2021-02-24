<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\File;
use App\Models\ImagesTema;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
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
        $imagesTemas = ImagesTema::all();
        return view('user.edit',)->with([
            'user' => $user,
            'imagesTemas' => $imagesTemas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Request $request
     * @param  User $user
     * @param  UserRepository $userRepository
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, UserRepository $userRepository)
    {
        //dd($request);
        $userRepository->update($request, $user->id, Auth::id());       

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
}
