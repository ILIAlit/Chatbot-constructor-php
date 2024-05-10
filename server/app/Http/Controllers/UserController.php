<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create($name, $last_name, $ttu) {
        $user = new UserModel();
        $user->name = $name;
        $user->last_name = $last_name;
        $user->ttu = $ttu;
        $user->save();
        return $user;
    }
}