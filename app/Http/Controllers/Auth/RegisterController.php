<?php

namespace App\Http\Controllers\Auth;

use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    public function showRegistrationForm(Role $role)
    {
        return view('auth.register', ['role' => $role]);
    }

    protected function registered(Request $request, $user)
    {
        if ($user->hasRole('pupil')) {
            $user->pupil()->create([
                'hobbies'     => '',
                'description' => '',
                'pitch_text'  => '',
                'experience'  => ''
            ]);

            return redirect()->route('pupil.searchView');
        }

        if ($user->hasRole('company')) {
            $user->company()->create([
                'phone_number'   => '',
                'branch'         => '',
                'description'    => '',
                'employs_number' => ''
            ]);

            return redirect()->route('company.requestsView');
        }

        if ($user->hasRole('teacher')) {
            $user->teacher()->create([
                'school_name' => $request->school_name
            ]);

            return redirect()->route('teacher.pupilsView');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if (isset($data['school_name'])) {
            $validator = Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
                'school_name' => ['required', 'string']
            ]);
        } else {
            $validator = Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed']
            ]);
        }

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->roles()->attach(Role::where('slug', $data['role'])->first());

        return $user;
    }
}
