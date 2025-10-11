@extends('admin.layout2')

@section('title','Editar UsuÃ¡rio')

@section('admin-content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.update',$user) }}">
                @csrf @method('PUT')
                @include('admin.users.form', ['user' => $user])
                <button class="btn btn-danger">Atualizar</button>
                <a class="btn btn-outline-secondary" href="{{ route('admin.users.index') }}">Voltar</a>
            </form>
        </div>
    </div>
@endsection


