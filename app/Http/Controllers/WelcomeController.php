<?php

namespace App\Http\Controllers;

use App\Role;

class WelcomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $roles = new Role;
        return view('welcome', ['roles' => $roles::all()]);
    }
}
