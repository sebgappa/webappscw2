@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <home-component :user-id="{{ Auth::user()->id }}"></home-component>
        </div>
    </div>
</div>
@endsection
