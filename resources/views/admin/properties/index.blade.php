@extends('admin.layout2')

@section('title','Imóveis')

@section('admin-content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Imóveis</h5>
        <a href="{{ route('admin.properties.create') }}" class="btn btn-danger">Novo Imóvel</a>
    </div>

    <form class="row g-2 mb-3" method="GET">
        <div class="col-12 col-sm-6 col-md-3">
            <input class="form-control" name="city" value="{{ $filters['city'] ?? '' }}" placeholder="Cidade" />
        </div>
        <div class="col-12 col-sm-6 col-md-2">
            <input type="number" step="0.01" class="form-control" name="max_price" value="{{ $filters['max_price'] ?? '' }}" placeholder="Valor máx." />
        </div>
        <div class="col-12 col-sm-6 col-md-2">
            <select name="type" class="form-select">
                <option value="">Tipo</option>
                @foreach($types as $t)
                    <option value="{{ $t->slug }}" @selected(($filters['type'] ?? '')==$t->slug)>{{ $t->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-4 col-sm-2 col-md-1">
            <input type="number" min="0" class="form-control" name="bedrooms" value="{{ $filters['bedrooms'] ?? '' }}" placeholder="Quartos" />
        </div>
        <div class="col-4 col-sm-2 col-md-1">
            <input type="number" min="0" class="form-control" name="bathrooms" value="{{ $filters['bathrooms'] ?? '' }}" placeholder="Ban" />
        </div>
        <div class="col-4 col-sm-2 col-md-1">
            <input type="number" min="0" class="form-control" name="garages" value="{{ $filters['garages'] ?? '' }}" placeholder="Vagas" />
        </div>
        <div class="col-12 col-md-2">
            <input type="number" min="0" class="form-control" name="min_area" value="{{ $filters['min_area'] ?? '' }}" placeholder="m² min" />
        </div>
        <div class="col-12 col-md-12">
            <button class="btn btn-outline-secondary">Filtrar</button>
        </div>
    </form>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped align-middle mb-0">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Cidade</th>
                        <th>Status</th>
                        <th>Visualizações</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($properties as $p)
                    <tr>
                        <td>{{ $p->title }}</td>
                        <td>{{ $p->type->name ?? '-' }}</td>
                        <td>{{ $p->city }}/{{ $p->state }}</td>
                        <td>{{ $p->status }}</td>
                        <td>{{ $p->views }}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.properties.edit',$p) }}">Editar</a>
                            <form action="{{ route('admin.properties.destroy',$p) }}" method="POST" class="d-inline" onsubmit="return confirm('Excluir este imóvel?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">{{ $properties->links() }}</div>
    </div>
@endsection

