@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card form-card mt-4">
                <div class="card-body form-card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="d-flex flex-column align-items-center">
                            <h3 class="form-card-title text-center">Регистрация</h3>

                            <div class="d-flex flex-column row-gap-3 w-100">
                                <form-input
                                    input-id="name"
                                    type="text"
                                    is-error="@error('name') is-invalid @enderror"
                                    oldValue="{{ old('name') }}"
                                    placeholder="Логин"
                                ></form-input>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <form-input
                                    input-id="email"
                                    type="email"
                                    is-error="@error('email') is-invalid @enderror"
                                    oldValue="{{ old('email') }}"
                                    placeholder="Email"
                                ></form-input>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <form-input
                                    input-id="password"
                                    type="password"
                                    is-error="@error('password') is-invalid @enderror"
                                    oldValue="{{ old('password') }}"
                                    placeholder="Пароль"
                                ></form-input>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <form-input
                                    input-id="password"
                                    type="password"
                                    is-error="@error('password') is-invalid @enderror"
                                    oldValue="{{ old('password') }}"
                                    placeholder="Повторите пароль"
                                    autocompleteValue="new-password"
                                    name="password_confirmation"
                                    id="password-confirm"
                                ></form-input>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="d-flex  align-items-center w-100 mt-2 mb-3">
                                <a href="/login" class="text-decoration-none">Авторизация</a>
                            </div>
                            <button type="submit" class="btn btn-primary rounded-3 form-submit-btn">
                                {{ __('Зарегистрироваться') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
