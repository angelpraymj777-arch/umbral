<?php
/**
 * Día 13 - Bloque 2 - The Loop - Umbral
 * 
 * Tienda de Ropa para Hombres y Mujeres
 */

require_once __DIR__ . '/wp-load.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Umbral - Día 13: The Loop</title>
    <style>
        body { font-family: Inter, Arial, sans-serif; max-width: 900px; margin: 0 auto; padding: 20px; background: #f5f5f5; }
        h1 { color: #1a1a1a; border-bottom: 3px solid #c9a962; }
        .section { background: #fff; padding: 20px; border-radius: 12px; margin: 15px 0; }
        pre { background: #2d2d2d; color: #f8f8f2; padding: 15px; border-radius: 6px; overflow-x: auto; }
        code { background: #f5f5f5; padding: 3px 8px; border-radius: 4px; color: #c9a962; }
        .info { background: #e3f2fd; padding: 15px; border-radius: 8px; border-left: 4px solid #2196f3; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; }
        .ejemplo-loop { background: #f0f0f0; padding: 20px; border-radius: 8px; margin: 15px 0; }
        .post-item { background: #fff; border: 1px solid #ddd; padding: 15px; margin: 10px 0; border-radius: 8px; }
        .post-item h3 { margin-top: 0; color: #1a1a1a; }
        .post-item .meta { color: #666; font-size: 14px; }
    </style>
</head>
<body>
<h1>🔄 The Loop en WordPress - Día 13</h1>
<p><strong>Umbral - Tienda de Ropa para Hombres y Mujeres</strong></p>

<div class="section">
    <h2>¿Qué es The Loop?</h2>
    <p>The Loop es el mecanismo central de WordPress para mostrar posts. Cada vez que visitas una página, WordPress ejecuta una consulta a la base de datos y "itera" sobre los resultados usando The Loop.</p>
    
    <div class="info">
        <strong>Concepto clave:</strong> The Loop usa <code>have_posts()</code> y <code>the_post()</code> para recorrer los resultados de la consulta actual.
    </div>
</div>

<div class="section">
    <h2>Código básico del Loop</h2>
    <pre><?php echo htmlspecialchars('<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        
        <article id="post-<?php the_ID(); ?>">
            <h2><?php the_title(); ?></h2>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
            <div class="entry-meta">
                Por <?php the_author(); ?> el <?php the_date(); ?>
            </div>
        </article>
        
    <?php endwhile; ?>
<?php else : ?>
    <p>No se encontraron posts.</p>
<?php endif; ?>'); ?></pre>
</div>

<div class="section">
    <h2>Funciones disponibles dentro del Loop</h2>
    <table>
        <tr><th>Función</th><th>Descripción</th><th>Ejemplo</th></tr>
        <tr><td><code>the_ID()</code></td><td>ID del post</td><td>42</td></tr>
        <tr><td><code>the_title()</code></td><td>Título</td><td>Camisa Azul</td></tr>
        <tr><td><code>the_content()</code></td><td>Contenido completo</td><td>HTML del producto</td></tr>
        <tr><td><code>the_excerpt()</code></td><td>Resumen</td><td>Descripción corta...</td></tr>
        <tr><td><code>the_permalink()</code></td><td>URL del post</td><td>/producto/camisa-azul</td></tr>
        <tr><td><code>the_post_thumbnail()</code></td><td>Imagen destacada</td><td><img src="..."></td></tr>
        <tr><td><code>the_author()</code></td><td>Nombre del autor</td><td>Admin</td></tr>
        <tr><td><code>the_date()</code></td><td>Fecha de publicación</td><td>28 mayo, 2026</td></tr>
        <tr><td><code>the_tags()</code></td><td>Etiquetas</td><td>oferta, verano</td></tr>
        <tr><td><code>the_category()</code></td><td>Categorías</td><td>Ropa, Remeras</td></tr>
    </table>
</div>

<div class="section">
    <h2>WP_Query Custom</h2>
    <p>Para hacer un Loop personalizado (no el de la consulta global), usa <code>WP_Query</code>:</p>
    
    <pre><?php echo htmlspecialchars('<?php
// Crear consulta custom
$args = [
    \'post_type\' => \'product\',        // tipo de post
    \'posts_per_page\' => 6,             // cuántos posts
    \'post_status\' => \'publish\',       // solo publicados
    \'orderby\' => \'title\',             // ordenar por título
    \'order\' => \'ASC\'                  // A-Z
];

$mis_productos = new WP_Query($args);

// El Loop
if ($mis_productos->have_posts()) {
    while ($mis_productos->have_posts()) {
        $mis_productos->the_post();
        
        echo \'<h3>\' . get_the_title() . \'</h3>\';
        echo \'<a href="\' . get_permalink() . \'">Ver producto</a>\';
    }
    wp_reset_postdata(); // ¡Importante! Restaurar datos originales
} else {
    echo \'<p>No hay productos.</p>\';
}
?>'); ?></pre>

<?php
// EJEMPLO REAL
$args = [
    'post_type' => 'product',
    'posts_per_page' => 4,
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC'
];

$productos_query = new WP_Query($args);
?>

<h3>Ejemplo real (productos de Umbral):</h3>
<div class="ejemplo-loop">
<?php
if ($productos_query->have_posts()) {
    while ($productos_query->have_posts()) {
        $productos_query->the_post();
        global $product;
        ?>
        <div class="post-item">
            <h3><?php the_title(); ?></h3>
            <p class="meta">ID: <?php the_ID(); ?> | <a href="<?php the_permalink(); ?>">Ver producto →</a></p>
            <?php if ($product) : ?>
                <p>Precio: $<?php echo $product->get_price(); ?></p>
            <?php endif; ?>
        </div>
        <?php
    }
    wp_reset_postdata();
} else {
    echo '<p>No hay productos publicados.</p>';
}
?>
</div>
</div>

<div class="section">
    <h2>get_posts() vs WP_Query</h2>
    <table>
        <tr><th>Característica</th><th>WP_Query</th><th>get_posts()</th></tr>
        <tr><td>Usa The Loop</td><td>Sí (con have_posts/the_post)</td><td>No, itera sobre array</td></tr>
        <tr><td>Modifica consulta global</td><td>No</td><td>SÍ (afecta have_posts)</td></tr>
        <tr><td>Rendimiento</td><td>Mayor control, más rápido</td><td>Más simple pero puede afectar global</td></tr>
        <tr><td>Uso típico</td><td>Consultas principales en templates</td><td>Obtener datos sin mostrar</td></tr>
    </table>
    
    <pre><?php echo htmlspecialchars('<?php
// get_posts() - retorna array simple
$posts = get_posts([
    \'post_type\' => \'product\',
    \'numberposts\' => 5
]);

foreach ($posts as $post) {
    echo $post->post_title;
}
wp_reset_postdata();
?>'); ?></pre>
</div>

</body>
</html>