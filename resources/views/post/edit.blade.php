@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <edit-post-component :page-id="{{ $pageId }}" :post-id="{{ $postId }}"></edit-post-component>
        </div>
    </div>
</div>
@endsection