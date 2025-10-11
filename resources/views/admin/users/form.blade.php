<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nome</label>
        <input name="name" class="form-control" required value="{{ old('name', $user->name ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Usuário</label>
        <input name="username" class="form-control" required value="{{ old('username', $user->username ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">E-mail (opcional)</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Senha {{ isset($user) ? '(deixe em branco para manter)':'' }}</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="col-md-6">
        <label class="form-label">Confirmar senha</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>
    <div class="col-md-6 d-flex align-items-end">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_admin" value="1" id="is_admin" {{ old('is_admin', $user->is_admin ?? false) ? 'checked':'' }}>
            <label class="form-check-label" for="is_admin">Administrador</label>
        </div>
    </div>
</div>

