@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-2 mb-3">
            <div class="list-group">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
                <a href="{{ route('admin.properties.index') }}" class="list-group-item list-group-item-action">Imóveis</a>
                <a href="{{ route('admin.types.index') }}" class="list-group-item list-group-item-action">Tipos</a>
                <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">Usuários</a>
            </div>
        </div>
        <div class="col-lg-10">
            @yield('admin-content')
        </div>
    </div>
@endsection

