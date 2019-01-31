<?php

namespace App\Http\Controllers;

use App\Company;
use App\CompanyPupil;
use App\Role;
use App\Hour;
use App\User;
use App\Pupil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PupilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:pupil');
    }

    public function searchView(Request $request)
    {
        $roles = new Role;
        $companies = $roles->find(2)->users()->paginate(10);

        return view('pupils.search', ['companies' => $companies]);
    }

    public function search(Request $request)
    {
        $roles = new Role;

        $results = $roles->find(2)->users()->where('name', 'like', '%' . $request->search . '%')->paginate(10);

        return view('pupils.search', ['companies' => $results]);
    }

    public function apply(Company $company)
    {
        Auth::user()->pupil->companies()->attach(Company::where('id', $company->id)->first());

        return redirect()->back();
    }

    public function companyView(Request $request)
    {
        $mycompanies = Auth::user()->pupil->companies;    
        return view('pupils.companies',["mycompanies" => $mycompanies]);
    }

    public function requesthours(Request $request)
    {
        $pupil = $request->user()->id;
        $hour = new Hour;
        $hour->pupil_id = $pupil;
        $hour->company_id = $request->get("company");
        $hour->week = $request->get("week");
        $hour->hour = $request->get("hours");
        $hour->description = $request->get("description");

        $hour->save();
        return back();

    }

    public function profileView()
    {
        $user = Auth::user();
        $profile = $user->pupil;

        return view('pupils.profile.show', ['user' => $user, 'profile' => $profile]);
    }

    public function profileEdit()
    {
        $user = Auth::user();
        $profile = $user->pupil;

        return view('pupils.profile.edit', ['user' => $user, 'profile' => $profile]);
    }

    public function profileUpdate(Request $request)
    {
        $emailCheck = ($request->email != '') && ($request->email != Auth::user()->email);

        if ($emailCheck) {
            $request->validate([
                'name'        => 'required|string|max:255',
                'email'       => 'required|string|email|max:255|unique:users',
                'password'    => 'required|string|min:6|confirmed',
                'hobbies'     => 'required|string',
                'description' => 'required|string',
                'pitch_text'  => 'required|string|min:50',
                'experience'  => 'required|string'
            ]);
        } else {
            $request->validate([
                'name'        => 'required|string|max:255',
                'password'    => 'required|string|min:6|confirmed',
                'hobbies'     => 'required|string',
                'description' => 'required|string',
                'pitch_text'  => 'required|string|min:50',
                'experience'  => 'required|string'
            ]);
        }

        $user = Auth::user();
        $profile = $user->pupil;

        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $profile->update([
            'hobbies'     => $request->hobbies,
            'description' => $request->description,
            'pitch_text'  => $request->pitch_text,
            'experience'  => $request->experience
        ]);

        return redirect()->route('pupil.profileView');
    }
}
