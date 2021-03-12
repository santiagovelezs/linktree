<?php

namespace App\Http\Controllers\api\v2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\apiv2\SocialNetworkRequest;
use App\Http\Resources\SocialNetworkResource;
use App\Repositories\SocialNetworkRepository;
use App\Http\Resources\SocialNetworkResourceCollection;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocialNetworkRequest $request, SocialNetworkRepository $socialNetworkRepository)
    {
        dd($request->data);
        return response()->json(['data' => $request], 201);
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
        return new SocialNetworkResource($socialNetwork);        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
