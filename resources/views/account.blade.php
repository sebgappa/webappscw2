@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <account-component :user="{{ Auth::user() }}" dog="{{ $dogImageURL }}"></account-component>
        </div>
    </div>
</div>
@endsection