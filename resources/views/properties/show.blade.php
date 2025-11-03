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
                    <img src="{{ asset('storage/'.$ordered->first()->path) }}" class="img-fluid rounded mb-2" alt="Capa do imÃ³vel" style="height:400px; object-fit:cover; width:100%">
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
            <div class="d-flex align-items-start justify-content-between gap-3">
                <h3 class="mb-0">{{ $property->title }}</h3>
                <button type="button" class="share-btn" data-bs-toggle="modal" data-bs-target="#shareModal" aria-label="Compartilhar imóvel" title="Compartilhar imóvel">
                    <i class="bi bi-share text-secondary"></i>
                </button>
            </div>
            <div class="text-muted mb-2">{{ $property->city }} - {{ $property->state }}</div>
            <div class="mb-2 d-flex flex-wrap align-items-center gap-3 stats">
                @if(($property->area ?? 0) > 0)
                <span class="me-3"><i class="bi bi-bounding-box text-secondary"></i> {{ $property->area }} mÂ²</span>
                @endif
                @if(($property->bedrooms ?? 0) > 0)
                <span class="me-3"><x-icon name="bed" class="me-1 text-secondary" /> {{ $property->bedrooms }} quartos</span>
                @endif
                @if(($property->bathrooms ?? 0) > 0)
                <span class="me-3"><x-icon name="shower" class="me-1 text-secondary" /> {{ $property->bathrooms }} banheiros</span>
                @endif
                @if(($property->garages ?? 0) > 0)
                <span class="me-3"><i class="bi bi-car-front text-secondary"></i> {{ $property->garages }} vagas</span>
                @endif
            </div>
            <div class="h4 brand-text">R$ {{ number_format($property->price,2,',','.') }}</div>
            <p class="mt-3">{!! nl2br(e($property->description)) !!}</p>
            @php( $__settings_btn = \App\Models\SiteSetting::first() )
            @if(!empty($__settings_btn?->whatsapp_url))
                <div class="mt-3">
                    <a href="{{ $__settings_btn->whatsapp_url }}" target="_blank" rel="noopener" class="whatsapp-contact-btn" role="button" aria-label="Fale com sua corretora no WhatsApp">
                        <i class="bi bi-whatsapp"></i>
                        <span>Fale com sua corretora</span>
                    </a>
                </div>
            @endif
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

    <!-- Modal de compartilhamento -->
    <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="shareModalLabel" class="modal-title">Compartilhar Imóvel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div id="shareFeedback" class="alert alert-success py-2 px-3 d-none" role="alert">Link copiado.</div>
                    <input type="text" id="shareHiddenInput" value="{{ request()->fullUrl() }}" class="visually-hidden" tabindex="-1" aria-hidden="true">
                    <div class="row row-cols-2 g-2">
                        <div class="col">
                            <button id="btnCopyLink" type="button" class="btn btn-light w-100 border d-flex align-items-center gap-2" aria-label="Copiar link do imóvel">
                                <i class="bi bi-link-45deg"></i>
                                <span>Copiar Link</span>
                            </button>
                        </div>
                        <div class="col">
                            <button id="btnWhatsapp" type="button" class="btn btn-light w-100 border d-flex align-items-center gap-2" aria-label="Compartilhar no WhatsApp">
                                <i class="bi bi-whatsapp"></i>
                                <span>WhatsApp</span>
                            </button>
                        </div>
                        <div class="col">
                            <button id="btnInstagram" type="button" class="btn btn-light w-100 border d-flex align-items-center gap-2" aria-label="Abrir Instagram com o link copiado">
                                <i class="bi bi-instagram"></i>
                                <span>Instagram</span>
                            </button>
                        </div>
                        <div class="col">
                            <button id="btnTwitter" type="button" class="btn btn-light w-100 border d-flex align-items-center gap-2" aria-label="Compartilhar no X (Twitter)">
                                <i class="bi bi-twitter-x"></i>
                                <span>X (Twitter)</span>
                            </button>
                        </div>
                        <div class="col-12">
                            <button id="btnEmail" type="button" class="btn btn-light w-100 border d-flex align-items-center gap-2 justify-content-center" aria-label="Compartilhar por e-mail">
                                <i class="bi bi-envelope"></i>
                                <span>E-mail</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('head')
    <style>
        .share-btn{ background:transparent !important; border:0 !important; padding:0; display:inline-flex; align-items:center; justify-content:center; line-height:1; }
        .share-btn:hover, .share-btn:focus{ background:transparent !important; box-shadow:none; }
        .share-btn i{ font-size:20px; line-height:1; }
        #shareModal .btn.btn-light.border{ padding:.65rem .75rem; font-weight:500; }
        #shareModal .modal-body{ overflow-x:hidden; }
        .stats > span{ white-space:nowrap; display:inline-flex; align-items:center; }
        .whatsapp-contact-btn{ display:inline-flex; align-items:center; gap:.6rem; background:#25D366; color:#fff !important; text-decoration:none; padding:.9rem 1.2rem; border-radius:14px; font-weight:700; box-shadow:0 6px 14px rgba(37,211,102,.3); transition:all .15s ease; }
        .whatsapp-contact-btn:hover, .whatsapp-contact-btn:focus{ filter:brightness(.95); transform:translateY(-1px); color:#fff !important; }
        .whatsapp-contact-btn i{ font-size:1.3rem; }
        @media (max-width: 576px){ .whatsapp-contact-btn{ width:100%; justify-content:center; border-radius:16px; padding:1rem 1.2rem; } .whatsapp-contact-btn i{ font-size:1.4rem; } }
    </style>
    @endpush

    @push('scripts')
    <script>
        (function(){
            const url = @json(request()->fullUrl());
            const title = @json($property->title);
            const city = @json($property->city);
            const state = @json($property->state);
            const priceNumber = @json((float) $property->price);
            const price = new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(priceNumber);

            const feedback = document.getElementById('shareFeedback');
            let feedbackTimer;
            function showFeedback(message, type='success'){
                if(!feedback) return;
                feedback.classList.remove('d-none','alert-success','alert-danger','alert-info');
                feedback.classList.add('alert-' + type);
                feedback.textContent = message;
                clearTimeout(feedbackTimer);
                feedbackTimer = setTimeout(() => feedback.classList.add('d-none'), 2500);
            }

            const msgClipboard = `Confira este imóvel: ${title} em ${city}/${state}.\nValor: ${price}.\nAcesse fotos e detalhes: ${url}`;
            const msgWhatsApp = msgClipboard; // WhatsApp aceita quebras de linha
            const msgTwitter = `${title} - ${city}/${state} - ${price} ${url}`; // versão enxuta

            async function copyText(text){
                if (navigator.clipboard && window.isSecureContext) {
                    try {
                        await navigator.clipboard.writeText(text);
                        showFeedback('Mensagem copiada!');
                        return true;
                    } catch (_) { /* fallback abaixo */ }
                }
                try {
                    const input = document.getElementById('shareHiddenInput') || (() => {
                        const i = document.createElement('input');
                        i.type = 'text';
                        i.id = 'shareHiddenInput';
                        i.value = text;
                        i.setAttribute('readonly','');
                        i.style.position = 'absolute';
                        i.style.left = '-9999px';
                        document.body.appendChild(i);
                        return i;
                    })();
                    input.value = text;
                    input.removeAttribute('disabled');
                    input.style.display = 'block';
                    input.focus();
                    input.select();
                    input.setSelectionRange(0, text.length);
                    const ok = document.execCommand('copy');
                    input.blur();
                    input.style.display = 'none';
                    showFeedback(ok ? 'Mensagem copiada!' : 'Falha ao copiar.', ok ? 'success' : 'danger');
                    return ok;
                } catch (e) {
                    showFeedback('Falha ao copiar.', 'danger');
                    return false;
                }
            }

            document.getElementById('btnCopyLink')?.addEventListener('click', () => copyText(msgClipboard));

            document.getElementById('btnWhatsapp')?.addEventListener('click', () => {
                const text = encodeURIComponent(msgWhatsApp);
                window.open(`https://wa.me/?text=${text}`,'_blank','noopener');
            });

            document.getElementById('btnInstagram')?.addEventListener('click', () => {
                // Copia a mensagem e abre o Instagram
                copyText(msgClipboard).finally(() => window.open('https://www.instagram.com/', '_blank', 'noopener'));
            });

            document.getElementById('btnTwitter')?.addEventListener('click', () => {
                const params = new URLSearchParams({ text: msgTwitter });
                window.open(`https://twitter.com/intent/tweet?${params.toString()}`,'_blank','noopener');
            });

            document.getElementById('btnEmail')?.addEventListener('click', () => {
                const subject = encodeURIComponent(`Imóvel: ${title}`);
                const body = encodeURIComponent(msgClipboard);
                window.location.href = `mailto:?subject=${subject}&body=${body}`;
            });
        })();
    </script>
    @endpush
@endsection


