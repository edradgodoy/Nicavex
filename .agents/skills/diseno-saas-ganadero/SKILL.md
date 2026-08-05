---
name: diseno-saas-ganadero
description: Guía de estilo, tokens CSS y configuración de Bootstrap, DataTables y SweetAlert para implementar la paleta de colores corporativa (Cielo, Montaña, Neutros y Acento Neón) del Sistema SaaS Ganadero.
---

# Paleta de Colores · Sistema SaaS Ganadero (Bootstrap, DataTables & SweetAlert)

Esta skill proporciona las especificaciones, tokens y lineamientos de diseño para aplicar de forma coherente la paleta de colores del Sistema SaaS Ganadero en la aplicación móvil, sitio web y panel de administración de Nicavex, utilizando **Bootstrap**, **Bootstrap Icons**, **DataTables** y **SweetAlert** (sin Tailwind).

## 🎨 Tokens de Color (CSS Variables)

Asegúrate de que estas variables estén declaradas en el archivo CSS global del proyecto (por ejemplo, en `resources/css/app.css` o `public/css/custom.css`):

```css
/* ============================================
   PALETA DE COLORES · SISTEMA SAAS GANADERO
   App móvil · Sitio web · Panel admin
   ============================================ */

:root {
  /* ---------- Primario · Cielo ---------- */
  --color-primary-50:  #f4fafd;
  --color-primary-100: #e4f3fb;
  --color-primary-200: #c0e4f5;
  --color-primary-300: #93d1ee;
  --color-primary-400: #5ebae6;
  --color-primary-500: #1f9fdc; /* base */
  --color-primary-600: #1a87bb;
  --color-primary-700: #156c96;
  --color-primary-800: #10506e;
  --color-primary-900: #0a3346;

  /* ---------- Secundario · Montaña ---------- */
  --color-secondary-50:  #f3f8f3;
  --color-secondary-100: #e2ede2;
  --color-secondary-200: #bad6ba;
  --color-secondary-300: #89b889;
  --color-secondary-400: #4f944f;
  --color-secondary-500: #0a6b0a; /* base */
  --color-secondary-600: #085b08;
  --color-secondary-700: #074907;
  --color-secondary-800: #053605;
  --color-secondary-900: #004100;

  /* Acento neón — uso puntual: badge "verificado", pin GPS activo */
  --color-accent-neon: #02f202;

  /* ---------- Neutros (negro / blanco) ---------- */
  --color-neutral-0:    #ffffff;
  --color-neutral-50:   #f3f3f3;
  --color-neutral-100:  #e2e3e3;
  --color-neutral-200:  #bcbdbe;
  --color-neutral-300:  #8d8e90;
  --color-neutral-400:  #545559;
  --color-neutral-500:  #111318;
  --color-neutral-600:  #0e1014;
  --color-neutral-700:  #0c0d10;
  --color-neutral-800:  #080a0c;
  --color-neutral-900:  #050608;
  --color-neutral-1000: #000000;

  /* ---------- Semánticos ---------- */
  --color-success:      #0a6b0a; /* origen verificado / transacción válida */
  --color-success-bg:   #f3f8f3;
  --color-warning:      #f59e0b; /* documentación pendiente / en revisión */
  --color-warning-bg:   #fef3e2;
  --color-danger:       #dc2626; /* origen no verificado / posible venta ilegal */
  --color-danger-bg:    #fbe5e5;
  --color-info:         #00b0e8; /* geolocalización / notificaciones */
  --color-info-bg:      #e4f3fb;

  /* ---------- Alias semánticos de superficie (modo claro por defecto) ---------- */
  --bg-body:        var(--color-neutral-0);
  --bg-surface:     var(--color-neutral-50);
  --bg-surface-alt: var(--color-neutral-100);
  --text-primary:   var(--color-neutral-900);
  --text-secondary: var(--color-neutral-500);
  --text-muted:     var(--color-neutral-300);
  --border-color:   var(--color-neutral-100);
}

/* ============================================
   MODO OSCURO
   ============================================ */
[data-mode="dark"] {
  --bg-body:        var(--color-neutral-900);
  --bg-surface:     var(--color-neutral-800);
  --bg-surface-alt: var(--color-neutral-700);
  --text-primary:   var(--color-neutral-50);
  --text-secondary: var(--color-neutral-200);
  --text-muted:     var(--color-neutral-400);
  --border-color:   var(--color-neutral-700);

  --color-success-bg: var(--color-secondary-800);
  --color-warning-bg: #4e3304;
  --color-danger-bg:  #6e1313;
  --color-info-bg:    var(--color-primary-800);
}
```

---

## 🛠️ Integración con Bootstrap

Para que Bootstrap adopte automáticamente nuestra paleta de colores, sobrescribimos sus variables CSS nativas en el archivo CSS global del proyecto (después de la importación de Bootstrap):

```css
/* Sobrescribir variables de Bootstrap con nuestra paleta */
:root {
  /* Colores del tema */
  --bs-primary: var(--color-primary-500);
  --bs-primary-rgb: 31, 159, 220; /* 1f9fdc en RGB */
  
  --bs-secondary: var(--color-secondary-500);
  --bs-secondary-rgb: 10, 107, 10; /* 0a6b0a en RGB */

  --bs-success: var(--color-success);
  --bs-success-rgb: 10, 107, 10;

  --bs-warning: var(--color-warning);
  --bs-warning-rgb: 245, 158, 11;

  --bs-danger: var(--color-danger);
  --bs-danger-rgb: 220, 38, 38;

  --bs-info: var(--color-info);
  --bs-info-rgb: 0, 176, 232;

  /* Fondos y textos base */
  --bs-body-bg: var(--bg-body);
  --bs-body-color: var(--text-primary);
  --bs-border-color: var(--border-color);

  /* Estilos específicos de componentes */
  --bs-link-color: var(--color-primary-500);
  --bs-link-hover-color: var(--color-primary-600);
}

/* Modo oscuro integrado en Bootstrap */
[data-mode="dark"] {
  --bs-body-bg: var(--bg-body);
  --bs-body-color: var(--text-primary);
  --bs-border-color: var(--border-color);
  
  /* Inputs en modo oscuro */
  --bs-body-bg-rgb: 5, 6, 8; /* color-neutral-900 en RGB */
  --bs-tertiary-bg: var(--bg-surface-alt);
}
```

### 🏷️ Clases de Utilidad Personalizadas
Como no usamos Tailwind, añadimos algunas clases de utilidad en el CSS para facilitar el uso de superficies y textos específicos de nuestra paleta:

```css
/* Fondos de superficies */
.bg-surface { background-color: var(--bg-surface) !important; }
.bg-surface-alt { background-color: var(--bg-surface-alt) !important; }

/* Colores de texto jerarquizados */
.text-primary-custom { color: var(--text-primary) !important; }
.text-secondary-custom { color: var(--text-secondary) !important; }
.text-muted-custom { color: var(--text-muted) !important; }

/* Variaciones primarias / secundarias adicionales */
.bg-primary-light { background-color: var(--color-primary-50) !important; }
.bg-secondary-light { background-color: var(--color-secondary-50) !important; }
.text-primary-base { color: var(--color-primary-500) !important; }
.text-secondary-base { color: var(--color-secondary-500) !important; }
```

---

## 📊 Integración con DataTables

Alinea el diseño de los DataTables utilizando las variables CSS en la hoja de estilos personalizada:

```css
/* Personalización de DataTables */
.dataTables_wrapper .dataTables_paginate .paginate_button.current, 
.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
  background: var(--color-primary-500) !important;
  color: var(--color-neutral-0) !important;
  border-color: var(--color-primary-600) !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
  background: var(--color-primary-100) !important;
  color: var(--color-primary-800) !important;
  border-color: var(--color-primary-200) !important;
}

table.dataTable thead th {
  border-bottom: 2px solid var(--color-primary-500) !important;
  color: var(--text-primary);
}

table.dataTable tbody tr {
  background-color: var(--bg-surface);
  color: var(--text-primary);
}

table.dataTable tbody tr:hover {
  background-color: var(--bg-surface-alt) !important;
}

.dataTables_wrapper .dataTables_filter input, 
.dataTables_wrapper .dataTables_length select {
  background-color: var(--bg-body);
  border: 1px solid var(--border-color);
  color: var(--text-primary);
  border-radius: 0.375rem;
  padding: 0.25rem 0.5rem;
}
```

---

## 🚨 Integración con SweetAlert

Para que SweetAlert combine perfectamente con la estética premium del SaaS, configura la paleta mediante JS oCSS:

### Configuración JS Recomendada (SweetAlert2)
Usa los siguientes colores para los botones al llamar a SweetAlert:

```javascript
Swal.fire({
  title: '¿Confirmar operación?',
  text: "Esta acción registrará el ganado.",
  icon: 'warning',
  showCancelButton: true,
  // Colores de la paleta SaaS Ganadero
  confirmButtonColor: '#0a6b0a', // --color-secondary-500 (Verde Montaña / Success)
  cancelButtonColor: '#545559',  // --color-neutral-400 (Gris Neutro)
  confirmButtonText: 'Sí, confirmar',
  cancelButtonText: 'Cancelar'
});
```

### Overrides CSS para SweetAlert
```css
/* Customización de diálogos SweetAlert */
.swal2-popup {
  background-color: var(--bg-surface) !important;
  color: var(--text-primary) !important;
  border: 1px solid var(--border-color) !important;
}

.swal2-title, .swal2-html-container {
  color: var(--text-primary) !important;
}

.swal2-validation-message {
  background-color: var(--color-danger-bg) !important;
  color: var(--color-danger) !important;
}
```

---

## 📐 Pautas de Aplicación y Buenas Prácticas

1. **Primario (Cielo):**
   - El tono base `500` (`#1f9fdc`) es para botones principales de Bootstrap (`btn-primary`), enlaces, y elementos activos.
   - Tonos claros (`50` - `200`) son idóneos para fondos de alertas (`.alert-info`) y áreas de navegación.

2. **Secundario (Montaña):**
   - El tono base `500` (`#0a6b0a`) se utiliza para botones de confirmación (`btn-secondary` redefinido o botones success de negocio como ventas/registros válidos).
   - Simboliza todo lo verificado o ecológico dentro de la gestión de ganado.

3. **Acento Neón (`--color-accent-neon`):**
   - **Uso puntual:** Badges de estado verificado, pins de GPS activos en mapas y notificaciones urgentes. Evitar en fondos grandes o textos comunes.

4. **Alias de Superficie:**
   - Usa siempre las clases y variables semánticas (`bg-surface`, `bg-body`, etc.) en lugar de definir colores fijos como `white` o `#fff`. Esto asegurará que al alternar el atributo `data-mode="dark"` en la etiqueta principal, toda la UI cambie de modo automáticamente.
