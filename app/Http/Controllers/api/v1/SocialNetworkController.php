<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\apiv1\SocialNetworkRequest;
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
        $socialNetworks = $socialNetworkRepository->getAll();
        return response()->json(['data' => $socialNetworks], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocialNetworkRequest $request, SocialNetworkRepository $socialNetworkRepository)
    {        
        $token = $request->bearerToken();      
        if(!$token)    
            return response()->json(['error' => 'Bad Request'], 400);          
        $user_id = $token; // Middleware Tokens auth not implemented
        $socialNetwork = $socialNetworkRepository->create($request, $user_id);
        
        return response()->json(['data' => $socialNetwork], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, SocialNetworkRepository $socialNetworkRepository)
    {
        $socialNetwork = $socialNetworkRepository->getById($id);
        return response()->json(['data' => $socialNetwork], 200);    
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SocialNetworkRequest $request, $id, SocialNetworkRepository $socialNetworkRepository)
    {
        $token = $request->bearerToken(); 
        if(!$token)    
            return response()->json(['error' => 'Bad Request'], 400);
        $user_id = $token; // Middleware Tokens auth not implemented
        $socialNetwork = $socialNetworkRepository->update($request, $id, $user_id);
        if($socialNetwork)
        {
            return response()->json(['data' => $socialNetwork], 200);
        }    

        return response()->json(['error' => 'Not authorized.'], 403);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, SocialNetworkRepository $socialNetworkRepository)
    {
        $token = $request->bearerToken();
        if(!$token)    
            return response()->json(['error' => 'Bad Request'], 400);
        $user_id = $token; // Middleware Tokens auth not implemented
        if($socialNetworkRepository->delete($id, $user_id))
        {
            return response(null, 204);
        }
        
        return response()->json(['error' => 'Not authorized.'], 403);
    }
}
