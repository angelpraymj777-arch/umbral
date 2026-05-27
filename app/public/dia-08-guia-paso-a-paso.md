# Día 8 - Umbral: Pagos y Checkout

## Tienda de Ropa para Hombres y Mujeres

---

## 🎯 Objetivo del Día
Dejar la tienda operativa de extremo a extremo: pagos, envíos, emails y checkout personalizado.

---

## PRIMERA PARTE: CONFIGURACIÓN AUTOMÁTICA (10 min)

### Paso 1.1: Ejecutar script de configuración

1. Abre: **http://umbral.local/dia-08-woocommerce-config.php**
2. Verás que configura automáticamente:
   - ✅ Transferencia bancaria activada
   - ✅ Pago contra entrega activado
   - ✅ 3 zonas de envío (Buenos Aires, Resto AR, Internacional)
   - ✅ Cupón BIENVENIDA10 (10% descuento)

---

## SEGUNDA PARTE: MÉTODOS DE PAGO (60 min)

### Paso 2.1: Configurar Transferencia Bancaria

1. Ve a: **WooCommerce → Ajustes → Pagos**
2. URL: http://umbral.local/wp-admin/admin.php?page=wc-settings&tab=checkout
3. Edita **Transferencia Bancaria Directa**
4. Actualiza con TUS datos reales:
```
Banco: [TU BANCO]
CBU: [TU CBU]
Alias: UMBRAL.ROPA
Titular: [TU NOMBRE O RAZÓN SOCIAL]
```

### Paso 2.2: Instalar MercadoPago (RECOMENDADO para Argentina)

1. Ve a: **Plugins → Añadir nuevo**
2. Busca: **MercadoPago for WooCommerce**
3. Instala y activa

### Paso 2.3: Configurar MercadoPago

1. Ve a: **WooCommerce → Ajustes → Pagos**
2. Verás "MercadoPago" en la lista
3. Clic en **Gestionar**
4. Completa con tus credenciales:
   - **Client ID** (de tu cuenta de MercadoPago)
   - **Client Secret** (de tu cuenta de MercadoPago)

### Paso 2.4: Obtener credenciales de MercadoPago

1. Ve a: https://www.mercadopago.com.ar/developers
2. Inicia sesión
3. Ve a **Credenciales de prueba**
4. Copia:
   - **Public Key**
   - **Access Token**

### Paso 2.5: Probar pagos en sandbox

1. Asegúrate de que el modo sea **Prueba/Sandbox**
2. Usa tarjetas de prueba de MercadoPago:
   - Número: 4074 0957 8514 8452
   - CVV: 123
   - Vencimiento: cualquier fecha futura

---

## TERCERA PARTE: ZONAS DE ENVÍO (30 min)

El script ya creó las zonas. Verifica y ajusta:

### Paso 3.1: Ver zonas de envío

1. Ve a: **WooCommerce → Ajustes → Envíos**
2. URL: http://umbral.local/wp-admin/admin.php?page=wc-settings&tab=shipping

### Paso 3.2: Zonas creadas automáticamente

| Zona | Cobertura | Costo |
|------|-----------|-------|
| Buenos Aires | Provincia de Buenos Aires | $500 |
| Resto de Argentina | Todo Argentina | $1.000 |
| Internacional | Mundial | $5.000 |

### Paso 3.3: Añadir envío gratis (opcional)

1. Crea una nueva zona o edita una existente
2. Añade método: **Envío gratis**
3. Requiere: "Pedido mínimo amount" → $15.000

---

## CUARTA PARTE: EMAILS TRANSACCIONALES (30 min)

### Paso 4.1: Personalizar logo de emails

1. Ve a: **WooCommerce → Ajustes → Emails**
2. URL: http://umbral.local/wp-admin/admin.php?page=wc-settings&tab=email
3. Busca "Encabezado de email"
4. Sube el logo de Umbral

### Paso 4.2: Configurar plantillas

Para cada email, clic en **Personalizar**:
- Pedido nuevo
- Procesando
- Completado
- Nota del cliente
- Restablecimiento de contraseña

### Paso 4.3: Enviar email de prueba

1. Ve a **WooCommerce → Ajustes → Emails → Notificaciones**
2. Clic en **Enviar email de prueba**
3. Recibe el email y verifica que se vea bien

---

## QUINTA PARTE: PERSONALIZAR CHECKOUT (60 min)

### Paso 5.1: Instalar Checkout Field Editor

1. Ve a: **Plugins → Añadir nuevo**
2. Busca: **WooCommerce Checkout Field Editor**
3. Instala y activa

### Paso 5.2: Configurar campos

1. Ve a: **WooCommerce → Ajustes → Checkout Fields**
2. Oculta campos innecesarios:
   - ❌ Segunda dirección
   - ❌ Nombre de empresa
   - ❌ Dirección 2

### Paso 5.3: Añadir campo CI/RUC (opcional para Argentina)

1. En sección de **Billing**:
2. Clic en **Añadir campo**
3. Configura:
   - Tipo: Text
   - Nombre: Número de documento
   - Placeholder: 12.345.678

---

## SEXTA PARTE: CUPONES (15 min)

El script ya creó el cupón. Verifica:

### Paso 6.1: Ver cupón creado

1. Ve a: **WooCommerce → Ajustes → Cupones**
2. URL: http://umbral.local/wp-admin/admin.php?page=wc-settings&tab=coupons
3. Verifica que existe **BIENVENIDA10**

### Paso 6.2: Editar cupón (si necesitas cambios)

1. Clic en el cupón para editar
2. Ajusta:
   - Descuento: 10%
   - Compra mínima: $5.000
   - Límite de uso: 1

---

## SÉPTIMA PARTE: PRUEBA COMPLETA (30 min)

### Paso 7.1: Realizar pedido de prueba

1. Abre tu tienda: **http://umbral.local/tienda/**
2. Añade un producto al carrito
3. Ve al carrito
4. Clic en **Finalizar compra**
5. Rellena datos de facturación ficticios
6. Selecciona método de pago:
   - **Tarjeta de prueba** (si configuraste MercadoPago)
   - **Transferencia bancaria**
   - **Pago contra entrega**

### Paso 7.2: Verificar email

1. Revisa el inbox del email que pusiste
2. Deberías recibir email de "Pedido recibido"

### Paso 7.3: Ver pedido en admin

1. Ve a: **WooCommerce → Pedidos**
2. URL: http://umbral.local/wp-admin/edit.php?post_type=shop_order
3. Verifica que aparece el pedido con estado "Procesando"

---

## CHECKLIST FINAL

Marca ✅ cuando completes:

- [ ] **Script de configuración ejecutado**
- [ ] **Transferencia bancaria con mis datos**
- [ ] **MercadoPago instalado y configurado** (o Stripe)
- [ ] **Zonas de envío verificadas**
- [ ] **Emails personalizados con logo**
- [ ] **Checkout optimizado** (campos innecesarios ocultos)
- [ ] **Cupón BIENVENIDA10 creado**
- [ ] **Pedido de prueba completado end-to-end**
- [ ] **Email de confirmación recibido**

---

## 📁 Archivos del Día 8

| Archivo | Descripción |
|---------|-------------|
| **[`dia-08-woocommerce-config.php`](dia-08-woocommerce-config.php)** | Script de configuración automática |

---

## 🔗 Enlaces Rápidos

| Recurso | URL |
|---------|-----|
| **Script configuración** | http://umbral.local/dia-08-woocommerce-config.php |
| **Pagos** | http://umbral.local/wp-admin/admin.php?page=wc-settings&tab=checkout |
| **Envíos** | http://umbral.local/wp-admin/admin.php?page=wc-settings&tab=shipping |
| **Emails** | http://umbral.local/wp-admin/admin.php?page=wc-settings&tab=email |
| **Cupones** | http://umbral.local/wp-admin/admin.php?page=wc-settings&tab=coupons |
| **Tu tienda** | http://umbral.local/tienda/ |
| **Carrito** | http://umbral.local/carrito/ |

---

## ⏱️ TIEMPO ESTIMADO

| Parte | Tiempo |
|-------|--------|
| Configuración automática | 10 min |
| MercadoPago (credenciales + config) | 60 min |
| Zonas de envío | 30 min |
| Emails | 30 min |
| Checkout | 60 min |
| Cupones | 15 min |
| Prueba completa | 30 min |
| **TOTAL** | **~4 horas** |

---

## 🎉 ¡Completado!

Si terminaste todos los pasos, tu tienda Umbral ahora:
- ✅ Acepta pagos (transferencia, contra entrega, MercadoPago)
- ✅ Calcula envíos por zona
- ✅ Envía emails automáticos
- ✅ Tiene checkout optimizado
- ✅ Tiene cupón de bienvenida

---

*¿Terminaste el Día 8? Comparte los resultados para continuar.*