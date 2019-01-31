@extends('layouts.app')

@section('title', 'Profile')

@section('navbar')
    @include('pupils.navbar')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profile</div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Name</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>Hobbies</td>
                                <td>{{ $profile->hobbies }}</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>{{ $profile->description }}</td>
                            </tr>
                            <tr>
                                <td>Pitch text</td>
                                <td>{{ $profile->pitch_text }}</td>
                            </tr>
                            <tr>
                                <td>Experience</td>
                                <td>{{ $profile->experience }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="text-right mb-0">
                            <a href="{{ route('pupil.profileEdit') }}" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
