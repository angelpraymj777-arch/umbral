<?php
/**
 * Archivo de desinstalación del plugin
 * 
 * Este archivo SE EJECUTA cuando el usuario elimina el plugin (no al desactivar).
 * Aquí sí se deben borrar todos los datos creados por el plugin.
 * 
 * @package Umbral_Notifications
 */

// Si no fue llamado desde WordPress, salir
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Eliminar opciones creadas por el plugin
delete_option('umbral_notif_footer_mensaje');
delete_option('umbral_notif_activado');

// Eliminar página de agradecimiento
$pagina = get_page_by_title('Gracias por tu compra');
if ($pagina) {
    wp_delete_post($pagina->ID, true);
}

// Eliminar transients
delete_transient('umbral_notif_cache');

// Log de desinstalación
error_log('[Umbral Notifications] Plugin desinstalado y datos eliminados');