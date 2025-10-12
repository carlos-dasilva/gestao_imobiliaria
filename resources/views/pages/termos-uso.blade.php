@extends('layouts.app')

@section('title','Termos de Uso')

@section('content')
@php($page = \App\Models\TermsPage::with('responsibilities')->first())
<h2 class="mb-3">Termos de Uso</h2>
@if(!empty($page?->terms_intro))
  <p>{{ $page->terms_intro }}</p>
@endif

@php($sec = 0)

@if(!empty($page?->services))
  @php($sec++)
  <h4>{{ $sec }}. Serviços</h4>
  <p>{{ $page->services }}</p>
@endif

@if(!empty($page) && $page->responsibilities->count() > 0)
  @php($sec++)
  <h4>{{ $sec }}. Responsabilidades</h4>
  <ul>
    @foreach($page->responsibilities as $item)
      <li>{{ $item->text }}</li>
    @endforeach
  </ul>
@endif

@if(!empty($page?->intellectual_property))
  @php($sec++)
  <h4>{{ $sec }}. Propriedade intelectual</h4>
  <p>{{ $page->intellectual_property }}</p>
@endif

@if(!empty($page?->communications))
  @php($sec++)
  <h4>{{ $sec }}. Comunicações</h4>
  <p>{{ $page->communications }}</p>
@endif

@if(!empty($page?->privacy))
  @php($sec++)
  <h4>{{ $sec }}. Privacidade</h4>
  <p>{{ $page->privacy }}</p>
@endif

@if(!empty($page?->forum))
  @php($sec++)
  <h4>{{ $sec }}. Foro</h4>
  <p>{{ $page->forum }}</p>
@endif
@endsection

