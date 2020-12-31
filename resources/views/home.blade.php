@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($pages as $page)
                <div class="card mb-4">
                     <div class="card-body">
                        <h5 class="card-title">{{ $page->title}}</h5>
                        <p class="card-text"> {{ $page->description }} </p>
                        <a href="{{ route('page.show', ['id' => $page->id]) }}" class="btn btn-primary">Go to page</a>
                    </div>
                </div>
            @endforeach

            {!! $pages->render() !!}
        </div>
    </div>
</div>
@endsection
