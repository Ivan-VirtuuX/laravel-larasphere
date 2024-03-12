@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="fs-1 fw-bold text-primary text-center">Популярные посты</h1>

        <div class="d-flex align-items-center flex-column">
            @foreach($posts as $post)
                @include('post.post', compact("post"))
            @endforeach
        </div>
    </div>
@endsection
