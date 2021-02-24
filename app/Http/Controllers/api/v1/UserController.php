<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserRepository $userRepository)
    {
        $users = $userRepository->getAll();
        return response()->json(['data' => $users], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, UserRepository $userRepository)
    {
        $user = $userRepository->getById($id);
        return response()->json(['data' => $user], 200);          
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  UserRequest $request
     * @param  $id
     * @param  UserRepository $UserRepository
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, UserRepository $userRepository)
    {
        $token = $request->bearerToken(); 
        $user_id = $token; // Middleware Tokens auth not implemented
        $user = $userRepository->update($request, $id, $user_id);
        if($user)
        {
            return response()->json(['data' => $user], 200);
        }    

        return response()->json(['error' => 'Not authorized.'], 403);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @param  int  $id
     * @param  UserRepository $userRepository
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, UserRepository $userRepository)
    {
        $token = $request->bearerToken();
        $user_id = $token; // TODO: Middleware Admin Role Tokens auth not implemented
        if($userRepository->delete($id, $user_id))
        {
            return response(null, 204);
        }
        
        return response()->json(['error' => 'Not authorized.'], 403);
    }

    public function links(Request $request, $id, UserRepository $userRepository)
    {        
        $user = $userRepository->getById($id);
        $links = $user->links;
        return response()->json(['data' => $links], 200);
    }

    public function socialNetworks(Request $request, $id, UserRepository $userRepository)
    {        
        $user = $userRepository->getById($id);
        $socialNetworks = $user->socialNetworks;
        return response()->json(['data' => $socialNetworks], 200);
    }
}
