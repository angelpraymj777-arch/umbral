<?php
/**
 * Plugin Name: Umbral Notifications
 * Plugin URI: https://github.com/angelpraymj777-arch/umbral-notifications
 * Description: Plugin personalizado para Umbral - Gestión de notificaciones, página de agradecimiento y widget de mensaje en footer.
 * Version: 1.0.0
 * Author: Angel - Umbral
 * Author URI: https://github.com/angelpraymj777-arch
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: umbral-notifications
 * Domain Path: /languages
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Definir constantes del plugin
define('UMBRAL_NOTIF_VERSION', '1.0.0');
define('UMBRAL_NOTIF_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('UMBRAL_NOTIF_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Clase principal del plugin
 */
class Umbral_Notifications {

    /**
     * Instancia única del plugin
     */
    private static $instance = null;

    /**
     * Obtener instancia única (Singleton)
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     */
    private function __construct() {
        $this->cargar_textdomain();
        $this->registrar_hooks();
    }

    /**
     * Cargar traducciones
     */
    private function cargar_textdomain() {
        load_plugin_textdomain(
            'umbral-notifications',
            false,
            dirname(plugin_basename(__FILE__)) . '/languages'
        );
    }

    /**
     * Registrar hooks de activación/desactivación
     */
    private function registrar_hooks() {
        // Activation hook
        register_activation_hook(__FILE__, array($this, 'activar'));
        
        // Deactivation hook
        register_deactivation_hook(__FILE__, array($this, 'desactivar'));
    }

    /**
     * Hook de activación
     */
    public function activar() {
        // Crear página de agradecimiento si no existe
        $this->crear_pagina_gracias();

        // Crear opción por defecto para mensaje de footer
        add_option('umbral_notif_footer_mensaje', '© 2026 Umbral - Moda urbana para hombres y mujeres');

        // Guardar flag de activación
        update_option('umbral_notif_activado', true);

        // Log para debug
        error_log('[Umbral Notifications] Plugin activado correctamente');
    }

    /**
     * Hook de desactivación
     * NO borra datos - solo al desinstalar
     */
    public function desactivar() {
        // Limpiar transients si hay
        delete_transient('umbral_notif_cache');

        // Log para debug
        error_log('[Umbral Notifications] Plugin desactivado');
    }

    /**
     * Crear página de agradecimiento
     */
    private function crear_pagina_gracias() {
        // Verificar si la página ya existe
        $pagina_existe = get_page_by_title('Gracias por tu compra');

        if (!$pagina_existe) {
            $contenido = sprintf(
                '<h1>¡Gracias por tu compra!</h1>
                <p>Tu pedido ha sido recibido exitosamente.</p>
                <p>Recibirás un email de confirmación en breve.</p>
                <p>¿Dudas? Contáctanos: <a href="mailto:hola@umbral.com">hola@umbral.com</a></p>
                <p><a href="%s" class="button">Volver al inicio</a></p>',
                esc_url(home_url('/'))
            );

            wp_insert_post(array(
                'post_title'    => 'Gracias por tu compra',
                'post_name'     => 'gracias-por-tu-compra',
                'post_content'  => $contenido,
                'post_status'   => 'publish',
                'post_type'     => 'page',
            ));
        }
    }

    /**
     * Obtener mensaje del footer
     */
    public static function get_footer_mensaje() {
        return get_option('umbral_notif_footer_mensaje', '');
    }
}

// Inicializar plugin
function umbral_notif_init() {
    return Umbral_Notifications::get_instance();
}
add_action('plugins_loaded', 'umbral_notif_init');

// Cargar clases de includes
require_once UMBRAL_NOTIF_PLUGIN_DIR . 'includes/class-admin.php';
require_once UMBRAL_NOTIF_PLUGIN_DIR . 'includes/class-widget.php';