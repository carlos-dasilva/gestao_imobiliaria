@extends('layouts.app')

@section('title','Home')

@section('content')
    <div class="row g-3 align-items-center mb-4">
        <div class="col-lg-8">
            <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($mostViewed as $i => $p)
                        <div class="carousel-item {{ $i===0 ? 'active':'' }}">
                            <div class="card border-0">
                                <div class="row g-0">
                                    <div class="col-md-6">
                                        @php $img = $p->images->first(); @endphp
                                        <img src="{{ $img ? \Illuminate\Support\Facades\Storage::url($img->path) : asset('img/sem-foto.svg') }}" class="d-block w-100" alt="{{ $img ? $p->title : 'Sem Foto' }}" style="height:300px; object-fit:cover">
                                    </div>
                                    <div class="col-md-6 p-3">
                                        <h5 class="card-title mb-2">{{ $p->title }}</h5>
                                        <div class="text-muted mb-2">{{ $p->city }} - {{ $p->state }}</div>
                                        <div class="mb-2">
                                            <span class="me-3"><i class="bi bi-arrows-angle-expand"></i> {{ $p->area }} m²</span>
                                            <span class="me-3"><i class="bi bi-bed"></i> {{ $p->bedrooms }}</span>
                                            <span class="me-3"><i class="bi bi-droplet"></i> {{ $p->bathrooms }}</span>
                                            <span class="me-3"><i class="bi bi-car-front"></i> {{ $p->garages }}</span>
                                        </div>
                                        <div class="h5 brand-text">R$ {{ number_format($p->price,2,',','.') }}</div>
                                        <a href="{{ route('properties.show',$p->slug) }}" class="btn btn-outline-danger mt-2">Ver detalhes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header fw-semibold">Filtros</div>
                <div class="card-body">
                    <form method="GET" action="{{ route('properties.index') }}">
                        <div class="mb-2">
                            <label class="form-label">Cidade</label>
                            <input name="city" value="{{ $filters['city'] ?? '' }}" class="form-control" />
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Valor máximo</label>
                            <input type="number" step="0.01" name="max_price" value="{{ $filters['max_price'] ?? '' }}" class="form-control" />
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Tipo</label>
                            <select name="type" class="form-select">
                                <option value="">Todos</option>
                                @foreach($types as $t)
                                    <option value="{{ $t->slug }}" @selected(($filters['type'] ?? '')==$t->slug)>{{ $t->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row g-2">
                            <div class="col-4">
                                <label class="form-label">Quartos</label>
                                <input type="number" min="0" name="bedrooms" value="{{ $filters['bedrooms'] ?? '' }}" class="form-control" />
                            </div>
                            <div class="col-4">
                                <label class="form-label">Banheiros</label>
                                <input type="number" min="0" name="bathrooms" value="{{ $filters['bathrooms'] ?? '' }}" class="form-control" />
                            </div>
                            <div class="col-4">
                                <label class="form-label">Vagas</label>
                                <input type="number" min="0" name="garages" value="{{ $filters['garages'] ?? '' }}" class="form-control" />
                            </div>
                        </div>
                        <div class="mt-2">
                            <label class="form-label">Metragem mínima (m²)</label>
                            <input type="number" min="0" name="min_area" value="{{ $filters['min_area'] ?? '' }}" class="form-control" />
                        </div>
                        <button class="btn btn-danger mt-3 w-100">Pesquisar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mb-3">Últimos imóveis</h4>
    <div class="row g-3">
        @forelse($list as $p)
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card property-card h-100">
                    @php $img = $p->images->first(); @endphp
                    <img src="{{ $img ? \Illuminate\Support\Facades\Storage::url($img->path) : asset('img/sem-foto.svg') }}" class="card-img-top" alt="{{ $img ? $p->title : 'Sem Foto' }}">
                    <div class="card-body">
                        <div class="small text-muted">{{ $p->city }} - {{ $p->state }}</div>
                        <h6 class="card-title">{{ $p->title }}</h6>
                        <div class="small mb-2">
                            <span class="me-2"><i class="bi bi-arrows-angle-expand"></i> {{ $p->area }} m²</span>
                            <span class="me-2"><i class="bi bi-bed"></i> {{ $p->bedrooms }}</span>
                            <span class="me-2"><i class="bi bi-droplet"></i> {{ $p->bathrooms }}</span>
                            <span class="me-2"><i class="bi bi-car-front"></i> {{ $p->garages }}</span>
                        </div>
                        <div class="fw-semibold brand-text">R$ {{ number_format($p->price,2,',','.') }}</div>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="{{ route('properties.show',$p->slug) }}" class="btn btn-outline-danger w-100">Ver detalhes</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12"><div class="alert alert-info">Nenhum imóvel encontrado.</div></div>
        @endforelse
    </div>
@endsection
