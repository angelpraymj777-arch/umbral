# Día 11 - Umbral: PHP para WordPress

## Tienda de Ropa para Hombres y Mujeres

---

## 🎯 Objetivo del Día

Entender y practicar **PHP para WordPress** - leer y escribir código PHP real dentro de WordPress sin miedo.

---

## 📁 Archivos del Día 11

| Archivo | Descripción |
|---------|-------------|
| **[`dia-11-php-wp.php`](dia-11-php-wp.php)** | Script de demostración y verificación |
| **[`functions.php`](wp-content/themes/astra-child-umbral/functions.php)** | Actualizado con shortcode [ultimos_posts] |

---

## 🕘 Bloque 1 - Sintaxis PHP 8 (60 min)

### 1.1 Variables y Tipos

```php
<?php
// Tipos en PHP 8
$tipo_int = 42;
$tipo_string = "Umbral - Ropa premium";
$tipo_bool = true;
$tipo_array = ['Hombre', 'Mujer', 'Accesorios'];
$tipo_null = null;
```

### 1.2 Arrays Asociativos

```php
<?php
$producto = [
    'nombre' => 'Pantalón Sastre Línea Umbra',
    'precio' => 14000,
    'categoria' => 'Hombre',
    'colores' => ['Negro', 'Gris', 'Azul Marino']
];

// Acceder
echo $producto['nombre']; // "Pantalón Sastre Línea Umbra"
echo $producto['precio']; // 14000
```

### 1.3 Operador Null Coalescing

```php
<?php
// PHP 7+
$nombre = $datos['nombre'] ?? 'Invitado';
$telefono = $datos['telefono'] ?? 'No disponible';
```

### 1.4 Arrow Functions

```php
<?php
// PHP 7.4+
$doble = fn($x) => $x * 2;
echo $doble(21); // 42

$precio_formateado = fn($precio) => '$' . number_format($precio, 0, ',', '.');
echo $precio_formateado(14000); // "$14.000"
```

---

## 🕙 Bloque 2 - OOP Básico (60 min)

### 2.1 Clase Producto

```php
<?php
class Producto {
    public string $nombre;
    public float $precio;
    public string $categoria;

    public function __construct(string $nombre, float $precio, string $categoria = 'General') {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->categoria = $categoria;
    }

    public function mostrar(): string {
        return sprintf(
            '<strong>%s</strong> - $%s ARS',
            esc_html($this->nombre),
            number_format($this->precio, 0, ',', '.')
        );
    }

    public function precio_con_iva(float $iva = 0.21): float {
        return $this->precio * (1 + $iva);
    }
}

// Uso
$p = new Producto('Camisa Línea Umbra', 8500, 'Hombre');
echo $p->mostrar();
echo $p->precio_con_iva(); // 10285
```

### 2.2 WordPress Classes

**WP_Query** (`/wp-includes/class-wp-query.php`):
- `__construct()` - Constructor
- `get_posts()` - Obtener posts
- `have_posts()` - Verificar si hay posts
- `the_post()` - Avanzar al siguiente post

**WP_User** (`/wp-includes/class-wp-user.php`):
- `ID` - ID del usuario
- `user_email` - Email
- `display_name` - Nombre para mostrar

---

## 🕚 Bloque 3 - APIs de WordPress (60 min)

### 3.1 get_posts()

```php
<?php
// Obtener últimos 5 posts
$posts = get_posts([
    'numberposts' => 5,
    'post_status' => 'publish'
]);

foreach ($posts as $post) {
    echo esc_html($post->post_title);
}
```

### 3.2 get_post_meta()

```php
<?php
// Obtener meta de un producto WooCommerce
$product_id = 123;
$price = get_post_meta($product_id, '_price', true);
$regular_price = get_post_meta($product_id, '_regular_price', true);
```

### 3.3 wp_remote_get()

```php
<?php
// Llamada a API externa
$response = wp_remote_get('https://api.github.com', [
    'timeout' => 10,
    'headers' => ['User-Agent' => 'Umbral-WP/1.0']
]);

if (is_wp_error($response)) {
    echo 'Error: ' . $response->get_error_message();
} else {
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);
}
```

### 3.4 WP_Query vs get_posts()

| Característica | WP_Query | get_posts() |
|---------------|----------|-------------|
| Tipo de retorno | Objeto | Array |
| Loop completo | Sí | No |
| Modifica $wp_query | Sí | No |
| Uso en shortcodes | No | Sí |

---

## 🕛 Bloque 4 - Shortcode [ultimos_posts] (60 min)

### 4.1 Código en functions.php

```php
<?php
// SHORTCODE [ultimos_posts] - DÍA 11
function umbral_ultimos_posts_shortcode($atts = [], $content = null) {
    $atts = shortcode_atts([
        'numberposts' => 5,
        'category' => ''
    ], $atts, 'ultimos_posts');

    $args = [
        'numberposts' => intval($atts['numberposts']),
        'post_status' => 'publish'
    ];

    if (!empty($atts['category'])) {
        $args['category_name'] = sanitize_text_field($atts['category']);
    }

    $posts = get_posts($args);

    if (empty($posts)) {
        return '<p>No hay posts disponibles.</p>';
    }

    $html = '<ul class="ultimos-posts">';
    foreach ($posts as $post) {
        $title = esc_html(get_the_title($post));
        $link = esc_url(get_permalink($post->ID));
        $html .= '<li><a href="' . $link . '">' . $title . '</a></li>';
    }
    $html .= '</ul>';

    return $html;
}
add_shortcode('ultimos_posts', 'umbral_ultimos_posts_shortcode');
```

### 4.2 Uso en páginas

```
[ultimos_posts]
[ultimos_posts numberposts="3"]
[ultimos_posts category="novedades"]
```

### 4.3 Verificar shortcode

Abre: **http://umbral.local/dia-11-php-wp.php** para ver el shortcode en acción.

---

## ✅ Checklist de Entrega

- [x] El shortcode `[ultimos_posts]` funciona
- [x] Pruebas de PHP 8 completadas
- [x] Clase Producto entendida
- [x] APIs de WordPress probadas

### Errores típicos evitados:

- [x] NO usé `echo` directo en shortcode (debe ser `return`)
- [x] NO modifiqué archivos del core ni theme padre
- [x] Siempre usé `esc_html()` / `esc_attr()` / `esc_url()`

---

## 🔗 Enlaces del Día 11

| Recurso | URL |
|---------|-----|
| Demo PHP | http://umbral.local/dia-11-php-wp.php |
| functions.php | Apariencia → Editor de temas → functions.php |
| Shortcode API | https://developer.wordpress.org/plugins/shortcodes/ |
| WP_Query | https://developer.wordpress.org/reference/classes/wp_query/ |

---

## 📝 Resumen (completar al final)

- **¿Qué aprendí hoy que no sabía ayer?**
  
  _Escribe tu respuesta aquí_

- **¿Dónde me trabé?**
  
  _Escribe tu respuesta aquí_

- **¿Qué pregunta tengo para Marcos?**
  
  _Escribe tu respuesta aquí_

---

*¿Preguntas sobre PHP para WordPress? Consulta con tu instructor.*