<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ImagesTema;
use App\Models\MyLinktree;
use Illuminate\Http\Request;

class MyLinktreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($username)
    {        
        $user = User::where('username',$username)->first();
        if($user)
        {
            $links = $user->links;
            $socialNetworks = $user->socialNetworks;        
            $myLinkTree = $user->myLinktree;
                    
            return view('user.mylinktree')->with([
                'user' => $user,
                'links' => $links,
                'socialNetworks' => $socialNetworks,
                'myLinktree' => $myLinkTree            
            ]);   
        }
        abort(404); 
    }

    private function setupLinkTree($user)
    {
        $myLinkT = new MyLinktree();
        $myLinkT->user_id = $user->id;
        $myLinkT->imagesTema_id = ImagesTema::all()->first()->id;
        $myLinkT->save();
    }
    
    public function update(Request $request, MyLinktree $myLinktree)
    {
        $myLinktree->imagesTema_id = $request->input('imagesTema_id');        
        $myLinktree->save();

        return back()->with('_success', '¡Tema LinkTree actualizado con exito');
    }
}
