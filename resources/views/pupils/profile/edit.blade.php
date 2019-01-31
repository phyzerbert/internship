@extends('layouts.app')

@section('title', 'Edit')

@section('navbar')
    @include('pupils.navbar')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit profile</div>
                    <div class="card-body">
                        <form action="{{ route('pupil.profileView') }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-6">
                                    <input type="text" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="hobbies" class="col-md-4 col-form-label text-md-right">Hobbies</label>
                                <div class="col-md-6">
                                    <input type="text" id="hobbies" class="form-control{{ $errors->has('hobbies') ? ' is-invalid' : '' }}" name="hobbies" value="{{ $profile->hobbies }}" required>

                                    @if ($errors->has('hobbies'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('hobbies') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                                <div class="col-md-6">
                                    <input type="text" id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ $profile->description }}" required>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pitch-text" class="col-md-4 col-form-label text-md-right">Pitch text</label>
                                <div class="col-md-6">
                                    <textarea name="pitch_text" id="pitch-text" class="form-control{{ $errors->has('pitch_text') ? ' is-invalid' : '' }}" required>{{ $profile->pitch_text }}</textarea>

                                    @if ($errors->has('pitch_text'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('pitch_text') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="experience" class="col-md-4 col-form-label text-md-right">Experience</label>
                                <div class="col-md-6">
                                    <input type="text" id="experience" class="form-control{{ $errors->has('experience') ? ' is-invalid' : '' }}" name="experience" value="{{ $profile->experience }}" required>

                                    @if ($errors->has('experience'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('experience') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
