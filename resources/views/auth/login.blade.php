@extends('layouts.app')

@section('title','Login')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header fw-semibold">Acesso do Administrador</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login.attempt') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Usuário</label>
                            <input name="username" class="form-control" value="{{ old('username') }}" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Lembrar-me</label>
                        </div>
                        <button class="btn btn-danger w-100">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

