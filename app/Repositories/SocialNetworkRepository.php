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

    public function getById($id)
    {
       return SocialNetwork::find($id);
    }

    /**
     * Guardar un SocialNetwork en la base de datos
     * @param $socialNetworkData
     * @return App\Models\SocialNetwork
     */
    public function create($socialNetworkData, $user_id) // TODO: Middleware auth
    {        
        $socialNetwork = new SocialNetwork();
        $socialNetwork->type = $socialNetworkData->type;
        $socialNetwork->url = $socialNetworkData->url;
        $socialNetwork->user_id = $user_id;
        $socialNetwork->save();

        return $socialNetwork;
    }    

    public function update($socialNetworkData, $id, $user_id)
    {               
        $socialNetwork = SocialNetwork::find($id);
        if($user_id == $socialNetwork->owner->id) 
        {
            $socialNetwork->type = $socialNetworkData->type;
            $socialNetwork->url = $socialNetworkData->url;
            $socialNetwork->save();

            return $socialNetwork;
        }
        return false;        
    }   

    public function delete($id, $user_id)
    {
        $socialNetwork = SocialNetwork::find($id);
        if($user_id == $socialNetwork->owner->id) 
        {            
            $socialNetwork->delete();

            return true;
        }
        return false;       
    }

}