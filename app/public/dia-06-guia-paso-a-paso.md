# Día 6 - Umbral: Responsive + CSS + PHP

## Tienda de Ropa para Hombres y Mujeres

---

## 🎯 Objetivo del Día
Afinar el sitio en **móvil y tablet**, aplicar CSS personalizado con la paleta de Umbral, y añadir funcionalidades PHP al child theme.

---

## 📋 Paso 1: Revisión Responsive (60 min)

### 1.1 Abrir sitio en modo responsivo

1. Abre tu sitio: [http://umbral.local](http://umbral.local)
2. Abre **Chrome DevTools** (F12 o clic derecho → Inspeccionar)
3. Haz clic en el **icono de dispositivo** (Device Toggle Toolbar)
4. Selecciona diferentes dispositivos para probar

### 1.2 Dispositivos a probar

| Dispositivo | Ancho | Qué verificar |
|-------------|-------|--------------|
| **iPhone 12** | 390px | Scroll horizontal, tamaño de texto |
| **iPad** | 768px | Layout de 2 columnas |
| **Galaxy S21** | 360px | Todo el contenido visible |
| **Escritorio** | 1440px | Vista completa |

### 1.3 Ajustes comunes en Elementor

Para cada sección, verifica:

- [ ] **Tipografía**: ¿El texto es legible en móvil?
- [ ] **Imágenes**: ¿Se redimensionan correctamente?
- [ ] **Botones**: ¿Son lo suficientemente grandes para tocar?
- [ ] **Padding**: ¿Hay suficiente espacio en los márgenes?
- [ ] **Scroll horizontal**: ¿Se puede desplazar sin problemas?

### 1.4 Ajustes en Elementor

1. Selecciona una sección o columna
2. Ve a **Estilo** (Style)
3. Busca **Responsive** (icono de tablet/móvil)
4. Ajusta:
   - **Padding** para móvil
   - **Tamaño de fuente** para móvil
   - **Altura mínima** si es necesario

---

## 🎨 Paso 2: CSS Personalizado (60 min)

### 2.1 Copiar CSS personalizado

He creado un archivo CSS con todos los estilos para Umbral: **[`dia-06-css-custom.css`](dia-06-css-custom.css)**

**Contenido del CSS:**
- Variables CSS con los colores de Umbral
- Botones personalizados (dorado sobre negro)
- Estilos para WooCommerce
- Clases utilitarias (`.section-dark`, `.section-gold`, `.section-light`)
- Responsive para tablet y móvil
- Efectos hover

### 2.2 Añadir CSS al sitio

**Opción A: Personalizador de WordPress**

1. Ve a **Apariencia → Personalizar**
2. Busca **CSS adicional** (o "Additional CSS")
3. Copia y pega todo el contenido de [`dia-06-css-custom.css`](dia-06-css-custom.css)
4. Haz clic en **Publicar**

**Opción B: Directamente en el child theme**

1. Abre el archivo:
   ```
   wp-content/themes/astra-child-umbral/style.css
   ```
2. Añade el CSS al final del archivo
3. Guarda

### 2.3 Clases utilitarias disponibles

| Clase | Descripción | Uso en Elementor |
|-------|-------------|------------------|
| `.section-dark` | Fondo negro con texto claro | Añadir clase CSS en sección |
| `.section-gold` | Fondo dorado con texto blanco | Añadir clase CSS en sección |
| `.section-light` | Fondo gris claro | Añadir clase CSS en sección |
| `.text-center` | Texto centrado | Añadir clase CSS |
| `.text-gold` | Texto color dorado | Añadir clase CSS |
| `.hide-mobile` | Ocultar en móvil | Añadir clase CSS |

### 2.4 Aplicar clase a sección en Elementor

1. Selecciona la **sección** en Elementor
2. Ve a **Diseño → Avanzado**
3. En **Clases CSS** (CSS Classes), escribe:
   ```
   section-dark
   ```
4. Actualiza/Publica

---

## 🔧 Paso 3: PHP en Functions.php (60 min)

### 3.1 Abrir script de referencia

He creado un script con los snippets PHP: **[`dia-06-php-custom.php`](dia-06-php-custom.php)**

Este script muestra todos los snippets disponibles y cómo añadirlos.

### 3.2 Snippets PHP incluidos

| Snippet | Descripción | Cómo usarlo |
|---------|-------------|-------------|
| **Texto "Leer más"** | Cambia "Leer más" por "Ver más" | Automático |
| **Número de palabras** | Muestra cuántas palabras tiene un post | Shortcode `[palabras_post]` |
| **Año actual** | Devuelve el año actual | Shortcode `[anio_actual]` |
| **Desactivar emojis** | Limpia código innecesario | Automático |
| **Clases body** | Añade clases útiles | Automático |

### 3.3 Cómo añadir los snippets

1. **Abre el archivo functions.php:**
   ```
   wp-content/themes/astra-child-umbral/functions.php
   ```

2. **Copia cada snippet** del script [`dia-06-php-custom.php`](dia-06-php-custom.php)

3. **Pega los snippets** antes de la línea que dice `?>`

4. **Guarda el archivo**

### 3.4 Usar el shortcode [anio_actual]

Para mostrar el año actual en el footer:

1. Edita el **footer con Elementor**
2. Añade un widget de **Shortcode** o **HTML**
3. Escribe:
   ```
   [anio_actual]
   ```
4. Publica

---

## 📝 Paso 4: Template single.php (45 min)

### 4.1 Copiar single.php al child theme

1. **Origen:**
   ```
   wp-content/themes/astra/single.php
   ```

2. **Destino:**
   ```
   wp-content/themes/astra-child-umbral/single.php
   ```

### 4.2 Modificar para mostrar categoría

En el archivo copiado (`single.php` del child), busca:

```php
<h1 class="entry-title"><?php the_title(); ?></h1>
```

Y cámbialo por:

```php
<span class="entry-category"><?php the_category(', '); ?></span>
<h1 class="entry-title"><?php the_title(); ?></h1>
```

### 4.3 Verificar que funciona

1. Publica un nuevo post
2. Abre el post en el frontend
3. Verifica que la categoría aparece **antes** del título

---

## ✅ Paso 5: Checklist de Cierre

Marca cada uno al completar:

- [ ] **Revisión responsive**: Sitio se ve bien en móvil sin scroll horizontal
- [ ] **CSS personalizado**: Styles de Umbral aplicados
- [ ] **Clases utilitarias**: Al menos una sección usa `.section-dark` o similar
- [ ] **Shortcode [anio_actual]**: Funciona en el footer
- [ ] **Template single.php**: Category se muestra antes del título
- [ ] **Functions.php**: Los snippets PHP están activos

---

## 📁 Archivos del Día 6

| Archivo | Descripción |
|---------|-------------|
| **[`dia-06-php-custom.php`](dia-06-php-custom.php)** | Script con snippets PHP para functions.php |
| **[`dia-06-css-custom.css`](dia-06-css-custom.css)** | CSS personalizado completo para Umbral |
| **[`dia-06-guia-paso-a-paso.md`](dia-06-guia-paso-a-paso.md)** | Esta guía |

---

## 🔗 Enlaces Rápidos

| Recurso | URL |
|---------|-----|
| **Tu Sitio** | http://umbral.local |
| **Personalizador CSS** | http://umbral.local/wp-admin/customize.php |
| **Editor de temas** | http://umbral.local/wp-admin/theme-editor.php |
| **Functions.php** | `wp-content/themes/astra-child-umbral/functions.php` |
| **Style.css** | `wp-content/themes/astra-child-umbral/style.css` |

---

## 🎉 ¡Completado!

Si terminaste todos los pasos, tu sitio Umbral ahora tiene:
- ✅ Diseño responsive para móvil y tablet
- ✅ Estilos personalizados con la paleta de la marca
- ✅ Shortcodes funcionales
- ✅ Template de post personalizado

---

*¿Terminaste el Día 6? Comparte los resultados para continuar con el Día 7.*