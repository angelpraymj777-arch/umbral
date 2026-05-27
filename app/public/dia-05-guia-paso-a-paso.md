# Día 5 - Umbral: Guía Paso a Paso

## Tienda de Ropa para Hombres y Mujeres

---

## 🎯 Objetivo del Día
Diseñar las páginas principales del sitio (Home, Nosotros, Tienda) usando Elementor para que el sitio se vea profesional y funcione correctamente.

---

## 📋 Paso 1: Ejecutar Configuración Automática (5 minutos)

### 1.1 Abrir el script de configuración
En tu navegador, ve a:
```
http://umbral.local/dia-05-ejecutar-config.php
```

### 1.2 Verificar resultados
- Verás una lista de configuraciones aplicadas
- Si hay errores (en rojo),停 y reporta el problema
- Cierra el navegador cuando termine

---

## ⚙️ Paso 2: Configurar Elementor (10 minutos)

### 2.1 Acceder a Ajustes de Elementor
1. En WordPress, ve a **Elementor → Ajustes**
2. O haz clic directamente: [Abrir Ajustes de Elementor](http://umbral.local/wp-admin/admin.php?page=elementor)

### 2.2 Configurar como indica la imagen:

| Ajuste | Valor |
|--------|-------|
| **Ancho del contenido** | `1200` |
| **Mobile Breakpoint** | `767` |
| **Tablet Breakpoint** | `1024` |

### 2.3 Configurar Fuentes Globales
1. Ve a **Elementor → Ajustes → Avanzado**
2. Busca "Fuentes Globales" o "Typography"
3. Configura:
   - **Título**: Playfair Display
   - **Cuerpo**: Inter
4. Guarda los cambios

---

## 🏠 Paso 3: Diseñar la Página Inicio (60-90 minutos)

### 3.1 Abrir Inicio en Elementor
1. Ve a **Páginas → Todas las páginas**
2. Busca "Inicio"
3. Clic en "Editar con Elementor"

### 3.2 Sección 1: Hero Section
1. Clic en el botón **"+"** (añadir sección)
2. 选择 **Sección de altura completa** (Full Width)
3. Altura: **100vh** (pantalla completa)
4. Fondo: **Imagen** (sube una foto de un modelo con ropa)
5. Dentro, añade un **widget de Heading**:
   - Título: `ENTRE LO QUE ERES Y LO QUE VISTES`
   - Subtítulo: `Descubre tu estilo en Umbral`
6. Añade un **widget de Button**:
   - Texto: `VER COLECCIÓN`
   - Enlace: selecciona la página "Tienda"
7. Centra todo el contenido

### 3.3 Sección 2: Categorías Principales
1. Añade nueva sección
2. Layout: **2 columnas** (desktop), **1 columna** (móvil)
3. Columna 1:
   - Imagen de categoría "Hombre"
   - Título: "HOMBRES"
   - Botón: "Ver colección"
4. Columna 2:
   - Imagen de categoría "Mujer"
   - Título: "MUJERES"
   - Botón: "Ver colección"

### 3.4 Sección 3: Productos Destacados
1. Añade nueva sección
2. Título: `PRODUCTOS DESTACADOS`
3. Añade un **widget de Shortcode**:
   ```
   [products limit="4" columns="4" orderby="popularity"]
   ```

### 3.5 Sección 4: Sobre Nosotros
1. Nueva sección
2. Layout: **50% imagen / 50% texto**
3. Imagen: Foto de la tienda o atelier
4. Texto:
   ```
   <h3>Nuestra Historia</h3>
   <p>Umbral nació de la pasión por la moda y el deseo de ofrecer ropa de calidad que inspire confianza...</p>
   ```

### 3.6 Sección 5: Testimonios
1. Nueva sección (fondo gris claro)
2. Título: `LO QUE DICEN NUESTROS CLIENTES`
3. Usa **Essential Addons → Testimonial Carousel** o crea 3 boxes con:
   - Avatar circular
   - Nombre y texto del testimonio
   - 5 estrellas ⭐⭐⭐⭐⭐

### 3.7 Sección 6: Footer CTA
1. Nueva sección
2. Fondo: **Color oscuro (#1a1a1a)**
3. Centra el contenido
4. Título: `¿LISTO PARA DAR EL PASO?`
5. Botón: `EXPLORAR TIENDA` → enlaza a Tienda

### 3.8 Verificar en Móvil
1. Clic en el icono de **responsivo** (esquina inferior izquierda)
2. Selecciona **móvil** (celular)
3. Verifica que todo se vea bien
4. Si algo se rompe, ajusta las columnas a 1

### 3.9 Guardar y Publicar
1. Clic en **Actualizar** o **Publicar**
2. Abre la URL en otra pestaña para verificar

---

## 👥 Paso 4: Diseñar la Página Nosotros (30-45 minutos)

### 4.1 Abrir Nosotros en Elementor
1. Ve a **Páginas → Todas las páginas**
2. Busca "Nosotros"
3. Clic en "Editar con Elementor"

### 4.2 Sección 1: Hero
1. Imagen de fondo (equipo o tienda)
2. Título: `NUESTRA HISTORIA`

### 4.3 Sección 2: Historia
1. Texto ancho completo
2. Cuenta la historia de Umbral:
   ```
   <p>Umbral comenzó como un sueño compartido entre amigos apasionados por la moda...</p>
   ```

### 4.4 Sección 3: Misión y Visión
1. Layout: **2 columnas**
2. Columna 1 (Misión):
   ```
   <h3>🎯 Misión</h3>
   <p>Ofrecer prendas de calidad que permitan a cada persona expresar su identidad...</p>
   ```
3. Columna 2 (Visión):
   ```
   <h3>🔭 Visión</h3>
   <p>Ser la tienda de referencia en moda contemporánea en la región...</p>
   ```

### 4.5 Sección 4: Valores
1. Grid de 3 columnas
2. Cada columna con:
   - Icono (emoji o de Essential Addons)
   - Título del valor
   - Descripción breve
3. Valores ejemplo:
   - **Calidad**: Prendas cuidadosamente seleccionadas
   - **Sostenibilidad**: Materiales responsables
   - **Innovación**: Tendencias actuales

### 4.6 Sección 5: Galería
1. Usa **Essential Addons → Gallery** o grid de imágenes
2. 4-6 fotos del equipo o la tienda

### 4.7 Publicar
1. Guarda y publica
2. Verifica en el menú que el enlace funcione

---

## 🛒 Paso 5: Configurar la Página Tienda (15 minutos)

La página Tienda usa WooCommerce, no Elementor directamente.

### 5.1 Verificar que Tienda existe
1. Ve a **Páginas → Tienda**
2. Confirma que tenga la plantilla correcta

### 5.2 Ajustar opciones de WooCommerce
1. Ve a **WooCommerce → Ajustes → Productos**
2. Configura:
   - Imágenes de catálogo: 300x300
   - Imágenes de producto único: 600x600

### 5.3 Añadir productos destacados
1. Ve a **Productos → Añadir nuevo**
2. Crea 4-8 productos de ejemplo:
   - Nombre, descripción, precio
   - Categoría: "Hombre" o "Mujer"
   - Imagen del producto
   - Marcar como "Destacado"

### 5.4 Verificar shortcode en página
1. Edita la página Tienda (puede estar en Gutenberg)
2. Asegúrate de que tenga el shortcode:
   ```
   [products limit="8" columns="4"]
   ```

---

## 📋 Paso 6: Verificar Menú de Navegación (5 minutos)

### 6.1 Abrir administración de menús
1. Ve a **Apariencia → Menús**
2. O haz clic: [Administrar Menús](http://umbral.local/wp-admin/nav-menus.php)

### 6.2 Verificar que existan
Confirma que el menú incluya:
- ✅ Inicio
- ✅ Tienda
- ✅ Nosotros
- ✅ Blog
- ✅ Contacto

### 6.3 Asignar ubicación
1. En "Ubicación de menús", selecciona **Menú Principal**
2. Guarda

---

## 💾 Paso 7: Guardar Plantillas (10 minutos)

### 7.1 Guardar Home como plantilla
1. En Elementor (página Inicio), clic en el **icono de flecha** (arriba a la izquierda)
2. Clic en **"Guardar como plantilla"**
3. Nombre: `Umbral - Home`
4. Guarda

### 7.2 Guardar Nosotros como plantilla
1. Repite en página Nosotros
2. Nombre: `Umbral - Nosotros`

### 7.3 Exportar plantillas
1. Ve a **Elementor → Mis plantillas**
2. Selecciona cada plantilla
3. Clic en **Exportar**
4. Guarda los archivos `.json` en tu computadora

---

## 🚀 Paso 8: Verificación Final (5 minutos)

### 8.1 Probar el sitio
1. Abre tu sitio: [http://umbral.local](http://umbral.local)
2. Navega por todas las páginas
3. Verifica que los menús funcionen

### 8.2 Probar en móvil
1. Abre el sitio en tu teléfono o usa modo responsivo del navegador
2. Verifica que todo se vea bien

### 8.3 Comprobar enlaces
- [ ] Inicio → Tienda (botón CTA)
- [ ] Tienda → Producto (clic en producto)
- [ ] Menú → Todas las páginas accesibles

---

## ✅ Checklist de Cierre

Marca cada uno al completar:

- [ ] **Paso 1**: Script de configuración ejecutado
- [ ] **Paso 2**: Elementor configurado (1200px, fuentes, breakpoints)
- [ ] **Paso 3**: Home diseñada con al menos 5 secciones
- [ ] **Paso 4**: Página Nosotros diseñada
- [ ] **Paso 5**: Tienda configurada con WooCommerce
- [ ] **Paso 6**: Menú de navegación funcionando
- [ ] **Paso 7**: Plantillas exportadas como .json
- [ ] **Paso 8**: Sitio funciona correctamente en móvil
- [ ] **URL del sitio compartida** ← ¡Este es tu entregable!

---

## 📞 Enlaces Rápidos

| Recurso | URL |
|---------|-----|
| **Tu Sitio** | http://umbral.local |
| **Escritorio** | http://umbral.local/wp-admin |
| **Configuración Día 5** | http://umbral.local/dia-05-ejecutar-config.php |
| **Guía Día 5** | http://umbral.local/dia-05-elementor.php |
| **Elementor** | http://umbral.local/wp-admin/admin.php?page=elementor |
| **WooCommerce** | http://umbral.local/wp-admin/admin.php?page=wc-admin |
| **Menús** | http://umbral.local/wp-admin/nav-menus.php |

---

## 🎉 ¡Felicitaciones!

Si completaste todos los pasos, tu sitio de tienda de ropa **Umbral** ya está funcionando con un diseño profesional.

**Comparte la URL: http://umbral.local**

---

*¿Terminaste el Día 5? Comparte los archivos .json exportados y la URL del sitio para continuar con el Día 6.*