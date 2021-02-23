<?php

namespace App\Repositories;

use App\Models\Link;
use Illuminate\Support\Facades\Auth;

class LinkRepository
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Models\Link[]
     */
    public function getAll()
    {
        $links = Link::simplePaginate(5);
        
        return $links;
    }

    /**
     * Display a listing of the resource.
     * @param $id
     * @return App\Models\Link[]
     */
    public function getAllById($id)
    {
        $links = Link::ownedBy($id)->simplePaginate(5);
                
        return $links;
    }

    public function getById($id)
    {
       return Link::find($id);
    }

    /**
     * Guardar un link en la base de datos
     * @param $linkData
     * @return App\Models\Link
     */
    public function create($linkData, $user_id) // TODO: Middleware auth
    {        
        $link = new Link();
        $link->label = $linkData->label;
        $link->url = $linkData->url;
        $link->user_id = $user_id;
        $link->save();

        return $link;
    }

    /**
     * Actualizar un link en la base de datos
     * @param $linkData
     * @param $id
     * @return App\Models\Link
     */
    public function update($linkData, $id, $user_id)
    {               
        $link = Link::find($id);
        if($user_id == $link->owner->id) 
        {
            $link->label = $linkData->label;
            $link->url = $linkData->url;
            $link->save();

            return $link;
        }
        return false;        
    }

    /**
     * Eliminar un link en la base de datos     
     * @param $id
     * @return N
     */
    public function delete($id, $user_id)
    {
        $link = Link::find($id);
        if($user_id == $link->owner->id) 
        {            
            $link->delete();

            return true;
        }
        return false;       
    }

}