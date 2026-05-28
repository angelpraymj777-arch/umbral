# Día 13 — Anatomía de WordPress (DB, Loop, Template Hierarchy)

Guía paso a paso para entender la estructura interna de WordPress: base de datos, The Loop y jerarquía de templates.

---

## 1. Base de Datos

### Tablas Principales

WordPress usa un conjunto de tablas en MySQL. Todas empiezan con el prefijo `wp_` (o el que hayas configurado).

| Tabla | Descripción |
|-------|-------------|
| `wp_posts` | Posts, páginas, productos, attachments... **casi todo es un post** |
| `wp_postmeta` | Metadatos en formato clave-valor (precio, SKU, stock) |
| `wp_users` | Usuarios registrados |
| `wp_usermeta` | Metadatos de usuarios |
| `wp_terms` | Términos (categorías, tags) |
| `wp_term_taxonomy` | Taxonomías (define si un término es categoría o tag) |
| `wp_term_relationships` | Relación entre posts y términos |
| `wp_options` | Opciones del sitio (autoload=yes/no) |
| `wp_comments` | Comentarios |
| `wp_commentmeta` | Metadatos de comentarios |

### La tabla wp_posts

**Importante:** En WordPress, casi todo es un post:

```sql
-- Tipos de post que encontrarás:
post_type = 'post'       -- Blog posts
post_type = 'page'       -- Páginas estáticas
post_type = 'product'    -- Productos WooCommerce
post_type = 'shop_order' -- Órdenes WooCommerce
post_type = 'attachment' -- Medios (imágenes, PDFs)
post_type = 'revision'   -- Revisiones de posts
```

**Columnas principales:**

| Columna | Descripción |
|---------|-------------|
| `ID` | ID único del registro |
| `post_title` | Título |
| `post_content` | Contenido (HTML) |
| `post_type` | Tipo de post |
| `post_status` | Estado (publish, draft, pending, private) |
| `post_date` | Fecha de creación |
| `post_author` | ID del usuario autor |
| `post_parent` | ID del post padre (para páginas hijo) |
| `guid` | URL canónica |

### Relación wp_posts ↔ wp_postmeta

Un post tiene N filas en `wp_postmeta`:

```sql
-- Un producto (ID=42) tiene en wp_postmeta:
post_id=42, meta_key='_price', meta_value='8500'
post_id=42, meta_key='_sku', meta_value='CAM-001'
post_id=42, meta_key='_stock', meta_value='50'
post_id=42, meta_key='_weight', meta_value='0.3'
```

### La tabla wp_options

Almacena configuraciones del sitio. El campo `autoload` es importante para performance:

- `autoload = 'yes'`: Se carga en cada página (consume RAM)
- `autoload = 'no'`: Se carga solo cuando se necesita (más lento pero ahorra RAM)

```sql
-- Ver opciones de Umbral en phpMyAdmin:
SELECT option_name, option_value 
FROM wp_options 
WHERE option_name LIKE '%umbral%';
```

---

## 2. The Loop

### ¿Qué es The Loop?

The Loop es el mecanismo de WordPress para mostrar posts. Itera sobre los resultados de la consulta actual y renderiza cada post.

### Código básico:

```php
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        
        <article id="post-<?php the_ID(); ?>">
            <h2><?php the_title(); ?></h2>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </article>
        
    <?php endwhile; ?>
<?php else : ?>
    <p>No se encontraron posts.</p>
<?php endif; ?>
```

### Funciones dentro del Loop:

| Función | Descripción |
|---------|-------------|
| `the_ID()` | ID del post |
| `the_title()` | Título |
| `the_content()` | Contenido completo |
| `the_excerpt()` | Resumen |
| `the_permalink()` | URL |
| `the_post_thumbnail()` | Imagen destacada |
| `the_author()` | Autor |
| `the_date()` | Fecha |
| `the_tags()` | Etiquetas |
| `the_category()` | Categorías |

### WP_Query Custom:

Para hacer consultas personalizadas (no la global):

```php
$args = [
    'post_type' => 'product',
    'posts_per_page' => 6,
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC'
];

$mis_productos = new WP_Query($args);

if ($mis_productos->have_posts()) {
    while ($mis_productos->have_posts()) {
        $mis_productos->the_post();
        echo get_the_title() . '<br>';
    }
    wp_reset_postdata(); // ¡Importante!
}
```

### get_posts() vs WP_Query:

- **WP_Query**: Usa The Loop con `have_posts()` / `the_post()`, no modifica la consulta global
- **get_posts()**: Retorna un array simple, modifica la consulta global

---

## 3. Template Hierarchy

### ¿Qué es?

WordPress determina qué archivo PHP usar basándose en la URL. Si no existe el más específico, usa el siguiente en la jerarquía.

### Jerarquía de Templates:

```
FRONT PAGE (/)
  1. front-page.php
  2. home.php
  3. index.php

SINGLE POST (/blog/mi-post/)
  1. single-{post_type}.php  (ej: single-product.php)
  2. single.php
  3. singular.php
  4. index.php

SINGLE PRODUCT (/producto/camiseta/)
  1. single-product.php  ← WooCommerce
  2. single.php
  3. index.php

CATEGORY (/categoria/ropa/)
  1. category-{slug}.php
  2. category-{id}.php
  3. category.php
  4. archive.php
  5. index.php

TAG (/tag/oferta/)
  1. tag-{slug}.php
  2. tag.php
  3. archive.php
  4. index.php

TAXONOMY (/product_cat/remeras/)
  1. taxonomy-{taxonomy}-{term}.php
  2. taxonomy-{taxonomy}.php
  3. archive.php
  4. index.php

SEARCH (?s=camisa)
  1. search.php
  2. index.php

404
  1. 404.php
  2. index.php
```

### Diagrama Visual:

![Template Hierarchy](https://developer.wordpress.org/files/2014/10/template-hierarchy.png)

[Ver diagrama oficial completo →](https://developer.wordpress.org/themes/basics/template-hierarchy/)

---

## 4. Ejercicio Práctico

### Parte A — Consulta SQL en phpMyAdmin:

Ejecuta esta consulta para ver productos con precios:

```sql
SELECT p.ID, p.post_title, pm.meta_value AS precio
FROM wp_posts p
JOIN wp_postmeta pm ON pm.post_id = p.ID AND pm.meta_key = '_price'
WHERE p.post_type = 'product' AND p.post_status = 'publish'
ORDER BY p.post_title;
```

### Parte B — Crear single-product.php:

Crea este archivo en tu child theme para personalizar la página de producto:

```php
<?php
// single-product.php del child theme
get_header();

while (have_posts()) :
    the_post();
    global $product;
    ?>
    
    <h1><?php the_title(); ?></h1>
    <p class="price">$<?php echo $product->get_price(); ?></p>
    <?php the_content(); ?>
    
<?php
endwhile;

get_footer();
```

---

## Resumen: Regla de Oro

> **"En WordPress, casi todo es un post."**
> 
> Productos, páginas, posts, órdenes... todos viven en `wp_posts` con diferente `post_type`.
> Los metadatos (precio, stock, etc.) están en `wp_postmeta`.

---

## Recursos:

- [Template Hierarchy oficial](https://developer.wordpress.org/themes/basics/template-hierarchy/)
- [WP_Query reference](https://developer.wordpress.org/reference/classes/wp_query/)
- [Diagrama de DB WordPress](https://www.database-diagrams.org/wordpress)