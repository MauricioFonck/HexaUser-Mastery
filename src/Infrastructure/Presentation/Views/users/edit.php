<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="glass-card" style="padding: 2rem; max-width: 800px; margin: 0 auto;">
    <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 2rem;">Editar Usuario</h2>

    <form action="?route=users.update" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user->getId()); ?>">

        <div class="form-group">
            <label>ID del Usuario</label>
            <input type="text" value="<?php echo htmlspecialchars($user->getId()); ?>" disabled style="background: #f1f5f9; cursor: not-allowed;">
        </div>

        <div class="form-group">
            <label for="name">Nombre Completo</label>
            <input type="text" name="name" id="name" required value="<?php echo htmlspecialchars($user->getName()); ?>">
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" name="email" id="email" required value="<?php echo htmlspecialchars($user->getEmail()); ?>">
        </div>

        <div class="form-group">
            <label for="password">Nueva Contraseña (dejar vacío para mantener la actual)</label>
            <input type="password" name="password" id="password" minlength="8">
        </div>

        <div class="form-group">
            <label for="role">Rol de Usuario</label>
            <select name="role" id="role" required>
                <option value="USER" <?php echo $user->getRole() === 'USER' ? 'selected' : ''; ?>>Usuario Estándar</option>
                <option value="ADMIN" <?php echo $user->getRole() === 'ADMIN' ? 'selected' : ''; ?>>Administrador</option>
            </select>
        </div>

        <div class="form-group">
            <label for="status">Estado de la Cuenta</label>
            <select name="status" id="status" required>
                <option value="ACTIVE" <?php echo $user->getStatus() === 'ACTIVE' ? 'selected' : ''; ?>>Activo</option>
                <option value="PENDING" <?php echo $user->getStatus() === 'PENDING' ? 'selected' : ''; ?>>Pendiente</option>
                <option value="INACTIVE" <?php echo $user->getStatus() === 'INACTIVE' ? 'selected' : ''; ?>>Inactivo</option>
            </select>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 1rem;">
            <button type="submit" class="btn btn-primary" style="flex: 1; justify-content: center; padding: 1rem;">Actualizar Datos</button>
            <a href="?route=users.list" class="btn" style="background: #f1f5f9; padding: 1rem;">Cancelar</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
