@extends('layouts.app')

@section('title', 'Companies')

@section('navbar')
    @include('pupils.navbar')
@endsection

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Joined Company</div>
                    <div class="card-body">
                        <!-- <form action="{{ route('pupil.searchView') }}" method="POST" class="form-inline my-2 justify-content-end">
                            @csrf
                            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form> -->
                        <ul class="list-group">
                        <?php $companyname = ""; ?>
                            @foreach ($mycompanies as $mycompany)
                                <?php
                                    $my_company_id = DB::table('companies')->find($mycompany->company_id)->user_id;
                                    $my_company_name = DB::table('users')->find($my_company_id)->name;

                                ?>
                                <li class="list-group-item list-group-item-action justify-content-between align-items-center">
                                    <p>You are now working at <span style="color:green;font-size:1.3em;">{{$my_company_name}}</span>.</p>
                                    <p>Send in your hours.</p>
                                    
                                    <form action="{{ route('pupil.requesthours') }}" method="POST" class="my-2 justify-content-end">
                                        @csrf
                                        <input type="hidden" name="company" id="company" value="{{$mycompany->company_id}}">
                                        <div class="container">
                                            <div class="form-group row">
                                                <label for="name" class="col-md-4 col-form-label text-md-right">Week Number</label>
                                                <div class="col-md-6">
                                                    <input type="text" id="week" class="form-control" name="week" value="" required autofocus>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="name" class="col-md-4 col-form-label text-md-right">Hours</label>
                                                <div class="col-md-6">
                                                    <input type="text" id="hours" class="form-control" name="hours" value="" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="name" class="col-md-4 col-form-label text-md-right">Description</label>
                                                <div class="col-md-6">
                                                    <textarea name="description" id="description" class="form-control" rows="5"></textarea>
                                                </div>
                                            </div>

                                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="float:right;">Send In Hours</button>
                                        </div>
                                    </form>
                                </li><br />
                            @endforeach
                        </ul>
                        <div class="paginator mt-2 float-right">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
