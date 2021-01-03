@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <page-component :page-id="{{ $pageId }}" :user-id="{{ Auth::user()->id }}"></page-component>
        </div>
    </div>
</div>
@endsection