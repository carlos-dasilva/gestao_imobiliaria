@extends('layouts.app')

@section('title','Quem Somos')

@section('content')
<div class="row g-4">
  <div class="col-12 col-lg-8">
    @php($about = \App\Models\AboutPage::with('values')->first())
    @if(!empty($about?->who_i_am))
      <h2 class="mb-3">Quem Sou</h2>
      <p>{{ $about->who_i_am }}</p>
    @endif
    @if(!empty($about?->purpose))
      <h4 class="mt-4">Propósito</h4>
      <p>{{ $about->purpose }}</p>
    @endif
    @if(!empty($about?->how_i_work))
      <h4 class="mt-4">Como trabalho</h4>
      <p>{{ $about->how_i_work }}</p>
    @endif
    @if(!empty($about) && $about->values->count() > 0)
      <h4 class="mt-4">Valores</h4>
      <ul>
        @foreach($about->values as $val)
          <li>{{ $val->value }}</li>
        @endforeach
      </ul>
    @endif
  </div>
  <div class="col-12 col-lg-4">
    <div class="card">
      <div class="card-header fw-semibold">Atendimento</div>
      <div class="card-body">
        @php($__settings = \App\Models\SiteSetting::first())
        @if(!empty($__settings?->email))
          <div class="mb-2"><i class="bi bi-envelope"></i> {{ $__settings->email }}</div>
        @endif
        @if(!empty($__settings?->phone))
          <div class="mb-2"><i class="bi bi-telephone"></i> {{ $__settings->phone }}</div>
        @endif
        @if(!empty($__settings?->creci))
          <div class="text-muted small">CRECI: {{ $__settings->creci }}</div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection

