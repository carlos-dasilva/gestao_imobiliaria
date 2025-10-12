@extends('layouts.app')

@section('title','Política de Privacidade')

@section('content')
@php($policy = \App\Models\PrivacyPolicy::with(['collectedItems','purposes'])->first())
<h2 class="mb-3">Política de Privacidade</h2>
@if(!empty($policy?->policy_intro))
<p>{{ $policy->policy_intro }}</p>
@endif

@php($sec = 0)

@if(!empty($policy) && $policy->collectedItems->count() > 0)
@php($sec++)
<h4>{{ $sec }}. Dados coletados</h4>
<ul>
  @foreach($policy->collectedItems as $it)
    <li><strong>{{ $it->title }}</strong>@if(!empty($it->description)): {{ $it->description }} @endif</li>
  @endforeach
</ul>
@endif

@if(!empty($policy) && $policy->purposes->count() > 0)
@php($sec++)
<h4>{{ $sec }}. Finalidades</h4>
<ul>
  @foreach($policy->purposes as $p)
    <li>{{ $p->text }}</li>
  @endforeach
</ul>
@endif

@if(!empty($policy?->bases_legais))
@php($sec++)
<h4>{{ $sec }}. Bases legais</h4>
<p>{{ $policy->bases_legais }}</p>
@endif

@if(!empty($policy?->compartilhamento))
@php($sec++)
<h4>{{ $sec }}. Compartilhamento</h4>
<p>{{ $policy->compartilhamento }}</p>
@endif

@if(!empty($policy?->retencao))
@php($sec++)
<h4>{{ $sec }}. Retenção</h4>
<p>{{ $policy->retencao }}</p>
@endif

@if(!empty($policy?->direitos_titular))
@php($sec++)
<h4>{{ $sec }}. Direitos do titular</h4>
<p>{{ $policy->direitos_titular }}</p>
@endif

@if(!empty($policy?->seguranca))
@php($sec++)
<h4>{{ $sec }}. Segurança</h4>
<p>{{ $policy->seguranca }}</p>
@endif

@if(!empty($policy?->cookies))
@php($sec++)
<h4>{{ $sec }}. Cookies</h4>
<p>{{ $policy->cookies }}</p>
@endif

@if(!empty($policy?->atualizacoes))
@php($sec++)
<h4>{{ $sec }}. Atualizações</h4>
<p>{{ $policy->atualizacoes }}</p>
@endif
@endsection

