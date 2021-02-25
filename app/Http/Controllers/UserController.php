<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\File;
use App\Models\ImagesTema;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\upProfilePhotoRequest;

class UserController extends Controller
{  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */    

    public function upProfilePhoto(upProfilePhotoRequest $request)
    {
        $user = Auth::user();
        if($user->url_image)
        {
            Storage::disk('public')->delete($user->url_image);
        }
        $ext = $request->file->getClientOriginalExtension();
        $file_name_db = $user->username.".".$ext;        
        $path = Storage::disk('public')->putFileAs('images', new File($request->file), $file_name_db);
        //dd($path);
        
        $user->url_image = $path;
        $user->save();
        return redirect(route('user.edit', Auth::user()))->with('_success', 'Imagen actualizada exitosamente!');
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
        //dd($imagesTemas);
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
}
