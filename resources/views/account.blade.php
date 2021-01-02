@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <account-component :user="{{ Auth::user() }}"></account-component>
        </div>
    </div>
</div>
@endsection