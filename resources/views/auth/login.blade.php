@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card form-card mt-4">
                <div class="card-body form-card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="d-flex flex-column align-items-center">
                            <h3 class="form-card-title text-center">Авторизация</h3>

                            <div class="d-flex flex-column row-gap-3 w-100">
                                <form-input
                                    input-id="email"
                                    type="email"
                                    is-error="@error('email') is-invalid @enderror"
                                    oldValue="{{ old('email') }}"
                                    placeholder="Email"
                                ></form-input>

                                <form-input
                                    input-id="password"
                                    type="password"
                                    is-error="@error('password') is-invalid @enderror"
                                    oldValue="{{ old('password') }}"
                                    placeholder="Пароль"
                                ></form-input>

                                @error('email')
                                <span class="invalid-feedback m-0" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center w-100 mt-2 mb-3">
                                <a href="/register" class="text-decoration-none">Регистрация</a>

                                <div class="d-flex justify-content-end w-100">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label text-secondary"
                                               for="remember">Запомнить</label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary rounded-3 form-submit-btn">
                                {{ __('Войти') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
