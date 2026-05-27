# Día 9 - Umbral: Seguridad, Performance y SEO

## Tienda de Ropa para Hombres y Mujeres

---

## 🎯 Objetivo del Día
Dejar el sitio listo para producción: hardening, velocidad y SEO on-page auditados.

---

## PRIMERA PARTE: VERIFICACIÓN AUTOMÁTICA (15 min)

### Paso 1.1: Ejecutar script de verificación

1. Abre: **http://umbral.local/dia-09-woocommerce-config.php**
2. Verás el estado actual de:
   - ✅ DISALLOW_FILE_EDIT
   - ✅ HTTPS
   - ✅ Rank Math
   - ✅ LiteSpeed Cache
   - ✅ robots.txt

---

## SEGUNDA PARTE: SEGURIDAD (60 min)

### Paso 2.1: Verificar DISALLOW_FILE_EDIT

Ya está configurado en tu wp-config.php (Día 4).

Para verificar:
1. Abre: `wp-config.php`
2. Busca: `define('DISALLOW_FILE_EDIT', true);`

### Paso 2.2: Wordfence Security

1. Ve a: **Wordfence → Dashboard**
2. URL: http://umbral.local/wp-admin/admin.php?page=Wordfence
3. Clic en **"Scan"** o **"Run Scan"**
4. Espera a que complete
5. Revisa alertas críticas

### Paso 2.3: Activar 2FA (Recomendado)

1. Ve a: **Wordfence → Login Security**
2. URL: http://umbral.local/wp-admin/admin.php?page=WFLS
3. Activa 2FA para tu usuario

### Paso 2.4: Ocultar versión de WordPress

El script del Día 6 ya añadió el código. Verifica en:
1. Ve a: **Apariencia → Editor de archivos**
2. Abre: `functions.php`
3. Busca: `remove_action('wp_head', 'wp_generator');`

---

## TERCERA PARTE: PERFORMANCE (90 min)

### Paso 3.1: Medir PageSpeed actual

1. Abre: **https://pagespeed.web.dev/**
2. Ingresa tu URL: `http://umbral.local`
3. Anota la puntuación (móvil y escritorio)

### Paso 3.2: LiteSpeed Cache

LiteSpeed Cache debería estar activo en Local.

1. Ve a: **LiteSpeed Cache → Cache**
2. URL: http://umbral.local/wp-admin/admin.php?page=litespeed-cache
3. Verifica que esté **Enabled**

### Paso 3.3: Configurar LiteSpeed Cache

En **LiteSpeed Cache → Settings**:

| Opción | Valor |
|--------|-------|
| Enable Cache | ✅ ON |
| Cache Mobile | ✅ ON |
| CSS Minify | ✅ ON |
| JS Minify | ✅ ON |
| Lazy Load Images | ✅ ON |

### Paso 3.4: Optimizar imágenes

1. Instala **ShortPixel Image Optimizer** o **Smush**
2. Ve a: **Media → ShortPixel**
3. Clic en **Bulk Optimize**
4. Selecciona todas las imágenes
5. Clic en **Optimize Now**

### Paso 3.5: Medir de nuevo

1. Vuelve a **https://pagespeed.web.dev/**
2. Compara con la puntuación anterior
3. Ideal: **>70 en móvil**

---

## CUARTA PARTE: SEO (60 min)

### Paso 4.1: Verificar Rank Math

1. Ve a: **Rank Math → General**
2. URL: http://umbral.local/wp-admin/admin.php?page=rank-math
3. Completa el wizard de configuración

### Paso 4.2: Configurar Homepage SEO

1. Edita la página **Inicio**
2. En Rank Math (abajo del editor):
   - Título SEO: `Entre lo que eres y lo que vistes | Umbral`
   - Meta description: `Tienda de ropa para hombres y mujeres. Calidad, estilo y moda contemporánea. Envío a todo Argentina.`
3. Clic en **Guardar**

### Paso 4.3: Verificar estructura de encabezados

En Elementor, cada página debe tener:
- **UN H1** por página
- H2 para secciones principales
- H3 para subsecciones

### Paso 4.4: Alt text en imágenes

1. En Elementor, selecciona cada imagen
2. En **Imagen → Configuración de imagen**
3. Añade texto alternativo descriptivo
4. Ejemplo: "Hombre usando camisa oxford gris"

### Paso 4.5: Generar y verificar sitemap

1. Ve a: **Rank Math → Sitemap Settings**
2. Asegúrate que esté **Enable**
3. Verifica sitemap: `http://umbral.local/sitemap.xml`

### Paso 4.6: Enviar sitemap a Google

1. Ve a: **https://search.google.com/search-console**
2. Inicia sesión con tu cuenta de Google
3. Añade tu propiedad (URL)
4. Ve a **Sitemaps**
5. Ingresa: `sitemap.xml`
6. Clic en **Enviar**

---

## QUINTA PARTE: ROBOTS.TXT

El script ya creó el archivo. Verifica que existe:
1. Abre: `http://umbral.local/robots.txt`
2. Deberías ver el contenido

---

## CHECKLIST FINAL

Marca ✅ cuando completes:

### Seguridad:
- [ ] **DISALLOW_FILE_EDIT** está activado
- [ ] **Wordfence scan** sin alertas críticas
- [ ] **2FA** activado en admin (recomendado)
- [ ] **Versión de WordPress** oculta

### Performance:
- [ ] **PageSpeed móvil** > 70
- [ ] **LiteSpeed Cache** configurado
- [ ] **Imágenes** optimizadas
- [ ] **Lazy load** activado

### SEO:
- [ ] **Rank Math** instalado y configurado
- [ ] **Título y meta description** en homepage
- [ ] **Estructura H1/H2/H3** correcta
- [ ] **Alt text** en todas las imágenes
- [ ] **Sitemap** verificado
- [ ] **Sitemap enviado** a Google Search Console

---

## 📁 Archivos del Día 9

| Archivo | Descripción |
|---------|-------------|
| **[`dia-09-woocommerce-config.php`](dia-09-woocommerce-config.php)** | Script de verificación automática |

---

## 🔗 Enlaces Rápidos

| Recurso | URL |
|---------|-----|
| **Script verificación** | http://umbral.local/dia-09-woocommerce-config.php |
| **Wordfence** | http://umbral.local/wp-admin/admin.php?page=Wordfence |
| **Rank Math** | http://umbral.local/wp-admin/admin.php?page=rank-math |
| **LiteSpeed Cache** | http://umbral.local/wp-admin/admin.php?page=litespeed-cache |
| **PageSpeed** | https://pagespeed.web.dev/ |
| **Search Console** | https://search.google.com/search-console |
| **Sitemap** | http://umbral.local/sitemap.xml |

---

## ⏱️ TIEMPO ESTIMADO

| Parte | Tiempo |
|-------|--------|
| Verificación automática | 15 min |
| Seguridad (Wordfence, 2FA) | 60 min |
| Performance (LiteSpeed, imágenes) | 90 min |
| SEO (Rank Math, sitemap) | 60 min |
| **TOTAL** | **~3.5 horas** |

---

## 🎉 ¡Completado!

Si terminaste todos los pasos, tu sitio Umbral ahora:
- ✅ Tiene seguridad reforzada (Wordfence, 2FA)
- ✅ Carga rápido (LiteSpeed Cache, imágenes optimizadas)
- ✅ Está optimizado para SEO (Rank Math, sitemap)
- ✅ Visible en Google Search Console

---

*¿Terminaste el Día 9? Comparte los resultados para continuar.*