<?php

namespace App\Http\Controllers\api\v2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\v2\SocialNetworkRequest;
use App\Http\Resources\v2\SocialNetworkResource;
use App\Repositories\SocialNetworkRepository;
use App\Http\Resources\v2\SocialNetworkResourceCollection;

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
        return new SocialNetworkResourceCollection($socialNetworks);       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\apiv2\SocialNetworkRequest  $request
     * @param  App\Repositories\SocialNetworkRepository $socialNetworkRepository
     * @return \Illuminate\Http\Response
     */
    public function store(SocialNetworkRequest $request, SocialNetworkRepository $socialNetworkRepository)
    {        
        $token = $request->bearerToken();      
        if(!$token)    
            return response()->json(['errors' => [
                'status' => 401,
                'title'  => 'Bad Request',
                'detail' => 'No token provided' 
            ]
        ], 401);      
        $user_id = $token; // Middleware Tokens auth not implemented
        $attributes = $request->data['attributes'];
        $request->replace($attributes);
        //dd($attributes);
        $socialNetwork = $socialNetworkRepository->create($request, $user_id);
        
        return (new SocialNetworkResource($socialNetwork))
                ->response()
                ->setStatusCode(201);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  App\Repositories\SocialNetworkRepository $socialNetworkRepository
     * @return \Illuminate\Http\Response
     */
    public function show($id, SocialNetworkRepository $socialNetworkRepository)
    {
        $socialNetwork = $socialNetworkRepository->getById($id);
        return new SocialNetworkResource($socialNetwork);        
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
            return response()->json(['errors' => [
                'status' => 401,
                'title'  => 'Bad Request',
                'detail' => 'No token provided' 
            ]
        ], 401);
        $user_id = $token; // Middleware Tokens auth not implemented
        $attributes = $request->data['attributes'];
        $request->replace($attributes);
        $socialNetwork = $socialNetworkRepository->update($request, $id, $user_id);
        if($socialNetwork)
        {
            return (new SocialNetworkResource($socialNetwork))
                ->response()
                ->setStatusCode(200);
        }    

        return response(null, 403);        
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
            return response()->json(['errors' => [
                'status' => 401,
                'title'  => 'Bad Request',
                'detail' => 'No token provided' 
            ]
        ], 401);
        $socialNetwork = $socialNetworkRepository->getById($id);
        if(!$socialNetwork)
        {
            return response(null, 404);
        }
        $user_id = $token; // Middleware Tokens auth not implemented
        if($socialNetworkRepository->delete($id, $user_id))
        {
            return response(null, 204);
        }
        
        return response(null, 403);
    }
}
