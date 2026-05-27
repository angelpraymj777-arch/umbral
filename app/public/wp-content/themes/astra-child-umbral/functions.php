<?php
/**
 * Astra Child Umbral - Functions.php
 * 
 * @package Astra Child Umbral
 * @version 1.0.0
 */

/**
 * No direct access
 */
if (!defined('ABSPATH')) {
    exit();
}

/**
 * Define constantes del child theme
 */
define('ASTRA_CHILD_UMBRAL_VERSION', '1.0.0');

/**
 * Encolar estilos del tema padre y Google Fonts
 */
function astra_child_umbral_enqueue_styles() {
    // Google Fonts - Playfair Display para títulos, Inter para cuerpo
    wp_enqueue_style(
        'umbral-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap',
        array(),
        ASTRA_CHILD_UMBRAL_VERSION
    );

    // Estilos del tema padre (Astra)
    wp_enqueue_style(
        'astra-theme-styles',
        get_template_directory_uri() . '/style.css',
        array(),
        ASTRA_CHILD_UMBRAL_VERSION
    );

    // Estilos del child theme
    wp_enqueue_style(
        'astra-child-umbral-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('astra-theme-styles'),
        ASTRA_CHILD_UMBRAL_VERSION
    );
}
add_action('wp_enqueue_scripts', 'astra_child_umbral_enqueue_styles', 20);

/**
 * Añadir soporte para características de WordPress
 */
function astra_child_umbral_setup() {
    // Soporte para título del sitio
    add_theme_support('title-tag');
    
    // Soporte para logo personalizado
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Soporte para imágenes destacadas
    add_theme_support('post-thumbnails');
    
    // Soporte para HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // Soporte para alineación de bloques Gutenberg
    add_theme_support('align-wide');
    
    // Soporte para colores del editor Gutenberg
    add_theme_support('editor-color-palette', array(
        array(
            'name'  => __('Negro Elegante', 'astra-child-umbral'),
            'slug'  => 'primary',
            'color' => '#1a1a1a',
        ),
        array(
            'name'  => __('Dorado Sofisticado', 'astra-child-umbral'),
            'slug'  => 'secondary',
            'color' => '#c9a962',
        ),
        array(
            'name'  => __('Dorado Claro', 'astra-child-umbral'),
            'slug'  => 'accent',
            'color' => '#d4b87a',
        ),
        array(
            'name'  => __('Blanco', 'astra-child-umbral'),
            'slug'  => 'white',
            'color' => '#ffffff',
        ),
        array(
            'name'  => __('Gris Texto', 'astra-child-umbral'),
            'slug'  => 'text-light',
            'color' => '#666666',
        ),
    ));
    
    // Soporte para tamaños de fuente del editor
    add_theme_support('editor-font-sizes', array(
        array(
            'name'      => __('Pequeño', 'astra-child-umbral'),
            'shortName' => __('S', 'astra-child-umbral'),
            'size'      => 14,
            'slug'      => 'small',
        ),
        array(
            'name'      => __('Normal', 'astra-child-umbral'),
            'shortName' => __('M', 'astra-child-umbral'),
            'size'      => 16,
            'slug'      => 'normal',
        ),
        array(
            'name'      => __('Grande', 'astra-child-umbral'),
            'shortName' => __('L', 'astra-child-umbral'),
            'size'      => 20,
            'slug'      => 'large',
        ),
        array(
            'name'      => __('Extra Grande', 'astra-child-umbral'),
            'shortName' => __('XL', 'astra-child-umbral'),
            'size'      => 24,
            'slug'      => 'huge',
        ),
    ));
    
    // Soporte para woocommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'astra_child_umbral_setup');

/**
 * Registrar ubicaciones de menús
 */
function astra_child_umbral_menus() {
    register_nav_menus(array(
        'primary'   => __('Menú Principal', 'astra-child-umbral'),
        'secondary' => __('Menú Secundario', 'astra-child-umbral'),
        'footer'    => __('Menú Footer', 'astra-child-umbral'),
        'mobile'    => __('Menú Móvil', 'astra-child-umbral'),
    ));
}
add_action('init', 'astra_child_umbral_menus');

/**
 * Configurar valores personalizados de Customizer de Astra
 * Esta función se ejecuta cuando el tema está activo y Astra está instalado
 */
function astra_child_umbral_customize_register($wp_customize) {
    // Sección: Identidad Umbral
    $wp_customize->add_section('umbral_identity', array(
        'title'    => __('Identidad Umbral', 'astra-child-umbral'),
        'priority' => 30,
    ));
    
    // Setting: Texto del tagline
    $wp_customize->add_setting('umbral_tagline_text', array(
        'default'           => 'Moda urbana para hombres y mujeres',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('umbral_tagline_text', array(
        'label'    => __('Tagline Personalizado', 'astra-child-umbral'),
        'section'  => 'umbral_identity',
        'type'     => 'text',
    ));
}
add_action('customize_register', 'astra_child_umbral_customize_register');

/**
 * Añadir CSS custom inline para el header
 */
function astra_child_umbral_header_styles() {
    $primary_color = '#1a1a1a';
    $secondary_color = '#c9a962';
    
    $custom_css = "
        .site-header {
            border-bottom: 2px solid {$secondary_color};
        }
        
        .main-navigation .menu-item a:hover {
            color: {$secondary_color} !important;
        }
        
        .ast-header-break-point .main-header-menu .sub-menu {
            border-top: 3px solid {$secondary_color};
        }
    ";
    
    wp_add_inline_style('astra-child-umbral-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'astra_child_umbral_header_styles', 99);

/**
 * Desactivar emojis de WordPress para mejorar rendimiento
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

/**
 * Añadir clases adicionales al body
 */
function astra_child_umbral_body_classes($classes) {
    // Clase para el tipo de página
    if (is_singular('post')) {
        $classes[] = 'single-post';
    }
    
    // Clase para tiendas WooCommerce
    if (class_exists('WooCommerce') && (is_shop() || is_product_category() || is_product_tag())) {
        $classes[] = 'woocommerce-shop';
    }
    
    return $classes;
}
add_filter('body_class', 'astra_child_umbral_body_classes');

/**
 * Personalizar el excerpt
 */
function astra_child_umbral_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'astra_child_umbral_excerpt_length');

function astra_child_umbral_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'astra_child_umbral_excerpt_more');

/**
 * Helper: Verificar si WooCommerce está activo
 */
function astra_child_umbral_is_woocommerce_active() {
    return class_exists('WooCommerce');
}


// ============================================
// PHP PERSONALIZADO UMBRAL - DÍA 6
// ============================================

function umbral_read_more_text($text) {
    $text = str_replace("[readsmore阅读全文]", "Ver más", $text);
    $text = str_replace("Leer más", "Ver más", $text);
    $text = str_replace("Read more", "Ver más", $text);
    return $text;
}
add_filter("get_the_excerpt", "umbral_read_more_text", 20);

function umbral_excerpt_more($more) {
    return '<a href="' . get_permalink() . '" class="read-more">Ver más →</a>';
}
add_filter("excerpt_more", "umbral_excerpt_more");

function umbral_display_word_count($post_id = null) {
    $post = get_post($post_id);
    if (!$post) return "";
    $content = strip_tags($post->post_content);
    $word_count = str_word_count($content);
    return '<span class="word-count">' . $word_count . ' palabras</span>';
}
add_shortcode("palabras_post", "umbral_display_word_count");

function umbral_anio_actual() {
    return date("Y");
}
add_shortcode("anio_actual", "umbral_anio_actual");

function umbral_disable_emojis() {
    remove_action("wp_head", "print_emoji_detection_script", 7);
    remove_action("admin_print_scripts", "print_emoji_detection_script");
    remove_action("wp_print_styles", "print_emoji_styles");
    remove_action("admin_print_styles", "print_emoji_styles");
    remove_filter("the_content_feed", "wp_staticize_emoji");
    remove_filter("comment_text_rss", "wp_staticize_emoji");
    remove_filter("wp_mail", "wp_staticize_emoji_for_email");
}
add_action("init", "umbral_disable_emojis");

function umbral_body_classes($classes) {
    $classes[] = "umbral-theme";
    if (wp_is_mobile()) {
        $classes[] = "umbral-mobile";
    }
    return $classes;
}
add_filter("body_class", "umbral_body_classes");

// ============================================
// FIN PHP PERSONALIZADO UMBRAL
// ============================================


// Ocultar versión de WordPress
remove_action("wp_head", "wp_generator");
function umbral_remove_version() {
    return "";
}
add_filter("the_generator", "umbral_remove_version");

// ============================================
// SHORTCODE [ultimos_posts] - DÍA 11
// ============================================
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
