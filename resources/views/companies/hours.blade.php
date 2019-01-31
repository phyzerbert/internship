@extends('layouts.app')

@section('title', 'Hours')

@section('navbar')
    @include('teachers.navbar')
@endsection

@section('content')
    <div class="container">
        <div class="justify-content-center row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Hour Requests</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($hours as $hour)
                                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    
                                    <div class="justify-content-center row" style="width: 100%;">
                                        <div class="col-md-5">
                                            <?php
                                                $pupil_name = DB::table('users')->find($hour->pupil_id)->name;
                                            ?>
                                            <p><span style="color:green;font-size:1.3em;">{{ $pupil_name }}</span> as requested to accept his hours</p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span style="color:green;">Weeknumbers: </span>{{ $hour->week }}
                                                </div>
                                                <div class="col-md-6">
                                                    <span style="color:green;">Hours: </span>{{ $hour->hour }}
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="col-md-7">
                                            <div class="row">                                            
                                                <div class="col-md-8">
                                                    <span style="color:green;">Description : </span>{{$hour->description}}
                                                </div>
                                                <div class="col-md-4 btn-toolbar">
                                                    @if ($hour->state == 0)
                                                        <a href="{{ route('company.accepthours', ['companyPupil' => $hour->id]) }}" class="btn btn-primary" style="width: 100%;">Accept</a>
                                                        <a href="{{ route('company.declinehours', ['companyPupil' => $hour->id]) }}" class="btn btn-danger" style="width: 100%;margin-top:10px;">Decline</a>
                                                    @else
                                                        <button type="button" class="btn btn-success" style="width: 100%;" disabled>Accepted</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
