# Día 7 - Manual Paso a Paso: WooCommerce

## Tienda de Ropa para Hombres y Mujeres

---

## PRIMERA PARTE: EJECUTAR CONFIGURACIÓN AUTOMÁTICA (10 min)

### Paso 1.1: Ejecutar script de configuración

1. Abre tu navegador
2. Ve a: **http://umbral.local/dia-07-woocommerce-config.php**
3. Verás una página con tablas verdes de "✅ Completado"
4. Eso significa que las categorías, atributos e impuestos están configurados

---

## SEGUNDA PARTE: CREAR PRODUCTO PANTALÓN SASTRE (15 min)

Ya tienes el script creado. Solo necesitas ejecutarlo.

### Paso 2.1: Ejecutar script del producto

1. Abre: **http://umbral.local/agregar-pantalon-sastre.php**
2. Verás que crea el producto automáticamente
3. Al final aparecerán enlaces para editar el producto

---

## TERCERA PARTE: CREAR PRODUCTOS SIMPLES (60 min)

Necesitas crear al menos 5 productos simples. Sigue estos pasos para cada uno:

### Paso 3.1: Crear nuevo producto

1. En WordPress, ve a **Productos → Añadir nuevo**
2. URL: http://umbral.local/wp-admin/post-new.php?post_type=product

### Paso 3.2: Completar datos del producto

Para cada producto, completa:

```
NOMBRE: Camisa Oxford Clásica
DESCRIPCIÓN CORTA: Camisa de algodón premium con corte clásico, ideal para ocasiones formales y casuales.
PRECIO REGULAR: 8500
```

### Paso 3.3: Configurar producto simple

1. En "Datos del producto", selecciona **Producto simple** (no variable)
2. Ve a **Inventario**:
   - SKU: CAM-OXFORD-001
   - Gestión de stock: Activada
   - Cantidad: 10

### Paso 3.4: Asignar categoría

1. En **Categorías** (a la derecha)
2. Busca y marca **Hombre**
3. O crea nueva categoría si no existe

### Paso 3.5: Añadir imagen

1. Clic en **Establecer imagen de producto** (lado derecho)
2. Sube una foto o usa una de placeholder
3. Clic en **Establecer imagen de producto**

### Paso 3.6: Publicar

1. Clic en el botón **Publicar** (lado derecho, arriba)
2. Verás "Producto publicado" en verde

### Productos a crear:

| # | Nombre | Categoría | Precio | SKU |
|---|--------|-----------|--------|-----|
| 1 | Camisa Oxford Clásica | Hombre | $8.500 | CAM-OXFORD-001 |
| 2 | Remera Básica Premium | Hombre | $4.500 | REM-BASICA-001 |
| 3 | Jeans Slim Fit | Hombre | $12.000 | JNS-SLIM-001 |
| 4 | Vestido Midi Elegante | Mujer | $15.000 | VST-MIDI-001 |
| 5 | Cinturón de Cuero | Accesorios | $3.500 | CIN-CUERO-001 |

---

## CUARTA PARTE: CREAR PRODUCTO VARIABLE (60 min)

Vamos a crear una "Remera Básica" con variaciones de TALLA y COLOR.

### Paso 4.1: Crear producto variable

1. **Productos → Añadir nuevo**
2. Nombre: **Remera Básica Premium**
3. Precio: **4500**

### Paso 4.2: Seleccionar producto variable

1. En "Datos del producto" (centro)
2. Busca el dropdown que dice **Producto simple**
3. Cámbialo a **Producto variable**

### Paso 4.3: Añadir atributos

1. Ve a la pestaña **Atributos**
2. Clic en "Añadir atributo"

#### Atributo 1: Talla
```
Nombre: Talla
Valor (separado por |): XS | S | M | L | XL
Marcar: Usado para variaciones
```
Clic en **Añadir**

#### Atributo 2: Color
```
Nombre: Color  
Valor (separado por |): Negro | Blanco | Gris | Azul
Marcar: Usado para variaciones
```
Clic en **Añadir**

### Paso 4.4: Generar variaciones

1. Ve a la pestaña **Variaciones**
2. Dropdown: selecciona **Crear variaciones para todos los atributos**
3. Clic en **Aplicar**
4. Verás que se crean 20 variaciones (5 tallas × 4 colores)

### Paso 4.5: Configurar variaciones

Para cada variación (puede tomar tiempo):

1. Clic en el triángulo ▶ junto a cada variación para expandirla
2. Configura:
   - **Precio**: $4500 (o deja en blanco para heredar)
   - **Stock**: 10
   - **SKU**: REM-GBLACK-M (ejemplo)

### Paso 4.6: Publicar

1. Clic en **Publicar**

---

## QUINTA PARTE: CONFIGURAR CATEGORÍAS CON IMÁGENES (30 min)

### Paso 5.1: Ir a categorías

1. Ve a **Productos → Categorías**
2. URL directa: http://umbral.local/wp-admin/edit-tags.php?taxonomy=product_cat&post_type=product

### Paso 5.2: Añadir imagen a categoría

Para cada categoría (Hombre, Mujer, Accesorios):

1. Pasa el cursor sobre el nombre de la categoría
2. Clic en **Editar**
3. Busca **Imagen de categoría** (abajo)
4. Clic en **Añadir imagen de categoría**
5. Sube una imagen representativa
6. Clic en **Actualizar**

---

## SEXTA PARTE: VERIFICAR IMPUESTOS (15 min)

### Paso 6.1: Ir a ajustes de impuestos

1. Ve a **WooCommerce → Ajustes → Impuestos**
2. URL: http://umbral.local/wp-admin/admin.php?page=wc-settings&tab=tax

### Paso 6.2: Verificar configuración

Confirma que estén marcadas:
- ✅ "Activar impuestos y cálculos de precios"

### Paso 6.3: Verificar tasa de IVA

1. Ve a **WooCommerce → Ajustes → Impuestos → Tasas estándar**
2. Deberías ver una fila con:
   - País: AR
   - Tasa: 21%
   - IVA

---

## SÉPTIMA PARTE: VERIFICACIÓN FINAL (10 min)

### Paso 7.1: Ver productos

1. Ve a **Productos → Todos los productos**
2. URL: http://umbral.local/wp-admin/edit.php?post_type=product
3. Deberías ver:
   - Pantalón Sastre (variable)
   - 5 productos simples
   - Remera Básica (variable)

### Paso 7.2: Ver tienda

1. Ve a la página de tienda
2. URL: http://umbral.local/tienda/
3. Verifica que se muestren los productos

---

## CHECKLIST FINAL

Marca ✅ cuando completes cada uno:

- [ ] **Paso 1**: Script dia-07-woocommerce-config.php ejecutado
- [ ] **Paso 2**: Producto Pantalón Sastre creado
- [ ] **Paso 3**: 5 productos simples publicados
- [ ] **Paso 4**: Producto Remera Básica con variaciones
- [ ] **Paso 5**: Categorías tienen imágenes
- [ ] **Paso 6**: IVA 21% configurado
- [ ] **Paso 7**: Productos visibles en la tienda

---

## 🔗 ENLACES RÁPIDOS

| Tarea | Enlace |
|-------|--------|
| Configuración automática | http://umbral.local/dia-07-woocommerce-config.php |
| Producto Pantalón | http://umbral.local/agregar-pantalon-sastre.php |
| Añadir producto | http://umbral.local/wp-admin/post-new.php?post_type=product |
| Todos los productos | http://umbral.local/wp-admin/edit.php?post_type=product |
| Categorías | http://umbral.local/wp-admin/edit-tags.php?taxonomy=product_cat&post_type=product |
| Ajustes WooCommerce | http://umbral.local/wp-admin/admin.php?page=wc-settings |
| Tu tienda | http://umbral.local/tienda/ |

---

## ⏱️ TIEMPO ESTIMADO

| Parte | Tiempo |
|-------|--------|
| Configuración automática | 10 min |
| Producto Pantalón | 15 min |
| 5 productos simples | 60 min |
| Producto variable | 60 min |
| Categorías con imágenes | 30 min |
| Verificar impuestos | 15 min |
| Verificación final | 10 min |
| **TOTAL** | **~3 horas** |

---

*¿Terminaste todos los pasos? Comparte los resultados para continuar.*