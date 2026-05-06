<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="glass-card" style="padding: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2 style="font-size: 1.5rem; font-weight: 700;">Gestión de Usuarios</h2>
        <a href="?route=users.create" class="btn btn-primary">Nuevo Usuario</a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($user->getName()); ?></strong></td>
                        <td><?php echo htmlspecialchars($user->getEmail()); ?></td>
                        <td><?php echo htmlspecialchars($user->getRole()); ?></td>
                        <td>
                            <span class="status-badge status-<?php echo strtolower($user->getStatus()); ?>">
                                <?php echo htmlspecialchars($user->getStatus()); ?>
                            </span>
                        </td>
                        <td style="display: flex; gap: 0.5rem;">
                            <a href="?route=users.edit&id=<?php echo $user->getId(); ?>" class="btn" style="background: #f1f5f9; font-size: 0.875rem;">Editar</a>
                            <form action="?route=users.delete" method="POST" style="display: inline; margin: 0; max-width: none;">
                                <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
                                <button type="submit" class="btn" style="background: #fee2e2; color: #991b1b; font-size: 0.875rem;" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 3rem; color: var(--text-muted);">No hay usuarios registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
