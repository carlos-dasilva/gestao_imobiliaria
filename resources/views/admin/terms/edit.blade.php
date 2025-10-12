@extends('admin.layout2')

@section('title','Termos de Uso')

@section('admin-content')
<div class="card">
  <div class="card-header fw-semibold">Termos de Uso</div>
  <div class="card-body">
    <form method="POST" action="{{ route('admin.terms.update') }}">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">Termos de Uso (introdução)</label>
        <textarea name="terms_intro" class="form-control" rows="3" placeholder="Introdução dos termos">{{ old('terms_intro', $page->terms_intro ?? '') }}</textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Serviços</label>
        <textarea name="services" class="form-control" rows="3" placeholder="Descrição dos serviços">{{ old('services', $page->services ?? '') }}</textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Responsabilidades</label>
        @php($items = collect(old('responsibilities', optional($page)->responsibilities?->pluck('text')->all() ?? [])))
        @if($items->isEmpty())
          @php($items = collect(['']))
        @endif
        <div id="resp-list" class="d-flex flex-column gap-2">
          @foreach($items as $t)
            <div class="d-flex gap-2 align-items-center resp-item">
              <input type="text" name="responsibilities[]" class="form-control" value="{{ $t }}" placeholder="Ex.: O usuário deve fornecer dados verdadeiros e atualizados ao entrar em contato.">
              <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeResp(this)"><i class="bi bi-x"></i></button>
            </div>
          @endforeach
        </div>
        <button type="button" class="btn btn-outline-secondary btn-sm mt-2" onclick="addResp()"><i class="bi bi-plus"></i> Adicionar responsabilidade</button>
      </div>

      <div class="row g-3">
        <div class="col-12">
          <label class="form-label">Propriedade intelectual</label>
          <textarea name="intellectual_property" class="form-control" rows="2">{{ old('intellectual_property', $page->intellectual_property ?? '') }}</textarea>
        </div>
        <div class="col-12">
          <label class="form-label">Comunicações</label>
          <textarea name="communications" class="form-control" rows="2">{{ old('communications', $page->communications ?? '') }}</textarea>
        </div>
        <div class="col-12">
          <label class="form-label">Privacidade</label>
          <textarea name="privacy" class="form-control" rows="2">{{ old('privacy', $page->privacy ?? '') }}</textarea>
        </div>
        <div class="col-12">
          <label class="form-label">Foro</label>
          <textarea name="forum" class="form-control" rows="2">{{ old('forum', $page->forum ?? '') }}</textarea>
        </div>
      </div>

      <div class="mt-3 d-flex gap-2">
        <button class="btn btn-danger">Salvar</button>
        <a class="btn btn-outline-secondary" href="{{ route('admin.dashboard') }}">Voltar</a>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
function addResp(){
  const wrap = document.getElementById('resp-list');
  const div = document.createElement('div');
  div.className = 'd-flex gap-2 align-items-center resp-item';
  div.innerHTML = '<input type="text" name="responsibilities[]" class="form-control" placeholder="Responsabilidade">'+
                  '<button type="button" class="btn btn-outline-danger btn-sm" onclick="removeResp(this)"><i class="bi bi-x"></i></button>';
  wrap.appendChild(div);
}
function removeResp(btn){ const item = btn.closest('.resp-item'); if(item){ item.remove(); } }
</script>
@endpush
@endsection

