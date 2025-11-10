@extends('admin.layout2')

@section('title','Editar ImÃ³vel')

@section('admin-content')
    <div class="card mb-3">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.properties.update',$property) }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                @include('admin.properties.form', ['property' => $property])
                <button class="btn btn-danger">Atualizar</button>
                <a class="btn btn-outline-secondary" href="{{ route('admin.properties.index') }}">Voltar</a>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header fw-semibold">Imagens</div>
        <div class="card-body">
            <div class="row g-3">
                @foreach($property->images as $img)
                    <div class="col-6 col-md-3">
                        <div class="card h-100">
                            <img src="{{ asset('storage/'.$img->path) }}" class="card-img-top" style="height:160px; object-fit:cover" />
                            <div class="card-body p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <form method="POST" action="{{ route('admin.properties.images.cover',[$property,$img]) }}">
                                        @csrf
                                        <button class="btn btn-sm {{ $img->is_cover ? 'btn-success':'btn-outline-secondary' }}">{{ $img->is_cover ? 'Capa':'Definir capa' }}</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.properties.images.destroy',[$property,$img]) }}" onsubmit="return confirm('Excluir esta imagem?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header fw-semibold">Vídeos</div>

        <div class="card-body">
            <div class="row g-3">
                @foreach($property->videos as $v)
                    <div class="col-6 col-md-3">
                        <div class="card h-100">
                            <img src="{{ $v->thumb_url }}" class="card-img-top" style="height:160px; object-fit:cover" alt="Vídeo">

                            <div class="card-body p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <form method="POST" action="{{ route('admin.properties.videos.cover',[$property,$v]) }}">
                                        @csrf
                                        <button class="btn btn-sm {{ $v->is_cover ? 'btn-success':'btn-outline-secondary' }}">{{ $v->is_cover ? 'Capa':'Definir capa' }}</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.properties.videos.destroy',[$property,$v]) }}" onsubmit="return confirm('Excluir este vídeo?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @php
      $media = collect($property->images->map(fn($i) => [
          'type'=>'image','id'=>$i->id,'is_cover'=>$i->is_cover,'sort_order'=>$i->sort_order,'thumb'=>asset('storage/'.$i->path)
      ]))->merge($property->videos->map(fn($v) => [
          'type'=>'video','id'=>$v->id,'is_cover'=>$v->is_cover,'sort_order'=>$v->sort_order,'thumb'=>$v->thumb_url
      ]))->sortBy('sort_order')->values();
    @endphp
    <div class="card mt-3">
        <div class="card-header fw-semibold">Ordem da Galeria (arraste para ordenar)</div>
        <div class="card-body">
            <ul id="mediaList" class="list-group">
              @foreach($media as $m)
                <li class="list-group-item d-flex align-items-center gap-2" draggable="true" data-type="{{ $m['type'] }}" data-id="{{ $m['id'] }}">
                  <img src="{{ $m['thumb'] }}" alt="thumb" style="height:48px; width:64px; object-fit:cover" />
                  <span class="badge {{ $m['type'] === 'image' ? 'bg-secondary' : 'bg-danger' }}">{{ $m['type'] }}</span>
                  @if($m['is_cover']) <span class="badge bg-success">capa</span> @endif
                  <span class="ms-auto text-muted handle">arraste</span>
                </li>
              @endforeach
            </ul>
            <button type="button" id="saveOrderBtn" class="btn btn-outline-secondary mt-3">Salvar ordem</button>
        </div>
    </div>
@push('scripts')
<script>
(function(){
  const list = document.getElementById('mediaList');
  const saveBtn = document.getElementById('saveOrderBtn');
  if (!list || !saveBtn) return;

  let dragEl = null;
  list.addEventListener('dragstart', e => { dragEl = e.target.closest('li'); e.dataTransfer.effectAllowed='move'; });
  list.addEventListener('dragover', e => {
    e.preventDefault();
    const li = e.target.closest('li');
    if (!li || li === dragEl) return;
    const rect = li.getBoundingClientRect();
    const next = (e.clientY - rect.top)/(rect.bottom-rect.top) > 0.5;
    list.insertBefore(dragEl, next ? li.nextSibling : li);
  });
  list.addEventListener('dragend', () => { dragEl = null; });

  saveBtn.addEventListener('click', async () => {
    const items = Array.from(list.querySelectorAll('li')).map(li => ({
      type: li.dataset.type, id: parseInt(li.dataset.id, 10)
    }));
    const res = await fetch("{{ route('admin.properties.media.reorder',$property) }}", {
      method: 'POST',
      headers: {'Content-Type':'application/json','X-CSRF-TOKEN': '{{ csrf_token() }}'},
      body: JSON.stringify({items})
    });
    if (res.ok) location.reload();
    else alert('Falha ao salvar a ordem.');
  });
})();
</script>
@endpush
@endsection

