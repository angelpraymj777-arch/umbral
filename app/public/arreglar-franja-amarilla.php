<?php
/**
 * Eliminar franja amarilla del sitio
 * Añade CSS para ocultar elementos no deseados
 */

require_once __DIR__ . '/wp-load.php';

echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Umbral - Eliminar Franja Amarilla</title>
    <style>
        body { font-family: Inter, Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; background: #f5f5f5; }
        h1 { color: #1a1a1a; border-bottom: 3px solid #c9a962; padding-bottom: 10px; }
        .section { background: #fff; padding: 20px; border-radius: 10px; margin: 15px 0; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .success { background: #d4edda; border: 1px solid #28a745; padding: 15px; border-radius: 8px; color: #155724; }
        .error { background: #f8d7da; border: 1px solid #dc3545; padding: 15px; border-radius: 8px; color: #721c24; }
        .warning { background: #fff3cd; padding: 15px; border-radius: 8px; border-left: 4px solid #ffc107; }
        .button { display: inline-block; background: #c9a962; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin: 5px; }
        pre { background: #2d2d2d; color: #f8f8f2; padding: 15px; border-radius: 6px; overflow-x: auto; }
    </style>
</head>
<body>
<h1>🟡 Eliminar Franja Amarilla</h1>';

// CSS para ocultar la franja amarilla
$css_to_add = '

/* OCULTAR FRANJA AMARILLA - ADMIN BAR Y NOTIFICACIONES */

/* Ocultar barra de admin cuando no es administrador */
body.admin-bar #wpadminbar {
    display: none !important;
}

/* Ocultar notificaciones de plugins */
#wpbody-content > .notice,
#wpbody-content > .updated,
#wpbody-content > .error {
    display: none !important;
}

/* Ocultar banner de actualización de WordPress */
#wpfooter,
.updates-available {
    display: none !important;
}

/* Franja amarilla de Elementor - editor */
.elementor-editor-active .elementor-editor-alert {
    display: none !important;
}

/* Notificaciones de WooCommerce */
.woocommerce-message,
.woocommerce-error,
.woocommerce-info {
    display: none !important;
}

/* Banner superior genérico */
body #page > .alert,
body #page > .notice,
body > .notification-area {
    display: none !important;
}

/* Si es solo para usuarios no logueados, ocultar todo */
@media screen and (max-width: 782px) {
    #wpadminbar {
        display: none !important;
    }
}

';

$style_file = get_stylesheet_directory() . '/style.css';

if (file_exists($style_file)) {
    $current_css = file_get_contents($style_file);
    
    // Verificar si ya está añadido
    if (strpos($current_css, 'OCULTAR FRANJA AMARILLA') !== false) {
        echo '<div class="success">✅ El CSS para ocultar la franja ya está añadido</div>';
    } else {
        $result = file_put_contents($style_file, $current_css . $css_to_add);
        if ($result) {
            echo '<div class="success">✅ CSS añadido para ocultar franja amarilla</div>';
        } else {
            echo '<div class="error">❌ Error al escribir en style.css</div>';
        }
    }
} else {
    echo '<div class="error">❌ style.css no encontrado</div>';
}

echo '<div class="section">';
echo '<h2>ℹ️ Información</h2>';
echo '<p>La franja amarilla podría ser:</p>';
echo '<ul>';
echo '<li><strong>Barra de administración de WordPress</strong> - Visible cuando estás logueado</li>';
echo '<li><strong>Notificaciones de plugins</strong> - Mensajes de WooCommerce, Elementor, etc.</li>';
echo '<li><strong>Banner de actualización</strong> - Notificación de actualización de WordPress</li>';
echo '</ul>';
echo '<p><strong>Nota:</strong> Si la franja solo aparece cuando estás logueado, es la barra de administración y es normal.</p>';
echo '</div>';

echo '<div class="section">';
echo '<h3>🔗 Enlaces</h3>';
echo '<a href="' . admin_url('admin.php?page=welcome') . '" class="button">🎛️ Opciones de Pantalla</a>';
echo '<a href="' . site_url() . '" class="button">🌐 Ver Sitio (incógnito)</a>';
echo '</div>';

echo '</body></html>';