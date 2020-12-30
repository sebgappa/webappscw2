@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>{{ $page->title}} </h3>
            @foreach ($posts as $post)
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title}}</h5>
                        <p class="card-text"> {{ $post->synopsis }} </p>
                        <a href="{{ route('post.show', ['pageId' => $page->id, 'postId' => $post->id]) }}" class="btn btn-primary">Go to post</a>
                    </div>
                </div>
            @endforeach

            {!! $posts->render() !!}
        </div>
    </div>
</div>
@endsection