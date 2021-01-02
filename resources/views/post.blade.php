@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <post-component :post-id="{{ $postId }}" :page-id="{{ $pageId }}"></post-component>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <comment-component :user-id="{{ Auth::user()->id }}" :post-id="{{ $postId }}"></comment-component>
        </div>
    </div>
</div>
@endsection