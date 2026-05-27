<?php
/**
 * Subir Logo y Favicon SVG a Biblioteca de Medios - Umbral
 */
require_once __DIR__ . '/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Umbral - Subir a Medios</title>
    <style>
        body { font-family: Inter, Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; background: #f5f5f5; }
        h1 { color: #1a1a1a; border-bottom: 3px solid #c9a962; padding-bottom: 10px; }
        .success { color: #28a745; }
        .warning { color: #ffc107; }
        .error { color: #dc3545; }
        pre { background: #333; color: #fff; padding: 15px; border-radius: 5px; overflow-x: auto; }
        .card { background: #fff; padding: 20px; border-radius: 10px; margin: 20px 0; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        img { max-width: 200px; border: 2px solid #c9a962; border-radius: 8px; }
    </style>
</head>
<body>
<h1>🎨 Umbral - Subir Logo y Favicon a Medios</h1>';

$upload_dir = wp_upload_dir();

// Usar get_stylesheet_directory() para el child theme
$child_theme_dir = get_stylesheet_directory();

echo '<p><strong>Debug info:</strong></p>';
echo '<p>Child theme dir (stylesheet): ' . esc_html($child_theme_dir) . '</p>';

$logo_svg = $child_theme_dir . '/logo.svg';
$favicon_svg = $child_theme_dir . '/favicon.svg';

echo '<p>Logo SVG path: ' . esc_html($logo_svg) . '</p>';
echo '<p>Logo SVG exists: ' . (file_exists($logo_svg) ? 'YES' : 'NO') . '</p>';
echo '<p>Favicon SVG exists: ' . (file_exists($favicon_svg) ? 'YES' : 'NO') . '</p>';

echo '<div class="card">';
echo '<h2>📤 Subiendo archivos SVG</h2>';

$uploaded = 0;

// Función para subir SVG
function upload_svg_to_media($file_path, $title, $description) {
    global $upload_dir;
    
    if (!file_exists($file_path)) {
        echo '<p class="error">❌ Archivo no encontrado: ' . esc_html($file_path) . '</p>';
        return false;
    }
    
    // Copiar archivo a directorio de uploads
    $filename = basename($file_path);
    $new_path = $upload_dir['path'] . '/' . $filename;
    
    // Si ya existe, añadir timestamp
    if (file_exists($new_path)) {
        $filename = time() . '-' . $filename;
        $new_path = $upload_dir['path'] . '/' . $filename;
    }
    
    if (!copy($file_path, $new_path)) {
        echo '<p class="error">❌ Error copiando archivo</p>';
        return false;
    }
    
    echo '<p>Archivo copiado a: ' . esc_html($new_path) . '</p>';
    
    // Verificar si ya existe en biblioteca
    $url = $upload_dir['url'] . '/' . $filename;
    $exists = attachment_url_to_postid($url);
    
    if ($exists) {
        echo '<p class="warning">⏭️ Ya existe: ' . esc_html($filename) . ' (ID: ' . $exists . ')</p>';
        return $exists;
    }
    
    // Crear attachment
    $attachment = [
        'post_mime_type' => 'image/svg+xml',
        'post_title' => $title,
        'post_content' => $description,
        'post_excerpt' => $title,
        'post_status' => 'inherit'
    ];
    
    echo '<p>Insertando en base de datos...</p>';
    $attach_id = wp_insert_attachment($attachment, $new_path);
    
    if (!is_wp_error($attach_id)) {
        // Generar metadata
        update_post_meta($attach_id, '_wp_attachment_context', 'custom-logo');
        
        echo '<p class="success">✅ Subido: ' . esc_html($filename) . ' (ID: ' . $attach_id . ')</p>';
        return $attach_id;
    } else {
        echo '<p class="error">❌ Error DB: ' . esc_html($attach_id->get_error_message()) . '</p>';
        return false;
    }
}

// Subir Logo
echo '<h3>🖼️ Logo SVG</h3>';
if (file_exists($logo_svg)) {
    $logo_id = upload_svg_to_media($logo_svg, 'Umbral Logo', 'Logo principal de Umbral - Tienda de Ropa');
    if ($logo_id) {
        echo '<img src="' . esc_url($upload_dir['url'] . '/' . basename($logo_svg)) . '" alt="Logo Umbral">';
    }
} else {
    echo '<p class="error">❌ Logo SVG no encontrado en: ' . esc_html($logo_svg) . '</p>';
}

echo '<hr>';

// Subir Favicon
echo '<h3>🔖 Favicon SVG</h3>';
if (file_exists($favicon_svg)) {
    $favicon_id = upload_svg_to_media($favicon_svg, 'Umbral Favicon', 'Favicon de Umbral - Tienda de Ropa');
    if ($favicon_id) {
        echo '<img src="' . esc_url($upload_dir['url'] . '/' . basename($favicon_svg)) . '" alt="Favicon Umbral" style="max-width:100px;">';
    }
} else {
    echo '<p class="error">❌ Favicon SVG no encontrado en: ' . esc_html($favicon_svg) . '</p>';
}

echo '</div>';

echo '</body></html>';
