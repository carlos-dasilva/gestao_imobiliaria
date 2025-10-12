@extends('admin.layout2')

@section('title','Política de Privacidade')

@section('admin-content')
<div class="card">
  <div class="card-header fw-semibold">Política de Privacidade</div>
  <div class="card-body">
    <form method="POST" action="{{ route('admin.privacy.update') }}">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">Introdução</label>
        <textarea name="policy_intro" class="form-control" rows="4" placeholder="Introdução da política">{{ old('policy_intro', $policy->policy_intro ?? '') }}</textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Dados coletados</label>
        @php($items = collect(old('col_titles', optional($policy)->collectedItems?->pluck('title')->all() ?? [])))
        @php($descs = collect(old('col_descriptions', optional($policy)->collectedItems?->pluck('description')->all() ?? [])))
        @if($items->isEmpty())
          @php($items = collect(['']))
          @php($descs = collect(['']))
        @endif
        <div id="collected-list" class="d-flex flex-column gap-2">
          @foreach($items as $i => $title)
            <div class="row g-2 align-items-start collected-item">
              <div class="col-md-4">
                <input type="text" name="col_titles[]" class="form-control" value="{{ $title }}" placeholder="Título (negrito)">
              </div>
              <div class="col-md-7">
                <input type="text" name="col_descriptions[]" class="form-control" value="{{ $descs[$i] ?? '' }}" placeholder="Descrição">
              </div>
              <div class="col-md-1 d-grid">
                <button type="button" class="btn btn-outline-danger" onclick="removeCollected(this)"><i class="bi bi-x"></i></button>
              </div>
            </div>
          @endforeach
        </div>
        <button type="button" class="btn btn-outline-secondary btn-sm mt-2" onclick="addCollected()"><i class="bi bi-plus"></i> Adicionar item</button>
        <div class="form-text">O título será exibido em negrito antes da descrição.</div>
      </div>

      <div class="mb-3">
        <label class="form-label">Finalidades</label>
        @php($purposes = collect(old('purposes', optional($policy)->purposes?->pluck('text')->all() ?? [])))
        @if($purposes->isEmpty())
          @php($purposes = collect(['']))
        @endif
        <div id="purposes-list" class="d-flex flex-column gap-2">
          @foreach($purposes as $p)
            <div class="d-flex gap-2 align-items-center purpose-item">
              <input type="text" name="purposes[]" class="form-control" value="{{ $p }}" placeholder="Ex.: Garantir segurança operacional do site">
              <button type="button" class="btn btn-outline-danger btn-sm" onclick="removePurpose(this)"><i class="bi bi-x"></i></button>
            </div>
          @endforeach
        </div>
        <button type="button" class="btn btn-outline-secondary btn-sm mt-2" onclick="addPurpose()"><i class="bi bi-plus"></i> Adicionar finalidade</button>
      </div>

      <div class="row g-3">
        <div class="col-12">
          <label class="form-label">Bases legais</label>
          <textarea name="bases_legais" class="form-control" rows="2">{{ old('bases_legais', $policy->bases_legais ?? '') }}</textarea>
        </div>
        <div class="col-12">
          <label class="form-label">Compartilhamento</label>
          <textarea name="compartilhamento" class="form-control" rows="2">{{ old('compartilhamento', $policy->compartilhamento ?? '') }}</textarea>
        </div>
        <div class="col-12">
          <label class="form-label">Retenção</label>
          <textarea name="retencao" class="form-control" rows="2">{{ old('retencao', $policy->retencao ?? '') }}</textarea>
        </div>
        <div class="col-12">
          <label class="form-label">Direitos do titular</label>
          <textarea name="direitos_titular" class="form-control" rows="2">{{ old('direitos_titular', $policy->direitos_titular ?? '') }}</textarea>
        </div>
        <div class="col-12">
          <label class="form-label">Segurança</label>
          <textarea name="seguranca" class="form-control" rows="2">{{ old('seguranca', $policy->seguranca ?? '') }}</textarea>
        </div>
        <div class="col-12">
          <label class="form-label">Cookies</label>
          <textarea name="cookies" class="form-control" rows="2">{{ old('cookies', $policy->cookies ?? '') }}</textarea>
        </div>
        <div class="col-12">
          <label class="form-label">Atualizações</label>
          <textarea name="atualizacoes" class="form-control" rows="2">{{ old('atualizacoes', $policy->atualizacoes ?? '') }}</textarea>
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
function addCollected(){
  const wrap = document.getElementById('collected-list');
  const row = document.createElement('div');
  row.className = 'row g-2 align-items-start collected-item';
  row.innerHTML = '<div class="col-md-4"><input type="text" name="col_titles[]" class="form-control" placeholder="Título (negrito)"></div>'+
                  '<div class="col-md-7"><input type="text" name="col_descriptions[]" class="form-control" placeholder="Descrição"></div>'+
                  '<div class="col-md-1 d-grid"><button type="button" class="btn btn-outline-danger" onclick="removeCollected(this)"><i class="bi bi-x"></i></button></div>';
  wrap.appendChild(row);
}
function removeCollected(btn){ const item = btn.closest('.collected-item'); if(item){ item.remove(); } }
function addPurpose(){
  const wrap = document.getElementById('purposes-list');
  const div = document.createElement('div');
  div.className = 'd-flex gap-2 align-items-center purpose-item';
  div.innerHTML = '<input type="text" name="purposes[]" class="form-control" placeholder="Finalidade">'+
                  '<button type="button" class="btn btn-outline-danger btn-sm" onclick="removePurpose(this)"><i class="bi bi-x"></i></button>';
  wrap.appendChild(div);
}
function removePurpose(btn){ const item = btn.closest('.purpose-item'); if(item){ item.remove(); } }
</script>
@endpush
@endsection

