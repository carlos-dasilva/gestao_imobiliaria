@extends('layouts.app')

@section('title', $property->title)

@section('content')
    <div class="row g-4">
        <div class="col-lg-7 order-2 order-lg-1">
            @php
                $images = $property->images->sortBy('sort_order');
                $cover = $images->firstWhere('is_cover', true) ?? $images->first();
                $ordered = $cover ? collect([$cover])->concat($images->where('id','!=',$cover->id)) : collect();
            @endphp

            @if($ordered->isNotEmpty())
                <a href="#" data-bs-toggle="modal" data-bs-target="#galleryModal" data-index="0" class="d-block">
                    <img src="{{ asset('storage/'.$ordered->first()->path) }}" class="img-fluid rounded mb-2" alt="Capa do imóvel" style="height:400px; object-fit:cover; width:100%">
                </a>
                @if($ordered->count() > 1)
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($ordered->slice(1)->values() as $i => $img)
                            <a href="#" data-bs-toggle="modal" data-bs-target="#galleryModal" data-index="{{ $i + 1 }}">
                                <img src="{{ asset('storage/'.$img->path) }}" class="rounded" alt="Foto {{ $i + 2 }}" style="height:90px; width:120px; object-fit:cover">
                            </a>
                        @endforeach
                    </div>
                @endif
            @else
                <img src="{{ asset('img/sem-foto.svg') }}" class="img-fluid rounded mb-2" alt="Sem Foto" style="height:400px; object-fit:cover; width:100%">
            @endif
        </div>
        <div class="col-lg-5 order-1 order-lg-2">
            <h3>{{ $property->title }}</h3>
            <div class="text-muted mb-2">{{ $property->city }} - {{ $property->state }}</div>
            <div class="mb-2">
                <span class="me-3"><i class="bi bi-bounding-box text-secondary"></i> {{ $property->area }} m²</span>
                <span class="me-3"><x-icon name="bed" class="me-1 text-secondary" /> {{ $property->bedrooms }} quartos</span>
                <span class="me-3"><x-icon name="shower" class="me-1 text-secondary" /> {{ $property->bathrooms }} banheiros</span>
                <span class="me-3"><i class="bi bi-car-front text-secondary"></i> {{ $property->garages }} vagas</span>
            </div>
            <div class="h4 brand-text">R$ {{ number_format($property->price,2,',','.') }}</div>
            <p class="mt-3">{!! nl2br(e($property->description)) !!}</p>
        </div>
    </div>

    @if(($ordered ?? collect())->isNotEmpty())
    <!-- Modal com carrossel para galeria -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Galeria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div id="carouselGallery" class="carousel slide" data-bs-ride="false">
                        <div class="carousel-inner">
                            @foreach($ordered as $img)
                                <div class="carousel-item {{ $loop->first ? 'active':'' }}">
                                    <img src="{{ asset('storage/'.$img->path) }}" class="d-block w-100" alt="Imagem" style="max-height:70vh; object-fit:contain">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselGallery" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselGallery" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const galleryModal = document.getElementById('galleryModal');
        galleryModal?.addEventListener('show.bs.modal', event => {
            const trigger = event.relatedTarget;
            const index = parseInt(trigger?.getAttribute('data-index') || '0', 10);
            const carouselEl = document.getElementById('carouselGallery');
            const instance = bootstrap.Carousel.getOrCreateInstance(carouselEl);
            instance.to(index);
        });
    </script>
    @endpush
    @endif
@endsection
