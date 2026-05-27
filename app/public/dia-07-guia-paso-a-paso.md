# Día 7 - Umbral: WooCommerce - Catálogo

## Tienda de Ropa para Hombres y Mujeres

---

## 🎯 Objetivo del Día
Configurar WooCommerce completamente y construir el catálogo de productos con categorías, atributos y variaciones.

---

## 📋 Paso 1: Ejecutar Configuración Automática (10 min)

### 1.1 Ejecutar script de configuración

Abre en tu navegador:
```
http://umbral.local/dia-07-woocommerce-config.php
```

Este script configura automáticamente:
- ✅ Moneda: Peso Argentino (ARS)
- ✅ Categorías: Hombre, Mujer, Accesorios, Colección Verano, Ofertas
- ✅ Atributos: Color, Talla, Material
- ✅ Impuestos: IVA 21%
- ✅ Stock: Gestión activada, umbral bajo: 5 unidades

---

## 📦 Paso 2: Añadir el Producto "Pantalón Sastre" (15 min)

### 2.1 Ejecutar script del producto

Ya tienes el script creado. Ejecuta:
```
http://umbral.local/agregar-pantalon-sastre.php
```

Este crea:
- ✅ Producto variable "Pantalón Sastre Línea Umbra"
- ✅ Precio: $14.000 ARS
- ✅ Variaciones: 3 colores × 3 tallas = 9 variaciones
- ✅ Categoría: Hombre

---

## 🛍️ Paso 3: Añadir Más Productos (60 min)

### 3.1 Productos simples a crear

Crea al menos 5 productos simples:

| # | Nombre | Categoría | Precio |
|---|--------|-----------|--------|
| 1 | Camisa Oxford Clásica | Hombre | $8.500 |
| 2 | Remera Premium | Hombre/Mujer | $4.500 |
| 3 | Jeans Slim Fit | Hombre | $12.000 |
| 4 | Vestido Midi Elegante | Mujer | $15.000 |
| 5 | Cinturón de Cuero | Accesorios | $3.500 |

### 3.2 Cómo crear un producto simple

1. Ve a **Productos → Añadir nuevo**
2. Completa:
   - **Nombre del producto**
   - **Descripción corta** (aparecerá en el catálogo)
   - **Descripción larga** (detalles del producto)
   - **Precio regular**: $XX.XXX
   - **Precio de venta** (opcional)
3. En **Datos del producto**:
   - Selecciona **Producto simple**
   - Configura **Inventario**: SKU, stock
4. En **Categorías**: Selecciona la categoría
5. Añade **Imagen destacada**
6. **Publicar**

---

## 🎨 Paso 4: Crear Producto Variable (60 min)

### 4.1 Ejemplo: Remera con tallas y colores

1. **Productos → Añadir nuevo**
2. **Nombre**: "Remera Básica Premium"
3. **Precio**: $4.500
4. **Datos del producto**: Selecciona **Producto variable**

### 4.2 Configurar atributos

1. Ve a **Atributos**
2. Selecciona **Talla** y añade: XS, S, M, L, XL
3. Selecciona **Color** y añade: Negro, Blanco, Gris, Azul
4. Marca "Usado para variaciones"
5. Clic en **Guardar atributos**

### 4.3 Generar variaciones

1. Ve a la pestaña **Variaciones**
2. Selecciona "Crear variaciones para todos los atributos"
3. Clic en **Aplicar**
4. Se crearán 20 variaciones (5 tallas × 4 colores)

### 4.4 Configurar cada variación

Para cada variación:
- Precio (o dejar heredado)
- Stock
- SKU único
- Imagen (opcional)

---

## 🏷️ Paso 5: Gestionar Categorías (30 min)

### 5.1 Acceder a categorías

Ve a: **Productos → Categorías**
O usa el enlace: http://umbral.local/wp-admin/edit-tags.php?taxonomy=product_cat&post_type=product

### 5.2 Añadir imagen a categoría

1. Pasa el cursor sobre la categoría
2. Clic en **Editar**
3. En **Imagen de categoría**, clic en **Añadir imagen**
4. Sube una imagen representativa
5. **Actualizar**

### 5.3 Estructura recomendada

```
Hombre
├── Camisas
├── Pantalones
├── Remeras
└── Accesorios

Mujer
├── Vestidos
├── Tops
├── Pantalones
└── Accesorios

Accesorios
├── Cinturones
├── Bolsos
└── Bufandas

Ofertas
└── (productos con descuento)
```

---

## 💰 Paso 6: Configurar Impuestos (15 min)

### 6.1 Verificar configuración de impuestos

Ve a: **WooCommerce → Ajustes → Impuestos**

Verifica:
- ✅ "Activar impuestos y cálculos de precios"
- ✅ Moneda: Peso Argentino
- ✅ Posición del símbolo: izquierda

### 6.2 Tasas de impuesto

El script ya creó la tasa del 21% (IVA). Verifica en:
**WooCommerce → Ajustes → Impuestos → Tasas estándar**

---

## 📊 Paso 7: Checklist de Cierre

Marca cada uno al completar:

- [ ] **Script de configuración ejecutado** (dia-07-woocommerce-config.php)
- [ ] **Pantalón Sastre creado** (9 variaciones)
- [ ] **Al menos 5 productos simples publicados**
- [ ] **1 producto variable creado** (con variaciones)
- [ ] **Categorías con imágenes**
- [ ] **Impuestos configurados (IVA 21%)**
- [ ] **Stock configurado**

---

## 📁 Archivos del Día 7

| Archivo | Descripción |
|---------|-------------|
| **[`dia-07-woocommerce-config.php`](dia-07-woocommerce-config.php)** | Script de configuración automática |
| **[`agregar-pantalon-sastre.php`](agregar-pantalon-sastre.php)** | Producto Pantalón Sastre (ya creado) |

---

## 🔗 Enlaces Rápidos

| Recurso | URL |
|---------|-----|
| **WooCommerce** | http://umbral.local/wp-admin/admin.php?page=wc-admin |
| **Productos** | http://umbral.local/wp-admin/admin.php?page=wc-admin&path=/products |
| **Categorías** | http://umbral.local/wp-admin/edit-tags.php?taxonomy=product_cat&post_type=product |
| **Atributos** | http://umbral.local/wp-admin/edit.php?post_type=product&page=product_attributes |
| **Ajustes** | http://umbral.local/wp-admin/admin.php?page=wc-settings |

---

## 🎉 ¡Completado!

Si terminaste todos los pasos, tu tienda Umbral tiene:
- ✅ WooCommerce configurado para Argentina
- ✅ 5 categorías de productos
- ✅ 3 atributos reutilizables
- ✅ IVA del 21% configurado
- ✅ Gestión de stock activada
- ✅ Al menos 1 producto variable completo
- ✅ Catálogo de productos funcionando

---

*¿Terminaste el Día 7? Comparte los resultados para continuar con el Día 8.*