<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label">Título</label>
        <input name="title" class="form-control" required value="{{ old('title', $property->title ?? '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Slug (opcional)</label>
        <input name="slug" class="form-control" value="{{ old('slug', $property->slug ?? '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Tipo</label>
        <select name="property_type_id" class="form-select" required>
            @foreach($types as $t)
                <option value="{{ $t->id }}" @selected(old('property_type_id', $property->property_type_id ?? '')==$t->id)>{{ $t->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Preço</label>
        <input type="number" step="0.01" name="price" class="form-control" required value="{{ old('price', $property->price ?? '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            @foreach(['Disponível','Indisponível','Alugado','Vendido'] as $s)
                <option value="{{ $s }}" @selected(old('status', $property->status ?? 'Disponível')==$s)>{{ $s }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">Metragem (m²)</label>
        <input type="number" min="0" name="area" class="form-control" required value="{{ old('area', $property->area ?? 0) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">Quartos</label>
        <input type="number" min="0" name="bedrooms" class="form-control" required value="{{ old('bedrooms', $property->bedrooms ?? 0) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">Banheiros</label>
        <input type="number" min="0" name="bathrooms" class="form-control" required value="{{ old('bathrooms', $property->bathrooms ?? 0) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">Vagas</label>
        <input type="number" min="0" name="garages" class="form-control" required value="{{ old('garages', $property->garages ?? 0) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Cidade</label>
        <input name="city" class="form-control" required value="{{ old('city', $property->city ?? '') }}">
    </div>
    <div class="col-md-2">
        <label class="form-label">UF</label>
        <input name="state" class="form-control" maxlength="2" required value="{{ old('state', $property->state ?? '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Endereço (opcional)</label>
        <input name="address" class="form-control" value="{{ old('address', $property->address ?? '') }}">
    </div>
    <div class="col-12">
        <label class="form-label">Descrição</label>
        <textarea name="description" class="form-control" rows="5">{{ old('description', $property->description ?? '') }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label">Imagens (várias)</label>
        <input id="imagesInput" type="file" name="images[]" class="form-control" multiple accept="image/jpeg,image/png,image/webp">
        <div id="imagesHelp" class="form-text">A primeira imagem enviada será definida como capa. Limite: 5 MB por imagem. Formatos: JPG, PNG, WEBP.</div>
        <div id="imagesError" class="invalid-feedback"></div>
    </div>
</div>

@push('scripts')
<script>
  (function(){
    const input = document.getElementById('imagesInput');
    const err = document.getElementById('imagesError');
    if(!input) return;
    const MAX_BYTES = 5 * 1024 * 1024; // 5 MB
    input.addEventListener('change', () => {
      let overs = [];
      for (const f of input.files || []) {
        if (f.size > MAX_BYTES) overs.push(`${f.name} (${(f.size/1024/1024).toFixed(2)} MB)`);
      }
      if (overs.length) {
        const msg = `Alguns arquivos excedem 5 MB: ${overs.join(', ')}`;
        input.classList.add('is-invalid');
        err.textContent = msg;
        input.setCustomValidity(msg);
      } else {
        input.classList.remove('is-invalid');
        err.textContent = '';
        input.setCustomValidity('');
      }
    });
  })();
  </script>
@endpush

