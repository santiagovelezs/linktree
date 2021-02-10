<div class="mb-3">
    <label for="label" class="form-label">Tipo</label>
    <select class='form-control' name='type'>
        @foreach ($types as $type)              
            <option value="{{ $type }}" {{ (($socialNetwork->type ?? "") == $type ? "selected":"") }}>{{ $type }}</option>                  
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="url" class="form-label">Enlace</label>
    <input type="url" class="form-control" id="url" name="url" value="{{ old('url', $socialNetwork->url ?? "") }}">
</div>  
