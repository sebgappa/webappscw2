@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($posts as $post)
                <div class="card mb-4">
                    <a href="{{ route('posts.show', ['id' => $post->id]) }}">
                        <div class="card-header">
                            {{ $post->title }}
                        </div>
                    </a>
                    <div class="card-body">
                        {{ $post->synopsis }}
                    </div>
                </div>
            @endforeach

            {!! $posts->render() !!}
        </div>
    </div>
</div>
@endsection
