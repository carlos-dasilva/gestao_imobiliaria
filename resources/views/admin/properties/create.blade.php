@extends('admin.layout')

@section('title','Novo Imóvel')

@section('admin-content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.properties.store') }}" enctype="multipart/form-data">
                @csrf
                @include('admin.properties.form', ['property' => null])
                <button class="btn btn-danger">Salvar</button>
                <a class="btn btn-outline-secondary" href="{{ route('admin.properties.index') }}">Voltar</a>
            </form>
        </div>
    </div>
@endsection

