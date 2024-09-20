<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        $data = User::all();

        return view('users-index', compact('data'));
    }

    public function show($id) {
        $user = User::find($id);
        dd($user->toArray());

        // return view('users-index', compact('data'));
    }
}
