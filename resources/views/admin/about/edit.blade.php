@extends('admin.layout2')

@section('title','Quem Somos')

@section('admin-content')
<div class="card">
  <div class="card-header fw-semibold">Quem Somos</div>
  <div class="card-body">
    <form method="POST" action="{{ route('admin.about.update') }}">
      @csrf
      @method('PUT')
      <div class="row g-3">
        <div class="col-12">
          <label class="form-label">Quem Sou</label>
          <textarea name="who_i_am" class="form-control" rows="4" placeholder="Conte sobre você">{{ old('who_i_am', $page->who_i_am ?? '') }}</textarea>
        </div>
        <div class="col-12">
          <label class="form-label">Propósito</label>
          <textarea name="purpose" class="form-control" rows="3" placeholder="Descreva seu propósito">{{ old('purpose', $page->purpose ?? '') }}</textarea>
        </div>
        <div class="col-12">
          <label class="form-label">Como trabalho</label>
          <textarea name="how_i_work" class="form-control" rows="3" placeholder="Explique seu modo de trabalho">{{ old('how_i_work', $page->how_i_work ?? '') }}</textarea>
        </div>

        <div class="col-12">
          <label class="form-label">Valores</label>
          <div id="values-list" class="d-flex flex-column gap-2">
            @php($oldValues = collect(old('values', optional($page)->values?->pluck('value')->all() ?? [])))
            @if($oldValues->isEmpty())
              @php($oldValues = collect(['']))
            @endif
            @foreach($oldValues as $i => $v)
              <div class="d-flex gap-2 align-items-center value-item">
                <input type="text" name="values[]" class="form-control" value="{{ $v }}" placeholder="Ex.: Transparência e ética em todas as relações">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeValue(this)"><i class="bi bi-x"></i></button>
              </div>
            @endforeach
          </div>
          <button type="button" class="btn btn-outline-secondary btn-sm mt-2" onclick="addValue()"><i class="bi bi-plus"></i> Adicionar valor</button>
          <div class="form-text">Deixe em branco para não exibir. Você pode adicionar vários itens.</div>
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
function addValue(){
  const wrap = document.getElementById('values-list');
  const div = document.createElement('div');
  div.className = 'd-flex gap-2 align-items-center value-item';
  div.innerHTML = '<input type="text" name="values[]" class="form-control" placeholder="Ex.: Transparência e ética em todas as relações">' +
                  '<button type="button" class="btn btn-outline-danger btn-sm" onclick="removeValue(this)"><i class="bi bi-x"></i></button>';
  wrap.appendChild(div);
}
function removeValue(btn){
  const item = btn.closest('.value-item');
  if(item){ item.remove(); }
}
</script>
@endpush
@endsection

