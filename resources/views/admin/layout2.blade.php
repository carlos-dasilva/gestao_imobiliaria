@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-2 mb-3">
            <div class="list-group">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-2 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 brand-text"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('admin.properties.index') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-2 {{ str_starts_with((string) request()->route()?->getName(), 'admin.properties') ? 'active' : '' }}">
                    <i class="bi bi-building brand-text"></i><span>Imóveis</span>
                </a>
                <a href="{{ route('admin.types.index') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-2 {{ str_starts_with((string) request()->route()?->getName(), 'admin.types') ? 'active' : '' }}">
                    <i class="bi bi-tags brand-text"></i><span>Tipos</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-2 {{ str_starts_with((string) request()->route()?->getName(), 'admin.users') ? 'active' : '' }}">
                    <i class="bi bi-people brand-text"></i><span>Usuários</span>
                </a>
                <a href="{{ route('admin.settings.edit') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-2 {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <i class="bi bi-gear brand-text"></i><span>Configurações</span>
                </a>
                <a href="{{ route('admin.sys-info') }}" class="list-group-item list-group-item-action d-flex align-items-center gap-2 {{ request()->routeIs('admin.sys-info') ? 'active' : '' }}">
                    <i class="bi bi-activity brand-text"></i><span>Diagnóstico</span>
                </a>
            </div>
        </div>
        <div class="col-lg-10">
            @yield('admin-content')
        </div>
    </div>
@endsection
