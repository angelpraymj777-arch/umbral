<?php
/**
 * Día 13 - Bloque 4 - SQL Directo a la DB - Umbral
 * 
 * Tienda de Ropa para Hombres y Mujeres
 */

require_once __DIR__ . '/wp-load.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Umbral - Día 13: Consultas SQL</title>
    <style>
        body { font-family: Inter, Arial, sans-serif; max-width: 900px; margin: 0 auto; padding: 20px; background: #f5f5f5; }
        h1 { color: #1a1a1a; border-bottom: 3px solid #c9a962; }
        .section { background: #fff; padding: 20px; border-radius: 12px; margin: 15px 0; }
        pre { background: #2d2d2d; color: #f8f8f2; padding: 15px; border-radius: 6px; overflow-x: auto; font-size: 13px; }
        code { background: #f5f5f5; padding: 3px 8px; border-radius: 4px; color: #c9a962; }
        .info { background: #e3f2fd; padding: 15px; border-radius: 8px; border-left: 4px solid #2196f3; }
        .warning { background: #fff3cd; padding: 15px; border-radius: 8px; border-left: 4px solid #ffc107; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; }
        .result-table { background: #f8f9fa; padding: 15px; border-radius: 8px; margin: 15px 0; }
    </style>
</head>
<body>
<h1>🗄️ Consultas SQL Directas - Día 13</h1>
<p><strong>Umbral - Tienda de Ropa para Hombres y Mujeres</strong></p>

<div class="section">
    <h2>¿Por qué consultar la DB directamente?</h2>
    <p>A veces necesitas datos que no puedes obtener fácilmente con funciones de WordPress. Las consultas SQL directas te dan control total sobre los datos.</p>
    
    <div class="warning">
        <strong>⚠️ Importante:</strong> Usa <code>$wpdb</code> para consultas seguras (con prepare()).
    </div>
</div>

<div class="section">
    <h2>Consultas útiles con $wpdb</h2>
    
    <h3>1. Obtener todos los productos con precio:</h3>
    <pre><?php echo htmlspecialchars('global $wpdb;

$sql = "SELECT p.ID, p.post_title, pm.meta_value AS precio
FROM ' . $wpdb->posts . ' p
JOIN ' . $wpdb->postmeta . ' pm ON pm.post_id = p.ID AND pm.meta_key = \'_price\'
WHERE p.post_type = \'product\' AND p.post_status = \'publish\'
ORDER BY p.post_title;";

$productos = $wpdb->get_results($sql);
foreach ($productos as $producto) {
    echo $producto->post_title . " - $" . $producto->precio . "<br>";
}'); ?></pre>

<?php
global $wpdb;

$sql = "SELECT p.ID, p.post_title, pm.meta_value AS precio
FROM {$wpdb->posts} p
JOIN {$wpdb->postmeta} pm ON pm.post_id = p.ID AND pm.meta_key = '_price'
WHERE p.post_type = 'product' AND p.post_status = 'publish'
ORDER BY p.post_title
LIMIT 10";

$productos = $wpdb->get_results($sql);
?>

<h4>Resultado:</h4>
<div class="result-table">
<?php if ($productos) : ?>
    <table>
        <tr><th>ID</th><th>Producto</th><th>Precio</th></tr>
        <?php foreach ($productos as $p) : ?>
            <tr>
                <td><?php echo esc_html($p->ID); ?></td>
                <td><?php echo esc_html($p->post_title); ?></td>
                <td>$<?php echo esc_html($p->precio); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else : ?>
    <p>No hay productos con precio definido.</p>
<?php endif; ?>
</div>
</div>

<div class="section">
    <h3>2. Obtener productos sin stock:</h3>
    <pre><?php echo htmlspecialchars('global $wpdb;

$sql = "SELECT p.ID, p.post_title, pm.meta_value AS stock
FROM ' . $wpdb->posts . ' p
JOIN ' . $wpdb->postmeta . ' pm ON pm.post_id = p.ID AND pm.meta_key = \'_stock\'
WHERE p.post_type = \'product\' 
AND p.post_status = \'publish\'
AND CAST(pm.meta_value AS SIGNED) <= 0
ORDER BY p.post_title;";

$sin_stock = $wpdb->get_results($sql);'); ?></pre>

<?php
$sql2 = "SELECT p.ID, p.post_title, pm.meta_value AS stock
FROM {$wpdb->posts} p
JOIN {$wpdb->postmeta} pm ON pm.post_id = p.ID AND pm.meta_key = '_stock'
WHERE p.post_type = 'product' 
AND p.post_status = 'publish'
AND CAST(pm.meta_value AS SIGNED) <= 0
ORDER BY p.post_title
LIMIT 5";

$sin_stock = $wpdb->get_results($sql2);
?>

<h4>Productos sin stock:</h4>
<div class="result-table">
<?php if ($sin_stock) : ?>
    <table>
        <tr><th>ID</th><th>Producto</th><th>Stock</th></tr>
        <?php foreach ($sin_stock as $p) : ?>
            <tr>
                <td><?php echo esc_html($p->ID); ?></td>
                <td><?php echo esc_html($p->post_title); ?></td>
                <td><?php echo esc_html($p->stock); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else : ?>
    <p>Todos los productos tienen stock disponible.</p>
<?php endif; ?>
</div>
</div>

<div class="section">
    <h3>3. Obtener todos los valores de una opción:</h3>
    <pre><?php echo htmlspecialchars('// Ver todas las opciones que contengan "umbral"
global $wpdb;

$sql = "SELECT option_name, option_value 
FROM ' . $wpdb->options . '
WHERE option_name LIKE \'%umbral%\'
ORDER BY option_name;";

$opciones = $wpdb->get_results($sql);
foreach ($opciones as $op) {
    echo $op->option_name . "<br>";
}'); ?></pre>

<?php
$sql3 = "SELECT option_name, option_value 
FROM {$wpdb->options}
WHERE option_name LIKE '%umbral%'
ORDER BY option_name";

$opciones = $wpdb->get_results($sql3);
?>

<h4>Opciones de Umbral:</h4>
<div class="result-table">
<?php if ($opciones) : ?>
    <table>
        <tr><th>Option Name</th><th>Value (primeros 100 chars)</th></tr>
        <?php foreach ($opciones as $op) : ?>
            <tr>
                <td><code><?php echo esc_html($op->option_name); ?></code></td>
                <td><?php echo esc_html(substr($op->option_value, 0, 100)); echo strlen($op->option_value) > 100 ? '...' : ''; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else : ?>
    <p>No se encontraron opciones con "umbral" en el nombre.</p>
<?php endif; ?>
</div>
</div>

<div class="section">
    <h3>4. Contar posts por tipo:</h3>
    <pre><?php echo htmlspecialchars('global $wpdb;

$sql = "SELECT post_type, COUNT(*) as cantidad
FROM ' . $wpdb->posts . '
WHERE post_status = \'publish\'
GROUP BY post_type
ORDER BY cantidad DESC;";

$conteo = $wpdb->get_results($sql);'); ?></pre>

<?php
$sql4 = "SELECT post_type, COUNT(*) as cantidad
FROM {$wpdb->posts}
WHERE post_status = 'publish'
GROUP BY post_type
ORDER BY cantidad DESC";

$conteo = $wpdb->get_results($sql4);
?>

<h4>Conteo de posts por tipo:</h4>
<div class="result-table">
<?php if ($conteo) : ?>
    <table>
        <tr><th>Tipo de Post</th><th>Cantidad</th></tr>
        <?php foreach ($conteo as $c) : ?>
            <tr>
                <td><code><?php echo esc_html($c->post_type); ?></code></td>
                <td><?php echo esc_html($c->cantidad); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else : ?>
    <p>No hay datos.</p>
<?php endif; ?>
</div>
</div>

<div class="section">
    <h2>Consultas para ejecutar en phpMyAdmin</h2>
    <p>Copia y ejecuta estas consultas directamente en phpMyAdmin (SQL tab):</p>
    
    <h3>Productos con precios:</h3>
    <pre>SELECT p.ID, p.post_title, pm.meta_value AS precio
FROM wp_posts p
JOIN wp_postmeta pm ON pm.post_id = p.ID AND pm.meta_key = '_price'
WHERE p.post_type = 'product' AND p.post_status = 'publish'
ORDER BY p.post_title;</pre>
    
    <h3>Órdenes recientes de WooCommerce:</h3>
    <pre>SELECT ID, post_date, post_status
FROM wp_posts
WHERE post_type = 'shop_order'
AND post_status IN ('wc-completed', 'wc-processing')
ORDER BY post_date DESC
LIMIT 10;</pre>
    
    <h3>Usuarios registrados:</h3>
    <pre>SELECT ID, user_login, user_email, user_registered
FROM wp_users
ORDER BY user_registered DESC
LIMIT 10;</pre>
</div>

</body>
</html>