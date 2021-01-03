@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <find-pages-component :user-id="{{ Auth::user()->id }}"></find-pages-component>
        </div>
    </div>
</div>
@endsection