@extends('admin.layout2')

@section('title','Configurações')

@section('admin-content')
<div class="card">
  <div class="card-header fw-semibold">Configurações do Site</div>
  <div class="card-body">
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row g-3">
        <div class="col-12">
          <label class="form-label">Nome do Sistema</label>
          <input name="site_name" class="form-control" maxlength="35" value="{{ old('site_name', $settings->site_name ?? '') }}" placeholder="Ex.: Gestão Imobiliária">
          <div class="form-text">Máximo de 35 caracteres. Quando preenchido, substitui "Gestão Imobiliária" em todo o site.</div>
        </div>
        <div class="col-md-6">
          <label class="form-label">E-mail</label>
          <input name="email" type="email" class="form-control" value="{{ old('email', $settings->email ?? '') }}">
        </div>
        <div class="col-md-6">
          <label class="form-label">Telefone</label>
          <input name="phone" class="form-control" value="{{ old('phone', $settings->phone ?? '') }}">
        </div>
        <div class="col-md-6">
          <label class="form-label">CRECI</label>
          <input name="creci" class="form-control" value="{{ old('creci', $settings->creci ?? '') }}" placeholder="Ex.: 12345-F">
        </div>

        <div class="col-md-6">
          <label class="form-label">Logo</label>
          <input type="file" name="logo" class="form-control" accept=".png,.jpg,.jpeg,.svg,.webp">
          <div class="form-text">Padrão de exibição: 100px de altura e 200px de largura (recomendado PNG/SVG, fundo transparente).</div>
          @if(!empty($settings?->logo_path))
            <div class="mt-2">
              <img src="{{ asset('storage/' . $settings->logo_path) }}" alt="Logo atual" style="height:100px;width:200px">
            </div>
          @endif
        </div>

        <div class="col-md-6">
          <label class="form-label">Favicon</label>
          <input type="file" name="favicon" class="form-control" accept=".ico,.png,.svg">
          <div class="form-text">Recomendado: .ico 32x32 ou PNG/SVG quadrado.</div>
          @if(!empty($settings?->favicon_path))
            <div class="mt-2">
              <img src="{{ asset('storage/' . $settings->favicon_path) }}" alt="Favicon atual" style="max-height:32px">
            </div>
          @endif
        </div>

        <div class="col-md-6">
          <label class="form-label">Facebook URL</label>
          <input name="facebook_url" class="form-control" value="{{ old('facebook_url', $settings->facebook_url ?? '') }}" placeholder="https://facebook.com/sua-pagina">
        </div>
        <div class="col-md-6">
          <label class="form-label">Instagram URL</label>
          <input name="instagram_url" class="form-control" value="{{ old('instagram_url', $settings->instagram_url ?? '') }}" placeholder="https://instagram.com/seu-perfil">
        </div>
        <div class="col-md-6">
          <label class="form-label">LinkedIn URL</label>
          <input name="linkedin_url" class="form-control" value="{{ old('linkedin_url', $settings->linkedin_url ?? '') }}" placeholder="https://linkedin.com/in/seu-perfil">
        </div>
        <div class="col-md-6">
          <label class="form-label">YouTube URL</label>
          <input name="youtube_url" class="form-control" value="{{ old('youtube_url', $settings->youtube_url ?? '') }}" placeholder="https://youtube.com/@seu-canal">
        </div>
        <div class="col-md-6">
          <label class="form-label">WhatsApp URL</label>
          <input name="whatsapp_url" class="form-control" value="{{ old('whatsapp_url', $settings->whatsapp_url ?? '') }}" placeholder="https://wa.me/55DDDNUMERO">
        </div>

        <div class="col-12">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="system_log_enabled" name="system_log_enabled" {{ old('system_log_enabled', $settings->system_log_enabled ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="system_log_enabled">Log de Sistema</label>
          </div>
          <div class="form-text">Deixar este campo sempre desmarcado</div>
        </div>
      </div>
      <div class="mt-3 d-flex gap-2">
        <button class="btn btn-danger">Salvar</button>
        <a class="btn btn-outline-secondary" href="{{ route('admin.dashboard') }}">Voltar</a>
      </div>
    </form>
  </div>
</div>
@endsection
