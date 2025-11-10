@extends('admin.layout2')

@section('title','Editar Tipo')

@section('admin-content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.types.update',$type) }}">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input name="name" class="form-control" required value="{{ old('name',$type->name) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Slug (opcional)</label>
                    <input name="slug" class="form-control" value="{{ old('slug',$type->slug) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea name="description" class="form-control">{{ old('description',$type->description) }}</textarea>
                </div>
                <button class="btn btn-danger">Atualizar</button>
                <a class="btn btn-outline-secondary" href="{{ route('admin.types.index') }}">Voltar</a>
            </form>
        </div>
    </div>
@endsection


