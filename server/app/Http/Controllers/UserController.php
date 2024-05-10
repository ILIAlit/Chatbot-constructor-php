<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create($name, $last_name) {
        $time = new Carbon();
        
    }
}