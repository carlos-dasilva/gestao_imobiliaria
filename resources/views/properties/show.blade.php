@extends('layouts.app')

@section('title', $property->title)

@section('content')
    <div class="row g-4">
        <div class="col-lg-7">
            <div class="row g-2">
                @foreach($property->images as $img)
                    <div class="col-6 col-md-4">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#galleryModal" data-index="{{ $loop->index }}">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($img->path) }}" class="img-fluid rounded" alt="Imagem {{ $loop->iteration }}" style="height:140px; object-fit:cover; width:100%">
                        </a>
                    </div>
                @endforeach
                @if($property->images->isEmpty())
                    <img src="{{ asset('img/sem-foto.svg') }}" class="img-fluid rounded" alt="Sem Foto" style="height:300px; object-fit:cover; width:100%">
                @endif
            </div>
        </div>
        <div class="col-lg-5">
            <h3>{{ $property->title }}</h3>
            <div class="text-muted mb-2">{{ $property->city }} - {{ $property->state }}</div>
            <div class="mb-2">
                <span class="me-3"><i class="bi bi-arrows-angle-expand"></i> {{ $property->area }} m²</span>
                <span class="me-3"><i class="bi bi-bed"></i> {{ $property->bedrooms }} quartos</span>
                <span class="me-3"><i class="bi bi-droplet"></i> {{ $property->bathrooms }} banheiros</span>
                <span class="me-3"><i class="bi bi-car-front"></i> {{ $property->garages }} vagas</span>
            </div>
            <div class="h4 brand-text">R$ {{ number_format($property->price,2,',','.') }}</div>
            <p class="mt-3">{!! nl2br(e($property->description)) !!}</p>
        </div>
    </div>

    <!-- Modal com carrossel -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Galeria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="carouselGallery" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($property->images as $img)
                                <div class="carousel-item {{ $loop->first ? 'active':'' }}">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($img->path) }}" class="d-block w-100" alt="..." style="max-height:540px; object-fit:contain">
                                </div>
                            @endforeach
                            @if($property->images->isEmpty())
                                <div class="carousel-item active">
                                    <img src="{{ asset('img/sem-foto.svg') }}" class="d-block w-100" alt="Sem Foto" style="max-height:540px; object-fit:contain">
                                </div>
                            @endif
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
            const index = trigger?.getAttribute('data-index');
            const carousel = document.getElementById('carouselGallery');
            const instance = bootstrap.Carousel.getOrCreateInstance(carousel);
            if(index) instance.to(parseInt(index));
        });
    </script>
    @endpush
@endsection
