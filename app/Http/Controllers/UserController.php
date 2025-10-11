<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function baca() {
        $data = User::all();
        return view('pages.superadmin.user.baca', compact('data'));
    }
}
