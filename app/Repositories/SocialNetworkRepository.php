<?php

namespace App\Repositories;

use App\Models\SocialNetwork;
use Illuminate\Support\Facades\Auth;

class SocialNetworkRepository
{
    public function getAll()
    {
        $socialNetworks = SocialNetwork::simplePaginate(5);

        return $socialNetworks;
    }

    public function getAllById($id)
    {
        $socialNetworks = SocialNetwork::ownedBy($id)->simplePaginate(5);

        return $socialNetworks;
    }

    /**
     * Guardar un SocialNetwork en la base de datos
     * @param $socialNetworkData
     * @return App\Models\SocialNetwork
     */
    public function create($socialNetworkData)
    {          
        $socialNetwork = new SocialNetwork();
        $socialNetwork->type = $socialNetworkData->type;
        $socialNetwork->url = $socialNetworkData->url;
        $socialNetwork->user_id = Auth::id();
        $socialNetwork->save();

        return $socialNetwork;
    }

    public function update($socialNetworkData, $id)
    {
        $socialNetwork = SocialNetwork::find($id);
        $socialNetwork->type = $socialNetworkData->type;
        $socialNetwork->url = $socialNetworkData->url;
        $socialNetwork->save();
    }

    public function delete($id)
    {
        return SocialNetwork::destroy($id);        
    }

}