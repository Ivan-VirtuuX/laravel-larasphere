@extends('layouts.app')
<head>
    <title>Создание поста</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/my-editor.js'])
</head>
@section('content')
    <div class="container">
        <write-form
            btn-href="{{route("posts.create")}}">
        </write-form>
    </div>
@endsection
