<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Requests\LinkRequest;
use App\Http\Controllers\Controller;
use App\Repositories\LinkRepository;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LinkRepository $linkRepository)
    {
        $links = $linkRepository->getAll();
        return response()->json(['data' => $links], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinkRequest $request, LinkRepository $linkRepository)
    {
        $token = $request->bearerToken();                
        $user_id = $token; // Middleware Tokens auth not implemented
        $link = $linkRepository->create($request, $user_id);

        return response()->json(['data' => $link], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, LinkRepository $linkRepository)
    {
        $link = $linkRepository->getById($id);
        return response()->json(['data' => $link], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LinkRequest $request, $id, LinkRepository $linkRepository)
    {
        $token = $request->bearerToken(); 
        $user_id = $token; // Middleware Tokens auth not implemented
        $link = $linkRepository->update($request, $id, $user_id);
        if($link)
        {
            return response()->json(['data' => $link], 200);
        }    

        return response()->json(['error' => 'Not authorized.'], 403);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, LinkRepository $linkRepository)
    {
        $token = $request->bearerToken();
        $user_id = $token; // Middleware Tokens auth not implemented
        if($linkRepository->delete($id, $user_id))
        {
            return response(null, 204);
        }
        
        return response()->json(['error' => 'Not authorized.'], 403);
    }
}
