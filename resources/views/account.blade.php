@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12 ml-5">
        <div class="card" style="width: 18rem;">
            <div class="text-center">
                <img src="{{ asset('images/user-circle-solid.svg') }}" class="card-img-top mt-3" style="width:100px;height:100px;">
            </div>
            <div class="card-body">
                <h5 class="card-title">{{Auth::user()->name}}</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Email: {{Auth::user()->email}}</li>
                <li class="list-group-item">Birthday: June 24 1999</li>
            </ul>
            <div class="card-body">
                <a href="#" class="btn btn-primary">Change information</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 ml-5 py-2 py-md-5">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" routerLinkActive="active" href="">Comments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" routerLinkActive="active" href="">Posts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" routerLinkActive="active" href="">Communities</a>
            </li>
        </ul>
    </div>
</div>
@endsection