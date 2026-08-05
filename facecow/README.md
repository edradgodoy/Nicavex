<p align="center">
  <a href="https://github.com/edradgodoy/Nicavex" target="_blank">
    <img src="https://raw.githubusercontent.com/edradgodoy/Nicavex/main/docs/Color/logo.png" width="320" alt="Nicavex FaceCow Logo">
  </a>
</p>

<p align="center">
  <strong>FaceCow</strong> · Plataforma premium para el control de inventario veterinario y monitoreo satelital en tiempo real para el sector ganadero de Nicaragua.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 13">
  <img src="https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.3">
  <img src="https://img.shields.io/badge/Livewire-3.x-4E56A6?style=for-the-badge&logo=livewire&logoColor=white" alt="Livewire 3">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap 5.3">
  <img src="https://img.shields.io/badge/Leaflet-1.9-199900?style=for-the-badge&logo=leaflet&logoColor=white" alt="Leaflet 1.9">
</p>

---

## 🌟 Descripción General

**FaceCow (Nicavex)** es un sistema **SaaS Ganadero** diseñado para optimizar el control de hatos ganaderos. Integra un panel administrativo moderno con herramientas de geolocalización satelital para el monitoreo en vivo del ganado, control veterinario avanzado, validación de origen legal de los animales y soporte multiidioma. 

La interfaz del sistema sigue una guía de estilo corporativa premium inspirada en los colores de la naturaleza nicaragüense, implementada a través de Bootstrap 5, DataTables y SweetAlert2.

---

## 🚀 Características Clave

### 🛰️ Monitoreo Satelital GPS
* **Mapa Interactivo:** Desarrollado con **Leaflet JS** para visualizar la ubicación activa del ganado mediante collares GPS.
* **Modo Oscuro Integrado:** El mapa cambia dinámicamente de baldosas claras (*CartoDB Voyager*) a oscuras (*CartoDB Dark Matter*) según la preferencia de visualización del sistema.
* **Control de Enfoque:** Sidebar interactivo para hacer zoom automático al ganado seleccionado.
* **Pines Inteligentes:** Código de colores dinámico en base al estado de salud del animal (Verde Acento Neón para óptimo, Naranja para estados críticos/tratamiento).

### 📋 Gestión del Hato (Cattle CRUD)
* **Inventario Detallado:** Control completo de aretes (tags de oreja), razas, pesos, estados de salud y procedencias.
* **DataTables Premium:** Listados de ganado paginados, con búsquedas instantáneas y adaptados estéticamente al modo claro y oscuro del sistema.
* **Modales Dinámicos:** Creación y edición rápida de registros asistida por diálogos interactivos de **SweetAlert2**.

### 🛡️ Trazabilidad y Verificación de Origen
* **Validación Legal:** Clasificación inequívoca del ganado como **Verificado** o **No verificado** para combatir el robo y la venta ilegal.
* **Badges Visuales:** Identificación inmediata a través de insignias visuales estilizadas en tablas y dashboards.

### 🌐 Internacionalización (Multiidioma)
* Soporte nativo para **Español (es)** e **Inglés (en)**.
* Persistencia automática de la preferencia de idioma a través de cookies anuales y variables de sesión.

---

## 🎨 Identidad Visual y Paleta de Colores

La aplicación utiliza variables CSS personalizadas para mantener una estética premium y consistente (definida en la guía de estilo del SaaS Ganadero):

* **Primario (Cielo):** `#1f9fdc` (Base para botones principales, enlaces y navegación activa).
* **Secundario (Montaña):** `#0a6b0a` (Utilizado para botones de confirmación, transacciones exitosas y estados verificados).
* **Acento Neón:** `#02f202` (Para insignias de estado activo o verificado y pines activos en el GPS).
* **Semánticos:**
  * **Éxito (Success):** `#0a6b0a` con fondo `#f3f8f3`
  * **Peligro (Danger):** `#dc2626` con fondo `#fbe5e5`
  * **Advertencia (Warning):** `#f59e0b` con fondo `#fef3e2`

---

## 📊 Estructura de Datos (Tabla `cattles`)

La base de datos registra los siguientes atributos para cada cabeza de ganado:

| Campo | Tipo | Descripción |
|---|---|---|
| `id` | `BIGINT (PK)` | Identificador autoincremental de la base de datos. |
| `arete` | `VARCHAR (Unique)` | ID / Tag físico de oreja (ej: `FC-102943`). |
| `breed` | `VARCHAR` | Raza del animal (Brahman, Nelore, Angus, Holstein, etc.). |
| `weight` | `DECIMAL(8,2)` | Peso del animal expresado en kilogramos. |
| `health_status` | `VARCHAR` | Estado de salud (Excelente, Bueno, En Tratamiento, Crítico). |
| `origin` | `VARCHAR` | Estado de procedencia (`verificado` o `no verificado`). |
| `latitude` | `DECIMAL(10,8)` | Coordenada GPS de latitud para el mapa interactivo. |
| `longitude` | `DECIMAL(11,8)` | Coordenada GPS de longitud para el mapa interactivo. |

---

## 🛠️ Instalación y Configuración Local

Sigue estos sencillos pasos para levantar el entorno de desarrollo localmente:

### Prerrequisitos
* PHP `>= 8.3`
* Composer
* Node.js `>= 20.x` & npm

### Paso 1: Clonar el Repositorio
```bash
git clone https://github.com/edradgodoy/Nicavex.git
cd Nicavex/facecow
```

### Paso 2: Instalación Automatizada (Setup)
Hemos simplificado la instalación del entorno con un único comando que instala dependencias de PHP y Node, crea la base de datos SQLite local, genera la clave de aplicación y compila los assets de Vite:
```bash
composer run setup
```

### Paso 3: Iniciar Servidores de Desarrollo
Para arrancar simultáneamente el servidor local de Laravel, el servidor de compilación en tiempo real de Vite, las colas de procesamiento (queue) y el visor de logs (pail), ejecuta:
```bash
composer run dev
```

La aplicación estará disponible en: **[http://localhost:8000](http://localhost:8000)**

---

## 🔑 Credenciales de Acceso para Pruebas

El comando `composer run setup` realiza el sembrado de base de datos automáticamente (`DatabaseSeeder`), registrando un usuario administrador y 25 registros de ganado de prueba geolocalizados en el mapa de Nicaragua.

* **URL de Acceso:** `http://localhost:8000/login`
* **Correo Electrónico:** `admin@facecow.com`
* **Contraseña:** `password`
