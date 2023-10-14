@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="float-start">
            <h1>動画メモ(仮称)</h1>
            <p class="fs-3">お気に入りの動画と<br>
                個人的な感想やメモ書きを<br>
                まとめて管理できるサイトです。</p>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">point1</div>
                    <div class="card-body">動画メモ(仮称)は動画と紐づけされたメモ投稿サイトです。</div>
                </div>
                <div class="card">
                    <div class="card-header">point2</div>
                    <div class="card-body">みんなに勧めたい動画メモは全体公開、個人で楽しみたい動画メモは個人公開に。</div>
                </div>
                <div class="card">
                    <div class="card-header">point3</div>
                    <div class="card-body">タグ設定で類似投稿の管理、検索が可能です。</div>
                </div>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
