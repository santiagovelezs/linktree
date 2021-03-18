<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\SocialNetwork;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    public function getAll() // TODO: middleware Auth role Admin
    {
        $users = User::simplePaginate(5);

        return $users;
    }

    public function getById($id)
    {
       return User::find($id);
    }

    /**
     * Actualizar un link en la base de datos
     * @param $userData
     * @param $id
     * @param $user_id
     * @return App\Models\User
     */
    public function update($userData, $user_id)
    {               
        $user = User::find($user_id);
        
        $user->name = $userData->name;            
        $user->save();

        return $user;
        
              
    }

    /**
     * Eliminar un User en la base de datos     
     * @param $id
     * @param $user_id
     * @return Boolean
     */
    public function delete($id, $user_id)
    {
        $user = User::find($id);
        if($user_id == $user->id) 
        {            
            $user->delete();

            return true;
        }
        return false;       
    }
}