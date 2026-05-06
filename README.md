# HexaUser Mastery 💎
### *Enterprise-Grade User Management with Hexagonal Architecture*

---

**HexaUser Mastery** es un ecosistema de gestión de usuarios construido sobre los cimientos de la **Ingeniería de Software moderna**. Este proyecto no es solo un CRUD; es una implementación rigurosa de **Arquitectura Hexagonal**, **Domain-Driven Design (DDD)** y **CQRS** en PHP 8.2, diseñada para demostrar cómo el desacoplamiento total permite crear sistemas resilientes, testeables y evolucionables.

---

## 🖼️ Visual Showcase
Experimenta una interfaz de usuario premium diseñada con una estética de vanguardia (*Glassmorphism*).

| Inicio del Sistema | Gestión de Usuarios | Creación de Perfiles |
|:---:|:---:|:---:|
| ![Home Screenshot](img/Captura%20de%20pantalla%202026-05-05%20224916.png) | ![Users Screenshot](img/Captura%20de%20pantalla%202026-05-05%20225041.png) | ![Create User Screenshot](img/Captura%20de%20pantalla%202026-05-05%20225950.png) |

---

## 🏗️ Arquitectura y Diseño de Software

El corazón de este proyecto es la **separación de intereses**. La lógica de negocio reside en el centro, protegida de los cambios en la infraestructura externa.

```mermaid
graph LR
    subgraph "Infraestructura (Capa Externa)"
        UI[User Interface / Web]
        Persistence[MySQL Persistence Adapter]
    end

    subgraph "Aplicación (Orquestación)"
        Services[Application Services]
        Ports[Input/Output Ports]
    end

    subgraph "Dominio (Núcleo Inmutable)"
        Aggregate[User Aggregate Root]
        VO[Value Objects]
        Events[Domain Events]
    end

    UI --> Services
    Services --> Aggregate
    Persistence -- implements --> Ports
    Services -- calls --> Ports
```

### Análisis de Responsabilidades por Capa

| Capa | Responsabilidad | Componentes Clave |
| :--- | :--- | :--- |
| **Dominio** | Lógica de negocio y reglas de integridad. | `UserModel`, `UserEmail`, `UserRoleEnum`, `InvalidUserException` |
| **Aplicación** | Coordinación de flujos y orquestación de servicios. | `CreateUserService`, `UpdateUserService`, `CreateUserCommand` |
| **Infraestructura** | Detalles de implementación técnica y adaptadores. | `UserRepositoryMySQL`, `UserController`, `View Engine` |

---

## 🛡️ Patrones y Principios Aplicados

Para garantizar la máxima calidad del código, se han implementado los siguientes estándares:

- **SOLID Principles:** Especialmente el principio de *Inversión de Dependencias* (DIP).
- **Domain-Driven Design (DDD):** Uso de **Aggregate Roots**, **Value Objects** y **Domain Events**.
- **CQRS:** Separación clara entre comandos (mutaciones de estado) y consultas (lectura de datos).
- **Repository Pattern:** Abstracción total del acceso a datos.
- **Dependency Injection (DI):** Gestión centralizada de dependencias mediante un contenedor custom.
- **Clean Code:** Código autodocumentado, tipado estricto y sin efectos secundarios.

---

## 📁 Estructura del Proyecto

```text
├── public/                 # Punto de entrada (Frontend Controller)
├── src/
│   ├── Domain/             # Reglas de negocio puras (Inmutable)
│   ├── Application/        # Servicios y Puertos (Orquestación)
│   ├── Infrastructure/     # Adaptadores MySQL, Web y Presentación
│   └── Common/             # Framework Core (DI, ClassLoader)
├── tests/
│   ├── Unit/               # Pruebas de lógica de dominio
│   └── Integration/        # Pruebas de persistencia real
├── img/                    # Activos visuales de documentación
└── docker/                 # Configuración de virtualización
```

---

## 🚀 Despliegue Rápido

### Usando Docker (Recomendado)
Levanta todo el ecosistema (PHP 8.2 + MySQL 8.0) en segundos:
```bash
docker-compose up -d --build
docker-compose exec app composer install
```
🔗 Acceso: **[http://localhost:8080](http://localhost:8080)**

### Instalación Local
1. Configura tu base de datos en `src/Infrastructure/Adapters/Persistence/MySQL/Config/Connection.php`.
2. Ejecuta `composer install`.
3. Inicia el servidor: `php -S localhost:8000 -t public`.

---

## 🧪 Suite de Pruebas Profesionales

Garantiza la estabilidad del sistema ejecutando nuestra suite completa de PHPUnit:

```bash
docker-compose exec app vendor/bin/phpunit
```

![Tests Screenshot](img/Captura%20de%20pantalla%202026-05-05%20230132.png)

---
*Desarrollado con el compromiso de crear software excepcional.*
