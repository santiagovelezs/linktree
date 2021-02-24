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
}