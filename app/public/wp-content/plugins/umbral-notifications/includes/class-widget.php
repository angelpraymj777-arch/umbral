<?php
/**
 * Widget para mostrar mensaje en el footer
 * 
 * @package Umbral_Notifications
 * @subpackage Includes
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Widget del mensaje de footer
 */
class Umbral_Notifications_Widget extends WP_Widget {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct(
            'umbral_notif_footer_widget',                 // ID base del widget
            'Umbral - Mensaje Footer',                    // Nombre del widget
            array(
                'description' => 'Muestra un mensaje personalizado en el footer',
                'classname'   => 'umbral-notif-widget',
            )
        );
    }

    /**
     * Renderizar widget en el frontend
     */
    public function widget($args, $instance) {
        $mensaje = !empty($instance['mensaje']) 
            ? $instance['mensaje'] 
            : get_option('umbral_notif_footer_mensaje', '');

        if (empty($mensaje)) {
            return;
        }

        echo $args['before_widget'];
        ?>
        <div class="umbral-footer-notification" style="
            background: linear-gradient(135deg, #1a1a1a 0%, #333 100%);
            color: #c9a962;
            padding: 15px 20px;
            text-align: center;
            font-size: 14px;
            border-top: 2px solid #c9a962;
        ">
            <p style="margin: 0; font-family: 'Inter', sans-serif;">
                <?php echo esc_html($mensaje); ?>
            </p>
        </div>
        <?php
        echo $args['after_widget'];
    }

    /**
     * Formulario de configuración en el admin
     */
    public function form($instance) {
        $mensaje = !empty($instance['mensaje']) ? $instance['mensaje'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('mensaje')); ?>">
                Mensaje:
            </label>
            <input 
                type="text" 
                id="<?php echo esc_attr($this->get_field_id('mensaje')); ?>" 
                name="<?php echo esc_attr($this->get_field_name('mensaje')); ?>" 
                value="<?php echo esc_attr($mensaje); ?>" 
                class="widefat"
                placeholder="Ej: © 2026 Umbral - Moda urbana"
            />
        </p>
        <p>
            <small>
                Déjalo vacío para usar el mensaje configurado en 
                <strong>Ajustes → Umbral Notifications</strong>
            </small>
        </p>
        <?php
    }

    /**
     * Guardar configuración del widget
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['mensaje'] = !empty($new_instance['mensaje']) 
            ? sanitize_text_field($new_instance['mensaje']) 
            : '';
        return $instance;
    }
}

// Registrar el widget
add_action('widgets_init', function() {
    register_widget('Umbral_Notifications_Widget');
});

/**
 * Función helper para mostrar el footer sin usar widget
 * Se puede usar con: add_action('wp_footer', 'umbral_notif_mostrar_footer');
 */
function umbral_notif_mostrar_footer() {
    $mensaje = get_option('umbral_notif_footer_mensaje', '');
    
    if (empty($mensaje)) {
        return;
    }
    ?>
    <div class="umbral-footer-notification" style="
        background: linear-gradient(135deg, #1a1a1a 0%, #333 100%);
        color: #c9a962;
        padding: 15px 20px;
        text-align: center;
        font-size: 14px;
        border-top: 2px solid #c9a962;
        font-family: 'Inter', sans-serif;
    ">
        <p style="margin: 0;">
            <?php echo esc_html($mensaje); ?>
        </p>
    </div>
    <?php
}
add_action('wp_footer', 'umbral_notif_mostrar_footer');