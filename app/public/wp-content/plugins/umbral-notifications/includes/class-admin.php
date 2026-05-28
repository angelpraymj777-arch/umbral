<?php
/**
 * Clase para el menú de administración del plugin
 * 
 * @package Umbral_Notifications
 * @subpackage Includes
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Clase Admin para manejar el menú de configuración
 */
class Umbral_Notifications_Admin {

    /**
     * Constructor
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'agregar_menu'));
        add_action('admin_init', array($this, 'registrar_ajustes'));
    }

    /**
     * Agregar menú en Ajustes
     */
    public function agregar_menu() {
        add_options_page(
            'Umbral Notifications',                    // Título de la página
            'Umbral Notifications',                    // Título del menú
            'manage_options',                          // Capacidad requerida
            'umbral-notifications',                   // Slug del menú
            array($this, 'render_pagina_ajustes')     // Callback para renderizar
        );
    }

    /**
     * Registrar ajustes (settings)
     */
    public function registrar_ajustes() {
        // Registrar la opción en la base de datos
        register_setting(
            'umbral_notif_grupo_ajustes',             // Grupo de settings
            'umbral_notif_footer_mensaje',            // Nombre de la opción
            array(
                'type'              => 'string',
                'sanitize_callback' => 'sanitize_text_field',
                'default'           => ''
            )
        );

        // Agregar sección de configuración
        add_settings_section(
            'umbral_notif_seccion_principal',         // ID de la sección
            'Configuración General',                  // Título
            array($this, 'render_seccion_descripcion'),// Callback
            'umbral-notifications'                     // Página
        );

        // Agregar campo de mensaje de footer
        add_settings_field(
            'umbral_notif_footer_mensaje',            // ID del campo
            'Mensaje del Footer',                      // Título
            array($this, 'render_campo_footer'),      // Callback
            'umbral-notifications',                   // Página
            'umbral_notif_seccion_principal'          // Sección
        );
    }

    /**
     * Renderizar descripción de la sección
     */
    public function render_seccion_descripcion() {
        echo '<p>Configura las notificaciones y mensajes de Umbral.</p>';
    }

    /**
     * Renderizar campo del mensaje de footer
     */
    public function render_campo_footer() {
        $valor = get_option('umbral_notif_footer_mensaje', '');
        ?>
        <input 
            type="text" 
            id="umbral_notif_footer_mensaje" 
            name="umbral_notif_footer_mensaje" 
            value="<?php echo esc_attr($valor); ?>" 
            class="regular-text"
            placeholder="Ej: © 2026 Umbral - Moda urbana"
        />
        <p class="description">
            Este mensaje se mostrará en el footer del sitio.
        </p>
        <?php
    }

    /**
     * Renderizar página completa de ajustes
     */
    public function render_pagina_ajustes() {
        // Verificar permisos
        if (!current_user_can('manage_options')) {
            return;
        }
        ?>
        <div class="wrap">
            <h1>
                <span class="dashicons dashicons-bell" style="font-size: 30px; width: 30px; height: 30px; margin-right: 10px;"></span>
                Umbral Notifications
            </h1>
            
            <form method="post" action="options.php">
                <?php
                //nonce y campos ocultos
                settings_fields('umbral_notif_grupo_ajustes');
                
                //renderizar campos
                do_settings_sections('umbral-notifications');
                
                //botón guardar
                submit_button('Guardar Cambios');
                ?>
            </form>

            <hr style="margin: 30px 0;">

            <h2>Estado del Plugin</h2>
            <table class="widefat" style="max-width: 600px;">
                <tr>
                    <td><strong>Página de agradecimiento:</strong></td>
                    <td>
                        <?php
                        $pagina = get_page_by_title('Gracias por tu compra');
                        if ($pagina) {
                            echo '<span style="color: green;">✓ Creada</span>';
                            echo ' <a href="' . esc_url(get_edit_post_link($pagina->ID)) . '">Editar</a>';
                        } else {
                            echo '<span style="color: orange;">Pendiente (se crea al activar)</span>';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><strong>Mensaje de footer:</strong></td>
                    <td><code><?php echo esc_html(get_option('umbral_notif_footer_mensaje', 'No configurado')); ?></code></td>
                </tr>
            </table>
        </div>
        <?php
    }
}

// Inicializar admin
new Umbral_Notifications_Admin();