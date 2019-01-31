<?php

namespace App\Http\Controllers;

use App\CompanyPupil;
use App\Hour;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:company');
    }

    public function requestsView()
    {
        $requests = Auth::user()->company->pupils;

        return view('companies.requests', ['requests' => $requests]);
    }

    public function accept(CompanyPupil $companyPupil)
    {
        $companyPupil->update([
            'state' => 1
        ]);

        return redirect()->back();
    }

    public function decline(CompanyPupil $companyPupil)
    {
        $companyPupil->delete();

        return redirect()->back();
    }

    public function hoursView(Request $request)
    {
        $myhours = Auth::user()->companyHour;
        return view('companies.hours',['hours' => $myhours]);
    }

    public function accepthour($id)
    {
        $hour = Hour::find($id);
        $hour->state = 1;
        $hour->update();
        return redirect()->back();
    }

    public function declinehour($id)
    {
        $hour = Hour::find($id);
        $hour->delete();

        return redirect()->back();
    }

    public function pupilsView()
    {
        return view('companies.pupils');
    }

    public function profileView()
    {
        $user = Auth::user();
        $profile = $user->company;

        return view('companies.profile.show', ['user' => $user, 'profile' => $profile]);
    }

    public function profileEdit()
    {
        $user = Auth::user();
        $profile = $user->company;

        return view('companies.profile.edit', ['user' => $user, 'profile' => $profile]);
    }

    public function profileUpdate(Request $request)
    {
        $emailCheck = ($request->email != '') && ($request->email != Auth::user()->email);

        if ($emailCheck) {
            $request->validate([
                'name'           => 'required|string|max:255',
                'email'          => 'required|string|email|max:255|unique:users',
                'password'       => 'required|string|min:6|confirmed',
                'phone_number'   => 'required|numeric',
                'branch'         => 'required|string',
                'description'    => 'string',
                'employs_number' => 'numeric'
            ]);
        } else {
            $request->validate([
                'name'           => 'required|string|max:255',
                'password'       => 'required|string|min:6|confirmed',
                'phone_number'   => 'required|numeric',
                'branch'         => 'required|string',
                'description'    => 'string',
                'employs_number' => 'numeric'
            ]);
        }

        $user = Auth::user();
        $profile = $user->company;

        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $profile->update([
            'phone_number'   => $request->phone_number,
            'branch'         => $request->branch,
            'description'    => $request->description,
            'employs_number' => $request->employs_number
        ]);

        return redirect()->route('company.profileView');
    }
}
