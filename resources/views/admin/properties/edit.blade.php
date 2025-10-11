@extends('admin.layout')

@section('title','Editar Imóvel')

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
@endsection

