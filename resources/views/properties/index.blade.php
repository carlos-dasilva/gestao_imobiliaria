@extends('layouts.app')

@section('title','Imóveis')

@section('content')
    <h4 class="mb-3">Pesquisar Imóveis</h4>
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
            <button class="btn btn-danger">Aplicar</button>
            <a href="{{ route('properties.index') }}" class="btn btn-outline-secondary">Limpar</a>
        </div>
    </form>

    <div class="row g-3">
        @foreach($properties as $p)
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card property-card h-100">
                    @php $img = $p->images->first(); @endphp
                    <img src="{{ $img ? asset('storage/'.$img->path) : asset('img/sem-foto.svg') }}" class="card-img-top" alt="{{ $img ? $p->title : 'Sem Foto' }}">
                    <div class="card-body">
                        <div class="small text-muted">{{ $p->city }} - {{ $p->state }}</div>
                        <h6 class="card-title">{{ $p->title }}</h6>
                        <div class="small mb-2">
                            <span class="me-2"><i class="bi bi-bounding-box text-secondary"></i> {{ $p->area }} m²</span>
                            <span class="me-2"><x-icon name="bed" class="me-1 text-secondary" /> {{ $p->bedrooms }}</span>
                            <span class="me-2"><x-icon name="shower" class="me-1 text-secondary" /> {{ $p->bathrooms }}</span>
                            <span class="me-2"><i class="bi bi-car-front text-secondary"></i> {{ $p->garages }}</span>
                        </div>
                        <div class="fw-semibold brand-text">R$ {{ number_format($p->price,2,',','.') }}</div>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="{{ route('properties.show',$p->slug) }}" class="btn btn-outline-danger w-100">Ver detalhes</a>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-12">
            {{ $properties->links() }}
        </div>
    </div>
@endsection
