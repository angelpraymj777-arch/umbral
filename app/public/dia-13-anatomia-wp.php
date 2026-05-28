<?php
/**
 * Día 13 - Umbral - Anatomía de WordPress
 * 
 * Tienda de Ropa para Hombres y Mujeres
 * 
 * Este script demuestra la anatomía de WordPress:
 * - Base de datos (tablas y relaciones)
 * - The Loop
 * - Template Hierarchy
 */

require_once __DIR__ . '/wp-load.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Umbral - Día 13: Anatomía de WordPress</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: Inter, Arial, sans-serif; max-width: 950px; margin: 0 auto; padding: 20px; background: #f5f5f5; }
        h1 { color: #1a1a1a; border-bottom: 3px solid #c9a962; padding-bottom: 10px; }
        h2 { color: #333; margin-top: 30px; }
        h3 { color: #555; }
        .section { background: #fff; padding: 20px; border-radius: 12px; margin: 15px 0; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .success { background: #d4edda; border: 1px solid #28a745; padding: 15px; border-radius: 8px; margin: 10px 0; color: #155724; }
        .error { background: #f8d7da; border: 1px solid #dc3545; padding: 15px; border-radius: 8px; margin: 10px 0; color: #721c24; }
        .info { background: #e3f2fd; padding: 15px; border-radius: 8px; border-left: 4px solid #2196f3; margin: 10px 0; }
        pre { background: #2d2d2d; color: #f8f8f2; padding: 15px; border-radius: 6px; overflow-x: auto; font-size: 13px; }
        code { background: #f5f5f5; padding: 3px 8px; border-radius: 4px; color: #c9a962; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; }
        .checklist { background: #f8f9fa; padding: 20px; border-radius: 10px; }
        .checklist li { margin: 8px 0; }
        .diagrama { background: #fff3cd; padding: 20px; border-radius: 8px; border-left: 4px solid #ffc107; margin: 10px 0; }
    </style>
</head>
<body>
<h1>📚 Día 13 - Anatomía de WordPress</h1>
<p><strong>Umbral - Tienda de Ropa para Hombres y Mujeres</strong></p>
<hr>

<?php
// ============================================
// BLOQUE 1: BASE DE DATOS
// ============================================

echo '<h2>🕘 Bloque 1 - Base de Datos</h2>';
echo '<div class="section">';

echo '<h3>Tablas Principales de WordPress</h3>';

$tablas_wp = [
    'wp_posts' => 'Posts, páginas, productos, attachments (todo es un post)',
    'wp_postmeta' => 'Metadatos de posts (precio, SKU, etc.)',
    'wp_users' => 'Usuarios del sistema',
    'wp_usermeta' => 'Metadatos de usuarios',
    'wp_terms' => 'Términos (categorías, tags, etiquetas)',
    'wp_term_taxonomy' => 'Taxonomías (definición de cada término)',
    'wp_term_relationships' => 'Relaciones entre posts y términos',
    'wp_options' => 'Opciones del sitio (autoload=yes/no)',
    'wp_postmeta' => 'Clave-valor para posts',
    'wp_usermeta' => 'Clave-valor para usuarios',
];

echo '<table>';
echo '<tr><th>Tabla</th><th>Descripción</th></tr>';
foreach ($tablas_wp as $tabla => $desc) {
    echo '<tr><td><code>' . esc_html($tabla) . '</code></td><td>' . esc_html($desc) . '</td></tr>';
}
echo '</table>';

echo '<h3>La tabla wp_posts</h3>';
echo '<div class="info">';
echo '<strong>Importante:</strong> En WordPress, <em>casi todo es un post</em>. Productos, órdenes, páginas, posts son filas en <code>wp_posts</code> con diferente <code>post_type</code>.';
echo '</div>';

echo '<h4>Columnas principales de wp_posts:</h4>';
echo '<pre>';
echo 'ID                  → ID único del registro' . PHP_EOL;
echo 'post_title          → Título' . PHP_EOL;
echo 'post_content        → Contenido' . PHP_EOL;
echo 'post_type           → "post", "page", "product", "shop_order", etc.' . PHP_EOL;
echo 'post_status         → "publish", "draft", "pending", "private"' . PHP_EOL;
echo 'post_date           → Fecha de creación' . PHP_EOL;
echo 'post_author         → ID del usuario autor' . PHP_EOL;
echo 'post_parent         → ID del post padre (para páginas hijo)' . PHP_EOL;
echo 'guid                → URL canónica del objeto' . PHP_EOL;
echo '</pre>';

echo '<h3>Relación wp_posts ↔ wp_postmeta</h3>';
echo '<pre>';
echo 'wp_posts.id = wp_postmeta.post_id' . PHP_EOL;
echo PHP_EOL;
echo 'Ejemplo: Un producto con ID=42 tiene:' . PHP_EOL;
echo '  wp_postmeta.post_id = 42, meta_key = "_price", meta_value = "8500"' . PHP_EOL;
echo '  wp_postmeta.post_id = 42, meta_key = "_sku", meta_value = "CAM-001"' . PHP_EOL;
echo '  wp_postmeta.post_id = 42, meta_key = "_stock", meta_value = "50"' . PHP_EOL;
echo '</pre>';

echo '<h3> wp_options y autoload</h3>';
echo '<div class="diagrama">';
echo '<strong>¿Qué es autoload?</strong><br>';
echo '<code>autoload = "yes"</code> → Se carga en cada página (rápido pero consume RAM)<br>';
echo '<code>autoload = "no"</code> → Se carga solo cuando se necesita (más lento pero ahorra RAM)<br>';
echo '<br>';
echo 'WordPress carga todas las opciones con autoload=yes en memoria al iniciar.';
echo '</div>';

echo '</div>';

// ============================================
// BLOQUE 2: THE LOOP
// ============================================

echo '<h2>🕙 Bloque 2 - The Loop</h2>';
echo '<div class="section">';

echo '<h3>¿Qué es The Loop?</h3>';
echo '<p>The Loop es el mecanismo de WordPress para mostrar posts. Itera sobre los resultados de la consulta y renderiza cada post.</p>';

echo '<h3>Código básico del Loop:</h3>';
echo '<pre>';
echo '<?php if (have_posts()) : ?>' . PHP_EOL;
echo '    <?php while (have_posts()) : the_post(); ?>' . PHP_EOL;
echo '        <h2><?php the_title(); ?></h2>' . PHP_EOL;
echo '        <div><?php the_content(); ?></div>' . PHP_EOL;
echo '    <?php endwhile; ?>' . PHP_EOL;
echo '<?php else : ?>' . PHP_EOL;
echo '    <p>No se encontraron posts.</p>' . PHP_EOL;
echo '<?php endif; ?>';
echo '</pre>';

echo '<h3>Funciones del Loop:</h3>';
echo '<table>';
echo '<tr><th>Función</th><th>Descripción</th></tr>';
echo '<tr><td><code>the_title()</code></td><td>Muestra el título del post</td></tr>';
echo '<tr><td><code>the_content()</code></td><td>Muestra el contenido completo</td></tr>';
echo '<tr><td><code>the_excerpt()</code></td><td>Muestra el resumen ( excerpt)</td></tr>';
echo '<tr><td><code>the_permalink()</code></td><td>Muestra la URL del post</td></tr>';
echo '<tr><td><code>the_ID()</code></td><td>Muestra el ID del post</td></tr>';
echo '<tr><td><code>the_date()</code></td><td>Muestra la fecha</td></tr>';
echo '<tr><td><code>the_author()</code></td><td>Muestra el autor</td></tr>';
echo '<tr><td><code>the_post_thumbnail()</code></td><td>Muestra la imagen destacada</td></tr>';
echo '</table>';

echo '<h3>Ejemplo real de The Loop:</h3>';
echo '<pre>';
echo '<?php
// En el archivo index.php, front-page.php, etc.
while (have_posts()) {
    the_post();
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h2 class="entry-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    </article>
    <?php
}
?>';
echo '</pre>';

echo '</div>';

// ============================================
// BLOQUE 3: TEMPLATE HIERARCHY
// ============================================

echo '<h2>🕚 Bloque 3 - Template Hierarchy</h2>';
echo '<div class="section">';

echo '<h3>¿Qué es la Template Hierarchy?</h3>';
echo '<p>WordPress usa un sistema de archivos de tema para determinar qué template renderiza cada URL. Si no existe un archivo específico, usa el siguiente en la jerarquía.</p>';

echo '<h3>Jerarquía de Templates:</h3>';
echo '<pre>';
echo 'FRONT PAGE (/):' . PHP_EOL;
echo '  1. front-page.php' . PHP_EOL;
echo '  2. home.php' . PHP_EOL;
echo '  3. index.php' . PHP_EOL;
echo PHP_EOL;
echo 'SINGLE POST (/blog/mi-post/):' . PHP_EOL;
echo '  1. single-{post_type}.php (ej: single-product.php)' . PHP_EOL;
echo '  2. single.php' . PHP_EOL;
echo '  3. singular.php' . PHP_EOL;
echo '  4. index.php' . PHP_EOL;
echo PHP_EOL;
echo 'SINGLE PRODUCT (/producto/camiseta/):' . PHP_EOL;
echo '  1. single-product.php  ← WooCommerce usa esto' . PHP_EOL;
echo '  2. single.php' . PHP_EOL;
echo '  3. index.php' . PHP_EOL;
echo PHP_EOL;
echo 'CATEGORY (/categoria/ropa/):' . PHP_EOL;
echo '  1. category-{slug}.php (ej: category-ropa.php)' . PHP_EOL;
echo '  2. category-{id}.php' . PHP_EOL;
echo '  3. category.php' . PHP_EOL;
echo '  4. archive.php' . PHP_EOL;
echo '  5. index.php' . PHP_EOL;
echo PHP_EOL;
echo 'TAG (/tag/oferta/):' . PHP_EOL;
echo '  1. tag-{slug}.php' . PHP_EOL;
echo '  2. tag.php' . PHP_EOL;
echo '  3. archive.php' . PHP_EOL;
echo '  4. index.php' . PHP_EOL;
echo PHP_EOL;
echo 'TAXONOMY (/product_cat/remeras/):' . PHP_EOL;
echo '  1. taxonomy-{taxonomy}-{term}.php' . PHP_EOL;
echo '  2. taxonomy-{taxonomy}.php' . PHP_EOL;
echo '  3. archive.php' . PHP_EOL;
echo '  4. index.php' . PHP_EOL;
echo PHP_EOL;
echo 'SEARCH (/ ?s=camisa):' . PHP_EOL;
echo '  1. search.php' . PHP_EOL;
echo '  2. index.php' . PHP_EOL;
echo PHP_EOL;
echo '404 (página no encontrada):' . PHP_EOL;
echo '  1. 404.php' . PHP_EOL;
echo '  2. index.php' . PHP_EOL;
echo '</pre>';

echo '<h3>Diagrama Visual:</h3>';
echo '<div class="diagrama">';
echo '<img src="https://developer.wordpress.org/files/2014/10/template-hierarchy.png" alt="Template Hierarchy" style="max-width:100%;border:1px solid #ddd;border-radius:8px;">';
echo '<p><a href="https://developer.wordpress.org/themes/basics/template-hierarchy/" target="_blank">Ver diagrama oficial completo ↗</a></p>';
echo '</div>';

echo '<h3>Ejercicio: Crear single-product.php</h3>';
echo '<div class="info">';
echo 'Para crear un template custom para productos WooCommerce, crea el archivo <code>single-product.php</code> en tu child theme.';
echo '</div>';

echo '</div>';

// ============================================
// BLOQUE 4: EJERCICIO PRÁCTICO
// ============================================

echo '<h2>🕛 Bloque 4 - Ejercicio Práctico</h2>';
echo '<div class="section">';

echo '<h3>Parte A - Consulta SQL</h3>';
echo '<p>Ejecuta esta consulta en phpMyAdmin para ver productos con precios:</p>';

$sql_query = "SELECT p.ID, p.post_title, pm.meta_value AS precio
FROM wp_posts p
JOIN wp_postmeta pm ON pm.post_id = p.ID AND pm.meta_key = '_price'
WHERE p.post_type = 'product' AND p.post_status = 'publish'
ORDER BY p.post_title;";

echo '<pre>' . esc_html($sql_query) . '</pre>';

echo '<h3>Parte B - WP_Query Custom</h3>';
echo '<p>El siguiente código muestra cómo hacer un Loop custom:</p>';

echo '<pre>';
echo '// En functions.php o template:' . PHP_EOL;
echo '$args = [' . PHP_EOL;
echo '    \'post_type\' => \'product\',' . PHP_EOL;
echo '    \'posts_per_page\' => 5,' . PHP_EOL;
echo '    \'post_status\' => \'publish\',' . PHP_EOL;
echo '    \'orderby\' => \'title\',' . PHP_EOL;
echo '    \'order\' => \'ASC\'' . PHP_EOL;
echo '];' . PHP_EOL;
echo PHP_EOL;
echo '$query = new WP_Query($args);' . PHP_EOL;
echo PHP_EOL;
echo 'if ($query->have_posts()) {' . PHP_EOL;
echo '    while ($query->have_posts()) {' . PHP_EOL;
echo '        $query->the_post();' . PHP_EOL;
echo '        echo get_the_title() . \"<br>\";' . PHP_EOL;
echo '    }' . PHP_EOL;
echo '    wp_reset_postdata();' . PHP_EOL;
echo '}';
echo '</pre>';

echo '<h3>Ver los productos del site:</h3>';

$productos = new WP_Query([
    'post_type' => 'product',
    'posts_per_page' => 5,
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC'
]);

if ($productos->have_posts()) {
    echo '<table>';
    echo '<tr><th>ID</th><th>Producto</th><th>Precio</th><th>Stock</th></tr>';
    while ($productos->have_posts()) {
        $productos->the_post();
        global $product;
        $precio = $product ? $product->get_price() : 'N/A';
        $stock = $product ? $product->get_stock_quantity() : 'N/A';
        echo '<tr>';
        echo '<td>' . get_the_ID() . '</td>';
        echo '<td><a href="' . get_permalink() . '">' . esc_html(get_the_title()) . '</a></td>';
        echo '<td>$' . esc_html($precio) . '</td>';
        echo '<td>' . esc_html($stock) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    wp_reset_postdata();
} else {
    echo '<p>No hay productos publicados aún.</p>';
}

echo '</div>';

// ============================================
// CHECKLIST
// ============================================

echo '<h2>✅ Checklist de Entrega - Día 13</h2>';
echo '<div class="section">';

echo '<div class="checklist">';
echo '<ul>';
echo '<li><label><input type="checkbox"> Exploré las tablas en phpMyAdmin</label></li>';
echo '<li><label><input type="checkbox"> Entendí la relación wp_posts ↔ wp_postmeta</label></li>';
echo '<li><label><input type="checkbox"> Identifiqué The Loop en index.php del tema</label></li>';
echo '<li><label><input type="checkbox"> Sé qué archivo se carga para cada tipo de URL</label></li>';
echo '<li><label><input type="checkbox"> Ejecuté la consulta SQL en phpMyAdmin</label></li>';
echo '<li><label><input type="checkbox"> Creé single-product.php en el child theme</label></li>';
echo '</ul>';
echo '</div>';

echo '<h3>Regla de oro de hoy:</h3>';
echo '<div class="success">';
echo '<strong>"En WordPress, casi todo es un post."</strong><br>';
echo 'Productos, páginas, posts, órdenes... todos viven en wp_posts con diferente post_type.';
echo '</div>';

echo '</div>';

// ============================================
// ENLACES
// ============================================

echo '<h2>🔗 Enlaces del Día 13</h2>';
echo '<div class="section">';
echo '<ul>';
echo '<li><a href="https://developer.wordpress.org/themes/basics/template-hierarchy/" target="_blank">Template Hierarchy (oficial) ↗</a></li>';
echo '<li><a href="https://developer.wordpress.org/reference/classes/wp_query/" target="_blank">WP_Query Reference ↗</a></li>';
echo '<li><a href="https://developer.wordpress.org/reference/functions/the_loop/" target="_blank">The Loop ↗</a></li>';
echo '<li><a href="https://www.database-diagrams.org/wordpress" target="_blank">Diagrama de DB WordPress ↗</a></li>';
echo '</ul>';
echo '</div>';

echo '</body></html>';