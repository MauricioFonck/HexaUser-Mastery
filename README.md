# HexaUser Mastery

**HexaUser Mastery** es un ecosistema de desarrollo PHP basado en **Arquitectura Hexagonal (DDD)** que integra una metodología de despliegue autónomo mediante IA. Diseñado para garantizar la estabilidad del código a través de validaciones automáticas y una gestión de ramas inteligente y segura.

## 🚀 Características Principales

-   **Arquitectura Hexagonal**: Guías completas para implementar capas de Dominio, Aplicación e Infraestructura.
-   **AI Autonomous Skill**: Metodología integrada para que asistentes de IA gestionen el repositorio de forma segura.
-   **Validación Continua**: Requisito de aprobación de tests y pipelines antes de cualquier commit.
-   **Gestión Inteligente de Ramas**: Diferenciación automática entre cambios triviales (push directo) e importantes (PR/Branching).

## 📁 Estructura del Proyecto

-   `Docs/`: Documentación detallada sobre la implementación de la Arquitectura Hexagonal en PHP.
-   `Skill/`: Definición de la metodología de trabajo para la IA (Antigravity/Otros).

## 🔗 Repositorio
- **GitHub**: [MauricioFonck/HexaUser-Mastery](https://github.com/MauricioFonck/HexaUser-Mastery.git)

## 🛠️ Metodología de Trabajo (AI Skill)

El proyecto utiliza un flujo de trabajo automatizado definido en español en `Skill/git_autonomous_sync.md`:

1.  **Validación**: Ejecución de tests locales obligatoria.
2.  **Clasificación**:
    -   **Nivel A (Rutinario)**: Commit y Push directo a `main`.
    -   **Nivel B (Importante)**: Creación de rama, push remoto y solicitud de permiso para merge.
3.  **Supervisión**: Las decisiones críticas siempre consultan al controlador del proyecto.

## 📝 Licencia

Este proyecto es de uso privado para el desarrollo de aplicaciones PHP robustas.
