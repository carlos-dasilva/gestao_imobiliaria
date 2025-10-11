@extends('admin.layout')

@section('title','Tipos de Imóvel')

@section('admin-content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Tipos de Imóvel</h5>
        <a href="{{ route('admin.types.create') }}" class="btn btn-danger">Novo Tipo</a>
    </div>
    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped align-middle mb-0">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Slug</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($types as $type)
                    <tr>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->slug }}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.types.edit',$type) }}">Editar</a>
                            <form action="{{ route('admin.types.destroy',$type) }}" method="POST" class="d-inline" onsubmit="return confirm('Excluir este tipo?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @if($types->hasPages())
            <div class="card-footer">{{ $types->links() }}</div>
        @endif
    </div>
@endsection

