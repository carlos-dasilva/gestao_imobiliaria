@extends('admin.layout2')

@section('title','Usuários')

@section('admin-content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Usuários</h5>
        <a href="{{ route('admin.users.create') }}" class="btn btn-danger">Novo Usuário</a>
    </div>
    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped align-middle mb-0">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Usuário</th>
                        <th>E-mail</th>
                        <th>Admin?</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $u)
                    <tr>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->username }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{!! $u->is_admin ? '<span class="badge bg-success">Sim</span>':'<span class="badge bg-secondary">Não</span>' !!}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.users.edit',$u) }}">Editar</a>
                            <form action="{{ route('admin.users.destroy',$u) }}" method="POST" class="d-inline" onsubmit="return confirm('Excluir este usuário?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="card-footer">{{ $users->links() }}</div>
        @endif
    </div>
@endsection

