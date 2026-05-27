<?php
/**
 * Publicar Página Tienda
 * Proyecto Umbral
 */

require_once __DIR__ . '/wp-load.php';

echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Umbral - Publicar Página Tienda</title>
    <style>
        body { font-family: Inter, Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; background: #f5f5f5; }
        h1 { color: #1a1a1a; border-bottom: 3px solid #c9a962; padding-bottom: 10px; }
        .section { background: #fff; padding: 20px; border-radius: 10px; margin: 15px 0; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .success { background: #d4edda; border: 1px solid #28a745; padding: 15px; border-radius: 8px; color: #155724; }
        .error { background: #f8d7da; border: 1px solid #dc3545; padding: 15px; border-radius: 8px; color: #721c24; }
        .info { background: #e3f2fd; padding: 15px; border-radius: 8px; border-left: 4px solid #2196f3; }
        .button { display: inline-block; background: #c9a962; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin: 5px; }
        .button-green { background: #28a745; }
    </style>
</head>
<body>
<h1>🛍️ Publicar Página Tienda</h1>';

// Buscar página "Tienda"
$tienda = get_page_by_title('Tienda');

if (!$tienda) {
    echo '<div class="error">❌ No se encontró la página "Tienda"</div>';
    echo '</body></html>';
    exit;
}

echo '<div class="section">';
echo '<h2>📄 Estado Actual</h2>';
echo '<p><strong>Página:</strong> ' . $tienda->post_title . '</p>';
echo '<p><strong>ID:</strong> ' . $tienda->ID . '</p>';
echo '<p><strong>Estado actual:</strong> ' . $tienda->post_status . '</p>';

if ($tienda->post_status === 'publish') {
    echo '<div class="success">✅ La página "Tienda" ya está publicada</div>';
} else {
    // Publicar la página
    wp_update_post([
        'ID' => $tienda->ID,
        'post_status' => 'publish'
    ]);
    
    echo '<div class="success">✅ Página "Tienda" marcada como publicada</div>';
}

echo '</div>';

echo '<div class="section">';
echo '<h3>🔗 Enlaces</h3>';
echo '<a href="' . admin_url('post.php?post=' . $tienda->ID . '&action=edit') . '" class="button">✏️ Editar página</a>';
echo '<a href="' . get_permalink($tienda->ID) . '" class="button button-green" target="_blank">👁️ Ver página</a>';
echo '</div>';

echo '</body></html>';