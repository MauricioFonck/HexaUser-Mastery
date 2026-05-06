<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="glass-card" style="padding: 2rem; max-width: 800px; margin: 0 auto;">
    <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 2rem;">Crear Nuevo Usuario</h2>

    <form action="?route=users.store" method="POST">
        <div class="form-group">
            <label for="id">ID (UUID o Identificador único)</label>
            <input type="text" name="id" id="id" required value="<?php echo bin2hex(random_bytes(4)); ?>">
        </div>

        <div class="form-group">
            <label for="name">Nombre Completo</label>
            <input type="text" name="name" id="name" required placeholder="Ej: Juan Pérez">
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" name="email" id="email" required placeholder="juan@ejemplo.com">
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" required minlength="8">
        </div>

        <div class="form-group">
            <label for="role">Rol de Usuario</label>
            <select name="role" id="role" required>
                <option value="USER">Usuario Estándar</option>
                <option value="ADMIN">Administrador</option>
            </select>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 1rem;">
            <button type="submit" class="btn btn-primary" style="flex: 1; justify-content: center; padding: 1rem;">Crear Usuario</button>
            <a href="?route=users.list" class="btn" style="background: #f1f5f9; padding: 1rem;">Cancelar</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
