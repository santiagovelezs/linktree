
    <div class="form-group">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name ?? "") }}" required>
    </div>
