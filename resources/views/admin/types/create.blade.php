@extends('admin.layout2')

@section('title','Novo Tipo')

@section('admin-content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.types.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Slug (opcional)</label>
                    <input name="slug" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                <button class="btn btn-danger">Salvar</button>
                <a class="btn btn-outline-secondary" href="{{ route('admin.types.index') }}">Voltar</a>
            </form>
        </div>
    </div>
@endsection


