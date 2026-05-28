# Día 12 — JavaScript + jQuery + AJAX en WordPress

Guía paso a paso para implementar JavaScript moderno, jQuery y AJAX en tu tema Umbral.

---

## 1. JavaScript Moderno (ES6+)

### Variables y Constantes

```javascript
// Variables con let (alcance de bloque)
let mensaje = '¡Hola, Umbral!';

// Constantes (no pueden ser reasignadas)
const PI = 3.1416;
const CONFIG = {
    apiUrl: 'https://tutienda.com/wp-json',
    nonce: 'tu-nonce-aqui'
};

// Template literals (backticks)
let nombre = 'María';
let saludo = `Bienvenida a Umbral, ${nombre}!`;
```

### Arrow Functions

```javascript
// Función tradicional
function sumar(a, b) {
    return a + b;
}

// Arrow function
const sumarArrow = (a, b) => a + b;

// Con un parámetro (paréntesis opcionales)
const duplicar = x => x * 2;

// Con múltiples parámetros
const saludar = (nombre, idioma) => {
    if (idioma === 'es') {
        return `¡Hola, ${nombre}!`;
    }
    return `Hello, ${nombre}!`;
};
```

### Destructuring

```javascript
// De objetos
const usuario = { nombre: 'Carlos', email: 'carlos@email.com', rol: 'cliente' };
const { nombre, email } = usuario;

// De arrays
const colores = ['#1a1a1a', '#c9a962', '#ffffff'];
const [primario, secundario] = colores;
```

### Fetch API (Reemplaza a jQuery.ajax)

```javascript
// GET request
fetch('https://tutienda.com/wp-json/wp/v2/posts?per_page=3')
    .then(response => response.json())
    .then(data => {
        console.log('Posts:', data);
    })
    .catch(error => {
        console.error('Error:', error);
    });

// POST request con async/await
async function enviarFormulario(datos) {
    try {
        const respuesta = await fetch('/wp-admin/admin-ajax.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams(datos)
        });
        
        const resultado = await respuesta.json();
        return resultado;
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}
```

---

## 2. jQuery en WordPress

WordPress carga jQuery en modo **noConflict** para evitar conflictos con otras librerías. Esto significa que no puedes usar `$` directamente.

### Modo noConflict

```javascript
// Wrapping con IIFE
(function($) {
    'use strict';
    
    // Tu código aquí puede usar $ normalmente
    $(document).ready(function() {
        console.log('jQuery cargado y listo');
    });
    
})(jQuery);

// Versión alternativa
jQuery(document).ready(function($) {
    // $ está disponible aquí
});
```

### Ejemplos de Selectores

```javascript
(function($) {
    $(document).ready(function() {
        
        // Seleccionar por ID
        $('#mi-formulario')
        
        // Seleccionar por clase
        $('.producto-card')
        
        // Seleccionar elementos dentro de otro
        $('#carrito').find('.producto')
        
        // Filtros
        $('input').filter('[type="email"]')
        $('li').first()
        $('li').last()
        $('li').eq(2) // Tercer elemento (0-indexed)
        
    });
})(jQuery);
```

### Eventos con jQuery

```javascript
(function($) {
    $(document).ready(function() {
        
        // Click
        $('#btn-enviar').on('click', function(e) {
            e.preventDefault();
            console.log('Botón clickeado');
        });
        
        // Submit de formulario
        $('#form-contacto').on('submit', function(e) {
            e.preventDefault();
            // Procesar formulario
        });
        
        // Hover
        $('.producto').hover(
            function() { $(this).addClass('hover'); },
            function() { $(this).removeClass('hover'); }
        );
        
        // Change
        $('select[name="talla"]').on('change', function() {
            console.log('Talla seleccionada:', $(this).val());
        });
        
    });
})(jQuery);
```

### Efectos y Animaciones

```javascript
(function($) {
    $(document).ready(function() {
        
        // Mostrar/Ocultar
        $('.panel').hide();
        $('.panel').show();
        $('.panel').toggle();
        
        // Fade
        $('.panel').fadeIn();
        $('.panel').fadeOut();
        $('.panel').fadeToggle();
        
        // Slide
        $('.panel').slideUp();
        $('.panel').slideDown();
        $('.panel').slideToggle();
        
        // Animación personalizada
        $('.boton').animate({
            opacity: 0.5,
            marginLeft: '10px'
        }, 300);
        
    });
})(jQuery);
```

---

## 3. AJAX en WordPress

### Cómo funciona admin-ajax.php

WordPress usa `/wp-admin/admin-ajax.php` como endpoint para todas las peticiones AJAX. Debes enviar:

| Parámetro | Descripción |
|-----------|-------------|
| `action` | Nombre de la acción (ej: `umbral_guardar_lead`) |
| `nonce` | Token de seguridad |
| Otros parámetros | Los datos que necesites enviar |

### Flow de una petición AJAX

```
1. JavaScript: Envía datos a admin-ajax.php
2. WordPress: Recibe la petición
3. WordPress: Verifica el nonce
4. Hook: Ejecuta la función registrada para esa acción
5. Respuesta: Devuelve JSON con éxito o error
6. JavaScript: Recibe la respuesta y actualiza la UI
```

### Nonces en WordPress

Los nonces son tokens de seguridad que validan que la petición viene de tu sitio.

```php
// En PHP: Crear el nonce
$nonce = wp_create_nonce('umbral_lead_nonce');

// En JavaScript: Pasar el nonce con los datos
$.ajax({
    url: '/wp-admin/admin-ajax.php',
    type: 'POST',
    data: {
        action: 'umbral_guardar_lead',
        seguridad: '<?php echo $nonce; ?>',
        nombre: 'Juan',
        email: 'juan@email.com'
    },
    success: function(respuesta) {
        console.log(respuesta);
    }
});
```

### Registrar el AJAX Handler en PHP

```php
// Registrar la acción AJAX (para usuarios logueados)
add_action('wp_ajax_umbral_guardar_lead', 'umbral_guardar_lead');

// Registrar la acción AJAX (para usuarios NO logueados)
add_action('wp_ajax_nopriv_umbral_guardar_lead', 'umbral_guardar_lead');

function umbral_guardar_lead() {
    // Verificar nonce
    check_ajax_referer('umbral_lead_nonce', 'seguridad');
    
    // Sanitizar datos
    $nombre = sanitize_text_field($_POST['nombre'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    
    // Validar
    if (empty($nombre) || empty($email)) {
        wp_send_json_error([
            'mensaje' => 'Por favor completá todos los campos.'
        ]);
    }
    
    // Procesar (guardar en BD, enviar email, etc.)
    // ...
    
    // Responder con éxito
    wp_send_json_success([
        'mensaje' => '¡Gracias! Tu mensaje fue enviado.'
    ]);
}
```

---

## 4. Práctica: Formulario de Leads con AJAX

### HTML del Formulario

```html
<form id="umbral-formulario-lead" class="umbral-form">
    <div class="campo">
        <label for="lead-nombre">Nombre completo *</label>
        <input type="text" id="lead-nombre" name="nombre" required>
    </div>
    
    <div class="campo">
        <label for="lead-email">Email *</label>
        <input type="email" id="lead-email" name="email" required>
    </div>
    
    <div class="campo">
        <label for="lead-telefono">Teléfono</label>
        <input type="tel" id="lead-telefono" name="telefono">
    </div>
    
    <div class="campo">
        <label for="lead-mensaje">Mensaje</label>
        <textarea id="lead-mensaje" name="mensaje" rows="4"></textarea>
    </div>
    
    <button type="submit" class="btn-umbral">
        <span>Enviar mensaje</span>
        <span class="loader" style="display:none;">Enviando...</span>
    </button>
    
    <div class="mensaje-respuesta" style="display:none;"></div>
</form>
```

### CSS

```css
.umbral-form {
    max-width: 500px;
    margin: 0 auto;
}

.umbral-form .campo {
    margin-bottom: 20px;
}

.umbral-form label {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    color: #1a1a1a;
}

.umbral-form input,
.umbral-form textarea {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
    transition: border-color 0.3s;
}

.umbral-form input:focus,
.umbral-form textarea:focus {
    outline: none;
    border-color: #c9a962;
}

.umbral-form .btn-umbral {
    width: 100%;
    padding: 14px 28px;
    background: #1a1a1a;
    color: #fff;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s;
}

.umbral-form .btn-umbral:hover {
    background: #c9a962;
}

.mensaje-respuesta {
    margin-top: 20px;
    padding: 15px;
    border-radius: 4px;
    text-align: center;
}

.mensaje-respuesta.exito {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.mensaje-respuesta.error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}
```

### JavaScript (con jQuery)

```javascript
(function($) {
    'use strict';
    
    $(document).ready(function() {
        
        const $form = $('#umbral-formulario-lead');
        const $btnSubmit = $form.find('button[type="submit"]');
        const $mensajeDiv = $form.find('.mensaje-respuesta');
        
        $form.on('submit', function(e) {
            e.preventDefault();
            
            // Mostrar loading
            $btnSubmit.find('span:first').hide();
            $btnSubmit.find('.loader').show();
            $btnSubmit.prop('disabled', true);
            $mensajeDiv.hide();
            
            // Serializar datos del formulario
            const datos = $form.serializeArray();
            
            // Agregar el nonce (debes generar este nonce en PHP)
            datos.push({
                name: 'seguridad',
                value: umbralAjax.nonce
            });
            
            // Agregar la acción
            datos.push({
                name: 'action',
                value: 'umbral_guardar_lead'
            });
            
            // Enviar AJAX
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'POST',
                data: $.param(datos),
                dataType: 'json'
            })
            .done(function(respuesta) {
                if (respuesta.success) {
                    $mensajeDiv
                        .removeClass('error')
                        .addClass('exito')
                        .html('<strong>¡Éxito!</strong> ' + respuesta.data.mensaje)
                        .fadeIn();
                    $form[0].reset();
                } else {
                    let mensajeError = respuesta.data.mensaje || 'Ocurrió un error.';
                    if (respuesta.data.errores) {
                        mensajeError += '<br>' + respuesta.data.errores.join('<br>');
                    }
                    $mensajeDiv
                        .removeClass('exito')
                        .addClass('error')
                        .html(mensajeError)
                        .fadeIn();
                }
            })
            .fail(function() {
                $mensajeDiv
                    .removeClass('exito')
                    .addClass('error')
                    .html('Error de conexión. Por favor intentá de nuevo.')
                    .fadeIn();
            })
            .always(function() {
                // Quitar loading
                $btnSubmit.find('.loader').hide();
                $btnSubmit.find('span:first').show();
                $btnSubmit.prop('disabled', false);
            });
        });
        
    });
    
})(jQuery);
```

### Encolar el JavaScript con wp_localize_script

En `functions.php`:

```php
function umbral_enqueue_scripts() {
    wp_enqueue_script(
        'umbral-lead-form',
        get_stylesheet_directory_uri() . '/js/lead-form.js',
        array('jquery'),
        '1.0.0',
        true
    );
    
    // Pasar datos de PHP a JavaScript
    wp_localize_script('umbral-lead-form', 'umbralAjax', array(
        'nonce' => wp_create_nonce('umbral_lead_nonce'),
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'umbral_enqueue_scripts');
```

---

## Resumen de Conceptos Clave

| Concepto | Descripción |
|----------|-------------|
| **admin-ajax.php** | Endpoint de WordPress para peticiones AJAX |
| **wp_ajax_** | Hook para acciones de usuarios logueados |
| **wp_ajax_nopriv_** | Hook para acciones de usuarios anónimos |
| **wp_create_nonce()** | Crear token de seguridad |
| **check_ajax_referer()** | Verificar token de seguridad |
| **wp_send_json_success()** | Responder con éxito (JSON) |
| **wp_send_json_error()** | Responder con error (JSON) |
| **wp_localize_script()** | Pasar datos de PHP a JavaScript |
| **$.param()** | jQuery: Serializar objeto a string |
| **fetch API** | Alternativa moderna a XMLHttpRequest |

---

## Recursos Adicionales

- [WordPress AJAX API](https://developer.wordpress.org/plugins/javascript/ajax/)
- [jQuery AJAX](https://api.jquery.com/jQuery.ajax/)
- [ES6 Guide](https://flaviocopes.com/ecmascript-2015/)