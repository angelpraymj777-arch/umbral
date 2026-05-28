# Umbral Notifications Plugin

Plugin personalizado para la tienda Umbral - Moda urbana para hombres y mujeres.

## Descripción

Plugin que añade funcionalidad de notificaciones y mensajes personalizados para el sitio Umbral.

### Características

- ✅ **Página de agradecimiento automática** al activar el plugin
- ✅ **Mensaje configurable en el footer** del sitio
- ✅ **Menú de administración** en Ajustes → Umbral Notifications
- ✅ **Widget disponible** para colocar en sidebars
- ✅ **Instalación limpia** - al desinstalar se eliminan todos los datos

## Instalación

1. Clonar el repositorio en `wp-content/plugins/`:

```bash
git clone https://github.com/angelpraymj777-arch/umbral-notifications.git umbral-notifications
```

2. Activar el plugin desde **WordPress Admin → Plugins**

3. Configurar el mensaje en **Ajustes → Umbral Notifications**

## Estructura de Archivos

```
umbral-notifications/
├── umbral-notifications.php    # Archivo principal del plugin
├── uninstall.php               # Limpieza al desinstalar
├── includes/
│   ├── class-admin.php         # Menú de administración
│   └── class-widget.php        # Widget de footer
└── README.md                   # Este archivo
```

## Configuración

### Mensaje del Footer

Para cambiar el mensaje del footer, ve a:
**WordPress Admin → Ajustes → Umbral Notifications**

El mensaje predeterminado es: `© 2026 Umbral - Moda urbana para hombres y mujeres`

### Página de Gracias

Al activar el plugin, se crea automáticamente la página "Gracias por tu compra" con el slug `/gracias-por-tu-compra/`.

## Hooks y Filtros

### Opciones guardadas

- `umbral_notif_footer_mensaje` - Mensaje del footer
- `umbral_notif_activado` - Flag de activación

### Funciones disponibles

```php
// Obtener el mensaje configurado
$mensaje = Umbral_Notifications::get_footer_mensaje();

// Mostrar el footer manualmente
umbral_notif_mostrar_footer();
```

## Requisitos

- WordPress 5.0+
- PHP 7.4+

## Autor

**Angel** - Umbral Dev
- GitHub: [angelpraymj777-arch](https://github.com/angelpraymj777-arch)

## Licencia

GPL-2.0+

## Cambios

### 1.0.0 (2026-05-28)
- Versión inicial
- Página de agradecimiento automática
- Mensaje configurable en footer
- Widget para sidebars
- Menú de administración