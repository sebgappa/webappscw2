@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <page-component :page-id="{{ $pageId }}"></page-component>
        </div>
    </div>
</div>
@endsection