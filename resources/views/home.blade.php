@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($posts as $post)
                <div class="card">
                    <div class="card-header">
                        {{ $post->title }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
