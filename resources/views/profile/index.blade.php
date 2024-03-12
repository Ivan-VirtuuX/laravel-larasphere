@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex flex-column align-items-center">
            <div class="d-flex flex-column align-items-center">
                <div class=" p-4 mb-4">
                    <div class="d-flex align-items-center justify-content-between column-gap-4">
                        <form method="POST" action="{{route('profile.updateAvatar',  auth()->user())}}">
                            @csrf
                            @method('patch')
                            <change-avatar-button avatar-url="{{ auth()->user()->avatar_url }}">
                                <img class="edit-profile-img" src="{{ auth()->user()->avatar_url }}" alt="avatar">
                            </change-avatar-button>
                        </form>

                        <div class="edit-profile-container">
                            <form method="POST" action="{{route('profile.update',  auth()->user())}}">
                                @csrf
                                @method('patch')
                                <div class="d-flex flex-column row-gap-3">
                                    <div>
                                        <label for="name" class="form-label text-primary fs-5">Логин</label>
                                        <input
                                            id="name"
                                            type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            name="name"
                                            value="{{  auth()->user()->name }}"
                                            placeholder="Логин"
                                            required
                                            autocomplete="name"
                                            autofocus
                                        />
                                    </div>
                                    <button class="btn btn-primary" type="submit">Сохранить</button>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                     </span>
                                    @enderror
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <h1 class="fs-1 fw-bold text-primary text-center">Мои посты</h1>

                <div class="d-flex align-items-center flex-column">
                    @foreach($posts as $post)
                        @include('post.post', compact("post"))
                    @endforeach
                </div>
            </div>
        </div>
@endsection
