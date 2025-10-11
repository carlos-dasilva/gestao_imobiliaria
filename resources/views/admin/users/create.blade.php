@extends('admin.layout2')

@section('title','Novo UsuÃ¡rio')

@section('admin-content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                @include('admin.users.form', ['user' => null])
                <button class="btn btn-danger">Salvar</button>
                <a class="btn btn-outline-secondary" href="{{ route('admin.users.index') }}">Voltar</a>
            </form>
        </div>
    </div>
@endsection


