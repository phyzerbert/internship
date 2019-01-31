@extends('layouts.app')

@section('title', 'Requests')

@section('navbar')
    @include('companies.navbar')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Requests</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($requests as $request)
                                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    {{ $request->user->name }} requests to join your company!
                                    <div>
                                        <div class="btn-toolbar">
                                            @if ($request->pivot->state == 0)
                                                <a href="{{ route('company.accept', ['companyPupil' => $request->pivot->id]) }}" class="btn btn-primary" style="width: 100%;">Accept</a>
                                            @else
                                                <button type="button" class="btn btn-success" style="width: 100%;" disabled>Accepted</button>
                                            @endif
                                        </div>
                                        @if (!$request->pivot->state == 1)
                                            <div class="btn-toolbar mt-2">
                                                <a href="{{ route('company.decline', ['companyPupil' => $request->pivot->id]) }}" class="btn btn-danger" style="width: 100%;">Decline</a>
                                            </div>
                                        @endif
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
