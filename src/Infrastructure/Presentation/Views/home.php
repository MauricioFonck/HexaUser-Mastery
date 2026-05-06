<?php require_once __DIR__ . '/layouts/header.php'; ?>

<section class="glass-card" style="padding: 3rem; text-align: center;">
    <h1 style="font-size: 3rem; font-weight: 800; margin-bottom: 1.5rem; letter-spacing: -0.05em;">
        Domina la <span style="color: var(--primary);">Arquitectura Hexagonal</span>
    </h1>
    <p style="font-size: 1.25rem; color: var(--text-muted); max-width: 700px; margin: 0 auto 2.5rem;">
        Bienvenido al panel de administración de usuarios construido con los estándares más altos de ingeniería de software: DDD, CQRS y Principios SOLID.
    </p>
    <div style="display: flex; gap: 1rem; justify-content: center;">
        <a href="?route=users.list" class="btn btn-primary" style="padding: 1rem 2rem;">Gestionar Usuarios</a>
        <a href="https://github.com/MauricioFonck/HexaUser-Mastery" target="_blank" class="btn" style="border: 1px solid var(--border); padding: 1rem 2rem;">Ver Repositorio</a>
    </div>
</section>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>
