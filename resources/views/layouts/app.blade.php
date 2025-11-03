<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php( $__settings = \App\Models\SiteSetting::first() )
    @php( $siteName = trim($__settings->site_name ?? '') !== '' ? trim($__settings->site_name) : 'Gestão Imobiliária' )
    <title>{{ $siteName }} - @yield('title','')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    @if(!empty($__settings?->favicon_path))
        <link rel="icon" href="{{ asset('storage/' . $__settings->favicon_path) }}">
    @else
        <link rel="icon" type="image/svg+xml" href="{{ asset('img/favicon.svg') }}">
    @endif
    <style>
        html, body{ margin:0; padding:0; overflow-x:hidden; }
        :root{ --primary: {{ trim($__settings->primary_color ?? '') !== '' ? trim($__settings->primary_color) : '#CA1919' }}; --muted: {{ trim($__settings->secondary_color ?? '') !== '' ? trim($__settings->secondary_color) : '#D9D9D9' }}; --bg: {{ trim($__settings->background_color ?? '') !== '' ? trim($__settings->background_color) : '#FFFFFF' }}; --nav-height: 64px; }
        .brand-bg{ background-color: var(--primary); }
        .brand-text{ color: var(--primary); }
        .muted-bg{ background-color: var(--muted); }
        .nav-link.active{ font-weight: 600; }
        .property-card img{ object-fit: cover; height: 180px; }
        .logo-header{ height: 50px; width: 100px; border-radius: 6px; }
        .logo-footer{ height: 100px; width: 200px; border-radius: 6px; }
        .navbar.brand-bg{ border-bottom: 3px solid var(--muted); z-index: 1100; position: fixed; top: 0; left: 0; right: 0; width:100%; padding-top: env(safe-area-inset-top); }
        .navbar.brand-bg .navbar-brand,.navbar.brand-bg .nav-link{ color: rgba(255,255,255,.95); }
        .navbar.brand-bg .nav-link:hover,.navbar.brand-bg .nav-link:focus{ color:#fff; text-decoration: underline; text-underline-offset:4px; }
        .navbar .navbar-brand{ white-space: normal; word-break: break-word; }
        @media (max-width: 576px){ .navbar .navbar-brand{ max-width: 65vw; } }
        .footer{ background: var(--muted); color:#111827; }
        .footer a{ color:#111827; text-decoration:none; }
        .footer a:hover{ color:var(--primary); text-decoration:underline; }
        .footer .heading{ color:#111827; font-weight:600; font-size:0.95rem; letter-spacing:.3px; }
        .footer-accent{ height:4px; background:linear-gradient(90deg, var(--primary), #e24a4a); }
        .social a{ display:inline-flex; align-items:center; justify-content:center; width:36px; height:36px; border-radius:50%; background:rgba(202,25,25,.12); color:var(--primary); border:1px solid rgba(202,25,25,.25); transition:all .2s ease; }
        .social a:hover{ background:var(--primary); color:#fff; transform:translateY(-2px); }
        body{ background-color: var(--bg); padding-top: calc(var(--nav-height) + env(safe-area-inset-top)); }
        @media (max-width: 576px){ :root{ --nav-height: 72px; } }
        /* Corrige saltos/padding no topo quando modal abre no mobile */
        .modal-open { padding-right: 0 !important; overflow-x:hidden; }
        .modal-open .sticky-top, .modal-open .fixed-top { padding-right: 0 !important; }
        /* Garante barra colada no topo enquanto o modal está aberto */
        .modal-open .navbar.brand-bg{ position: fixed !important; top:0 !important; left:0; right:0; width:100%; }
    </style>
    @stack('head')
    @yield('head')
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark brand-bg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="/">
                <img src="{{ !empty($__settings?->logo_path) ? asset('storage/' . $__settings->logo_path) : asset('img/logo.svg') }}" alt="Logo" class="logo-header"/>
                {{ $siteName }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse align-items-center" id="mainNav">
                <ul class="navbar-nav ms-3 me-auto gap-1">
                    <li class="nav-item"><a class="nav-link {{ request()->is('imoveis*') ? 'active' : '' }}" href="{{ route('properties.index') }}">Imóveis</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Quem Somos</a></li>
                </ul>
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    @auth
                        <li class="nav-item"><a class="nav-link" href="/admin">Admin</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
                            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">@csrf</form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4 flex-grow-1">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="mt-auto footer">
        <div class="footer-accent"></div>
        <div class="container py-5">
            <div class="row gy-4">
                <div class="col-12 col-lg-4">
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <img src="{{ !empty($__settings?->logo_path) ? asset('storage/' . $__settings->logo_path) : asset('img/logo.svg') }}" alt="Logo" class="logo-footer"/>
                        <div class="fs-5 fw-semibold">{{ $siteName }}</div>
                    </div>
                    @php( $__about = \App\Models\AboutPage::first() )
                    <div class="small">
                        @if(!empty($__about?->who_i_am))
                            {{ $__about->who_i_am }}
                        @else
                        Atendimento personalizado por corretora de imóveis autônoma.
                        Você navega pelos imóveis e fala direto com a profissional para tirar dúvidas e agendar visitas.
                        @endif
                    </div>
                    </div>
                <div class="col-6 col-lg-3">
                    <div class="heading mb-2">Navegação</div>
                    <ul class="list-unstyled small mb-0">
                        <li><a href="/" class="d-inline-flex align-items-center gap-2"><i class="bi bi-house-door"></i> Início</a></li>
                        <li><a href="{{ route('properties.index') }}" class="d-inline-flex align-items-center gap-2"><i class="bi bi-building"></i> Imóveis</a></li>
                        <li><a href="{{ route('about') }}" class="d-inline-flex align-items-center gap-2"><i class="bi bi-people"></i> Quem Somos</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="heading mb-2">Atendimento</div>
                    <ul class="list-unstyled small mb-2">
                        @php($__settings = \App\Models\SiteSetting::first())
                        @if(!empty($__settings?->email))
                          <li class="d-flex align-items-center gap-2"><i class="bi bi-envelope"></i> {{ $__settings->email }}</li>
                        @endif
                        @if(!empty($__settings?->phone))
                          <li class="d-flex align-items-center gap-2"><i class="bi bi-telephone"></i> {{ $__settings->phone }}</li>
                        @endif
                        @if(!empty($__settings?->creci))
                          <li class="d-flex align-items-center gap-2"><i class="bi bi-person-badge"></i> CRECI: {{ $__settings->creci }}</li>
                        @endif
                    </ul>
                    <div class="heading mb-2">Siga nas redes</div>
                    <div class="d-flex gap-2 social">
                        @if(!empty($__settings?->facebook_url))
                          <a href="{{ $__settings->facebook_url }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        @endif
                        @if(!empty($__settings?->instagram_url))
                          <a href="{{ $__settings->instagram_url }}" target="_blank" rel="noopener" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        @endif
                        @if(!empty($__settings?->linkedin_url))
                          <a href="{{ $__settings->linkedin_url }}" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                        @endif
                        @if(!empty($__settings?->youtube_url))
                          <a href="{{ $__settings->youtube_url }}" target="_blank" rel="noopener" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                        @endif
                        @if(!empty($__settings?->whatsapp_url))
                          <a href="{{ $__settings->whatsapp_url }}" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-lg-2">
                    <div class="heading mb-2">Institucional</div>
                    <ul class="list-unstyled small mb-0">
                        <li><a href="{{ route('about') }}">Quem Somos</a></li>
                        <li><a href="{{ route('privacy') }}">Política de Privacidade</a></li>
                        <li><a href="{{ route('terms') }}">Termos de Uso</a></li>
                    </ul>
                </div>
            </div>
            <hr class="border-secondary opacity-25 my-4">
                <div class="d-flex flex-column flex-md-row justify-content-between small">
                <div>&copy; {{ date('Y') }} {{ $siteName }}. Todos os direitos reservados.</div>
                <div>Feito com amor para facilitar sua busca.</div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function(){
            function resetModalPadding(){
                try{
                    document.body && (document.body.style.paddingRight = '0');
                    document.querySelectorAll('.fixed-top, .sticky-top').forEach(function(el){
                        el.style.paddingRight = '0';
                        el.style.marginRight = '0';
                    });
                }catch(e){}
            }
            document.addEventListener('show.bs.modal', resetModalPadding);
            document.addEventListener('shown.bs.modal', resetModalPadding);
            document.addEventListener('hide.bs.modal', resetModalPadding);
            document.addEventListener('hidden.bs.modal', function(){
                // limpa estilos inline que possam ter sido aplicados
                document.querySelectorAll('.fixed-top, .sticky-top').forEach(function(el){
                    el.style.paddingRight = '';
                    el.style.marginRight = '';
                });
                if(document.body){ document.body.style.paddingRight = ''; }
            });
        })();
    </script>
    @stack('scripts')
</body>
</html>
