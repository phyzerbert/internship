<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:teacher');
    }

    public function pupilsView()
    {
        return view('teachers.pupils');
    }

    public function profileView()
    {
        $user = Auth::user();
        $profile = $user->teacher;

        return view('teachers.profile.show', ['user' => $user, 'profile' => $profile]);
    }

    public function profileEdit()
    {
        $user = Auth::user();
        $profile = $user->teacher;

        return view('teachers.profile.edit', ['user' => $user, 'profile' => $profile]);
    }

    public function profileUpdate(Request $request)
    {
        $emailCheck = ($request->email != '') && ($request->email != Auth::user()->email);

        if ($emailCheck) {
            $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'school_name'   => 'required|string'
            ]);
        } else {
            $request->validate([
                'name'     => 'required|string|max:255',
                'password' => 'required|string|min:6|confirmed',
                'school_name'   => 'required|string'
            ]);
        }

        $user = Auth::user();
        $profile = $user->teacher;

        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $profile->update([
            'school_name' => $request->school_name
        ]);

        return redirect()->route('teacher.profileView');
    }
}
