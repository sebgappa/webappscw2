@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <create-post-component :page-id="{{ $pageId }}"></create-post-component>
        </div>
    </div>
</div>
@endsection