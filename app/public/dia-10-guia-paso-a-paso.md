# Día 10 - Umbral: Despliegue Final

## Tienda de Ropa para Hombres y Mujeres

---

## 🎯 Objetivo del Día
Migrar el sitio al hosting de producción, dejarlo verificado y en marcha.

---

## ⚠️ IMPORTANTE: ANTES DE EMPEZAR

Este día requiere trabajo en tu **hosting de producción** (cPanel, FTP, etc.).
Necesitas:
- Acceso a tu hosting (cPanel o similar)
- Dominio apuntando al servidor
- Acceso SSH/FTP si es necesario

---

## PRIMERA PARTE: SCRIPT DE CHECKLIST (5 min)

### Paso 1.1: Ver checklist de despliegue

1. Abre: **http://umbral.local/dia-10-woocommerce-config.php**
2. Verás toda la información de tu sitio
3. Checklist con todas las tareas a completar

---

## SEGUNDA PARTE: BACKUP COMPLETO (45 min)

### Paso 2.1: Hacer backup con UpdraftPlus

1. Ve a: **Herramientas → UpdraftPlus Backups**
2. URL: http://umbral.local/wp-admin/admin.php?page=updraftplus
3. Clic en **Backup Now**
4. Selecciona:
   - ✅ Archivos (todo)
   - ✅ Base de datos
5. Clic en **Backup Now** nuevamente
6. Espera a que complete

### Paso 2.2: Descargar backup

1. En UpdraftPlus, ve a **Backup / Restore**
2. Verás el backup creado
3. Clic en **Download Backup** para cada parte
4. Guarda los archivos en tu computadora

### Paso 2.3: Backup adicional a la nube

1. En UpdraftPlus → **Settings**
2. Configura destino: **Google Drive** o **Dropbox**
3. Autentica tu cuenta
4. Sube el backup a la nube

---

## TERCERA PARTE: PREPARAR HOSTING (45 min)

### Paso 3.1: Crear base de datos

En tu cPanel:

1. Ve a **MySQL Databases** o **Bases de datos**
2. Crea una nueva base de datos:
   - Nombre: `umbral_produccion`
   - Usuario: `umbral_user`
   - Contraseña: [genera una segura]
3. Asigna el usuario a la base de datos con TODOS los privilegios

### Paso 3.2: Verificar PHP

1. En cPanel, busca **PHP Version** o **MultiPHP Manager**
2. Verifica que sea **PHP 8.0 o superior**
3. Configura php.ini si es necesario:
   - memory_limit = 256M
   - upload_max_filesize = 64M
   - post_max_size = 64M

### Paso 3.3: Crear dominio/subdomain

1. En cPanel → **Domains** o **Dominios**
2. Si es subdomain: crea `umbral.tudominio.com`
3. Si es dominio principal: configura el document root

---

## CUARTA PARTE: MIGRACIÓN (60 min)

### Opción A: All-in-One WP Migration (MÁS FÁCIL)

**En desarrollo:**

1. Instala plugin **All-in-One WP Migration**
2. Ve a: All-in-One WP Migration → Backup
3. Crea backup completo
4. Descarga archivo `.wpress`

**En producción:**

1. Instala WordPress limpio en el hosting
2. Instala **All-in-One WP Migration**
3. Ve a: All-in-One WP Migration → Import
4. Sube el archivo `.wpress`
5. Espera a que importe todo

### Opción B: Manual (FTP + phpMyAdmin)

**Exportar base de datos:**

1. En Local, abre **phpMyAdmin**
2. Selecciona la base de datos `local`
3. Exporta como SQL

**Subir archivos:**

1. Conéctate al hosting por FTP
2. Sube TODOS los archivos de WordPress
3. EXCEPTO `wp-config.php` (lo crearás nuevo)

**Crear wp-config.php:**

```php
<?php
define('DB_NAME', 'umbral_produccion');
define('DB_USER', 'umbral_user');
define('DB_PASSWORD', '[tu_password]');
define('DB_HOST', 'localhost');

define('AUTH_KEY', '[generar en https://api.wordpress.org/secret-key/1.1/salt/]');
define('SECURE_AUTH_KEY', '[generar en https://api.wordpress.org/secret-key/1.1/salt/]');
define('LOGGED_IN_KEY', '[generar en https://api.wordpress.org/secret-key/1.1/salt/]');
define('NONCE_KEY', '[generar en https://api.wordpress.org/secret-key/1.1/salt/]');
// ... las demás keys ...

$table_prefix = 'wp_';

define('WP_DEBUG', false);
define('DISALLOW_FILE_EDIT', true);

/* That's all, stop editing! Happy publishing. */
```

### Paso 4.1: Better Search Replace

Después de migrar, cambia las URLs:

1. Instala **Better Search Replace** en producción
2. Ve a: Herramientas → Better Search Replace
3. Configura:
   - Search: `http://umbral.local` (URL desarrollo)
   - Replace: `https://tudominio.com` (URL producción)
4. Selecciona TODAS las tablas
5. Desmarca "Dry run"
6. Clic en **Run Search Replace**

### Paso 4.2: Regenerar permalinks

1. Ve a: **Ajustes → Permalinks**
2. Clic en **Guardar cambios** (sin cambiar nada)

---

## QUINTA PARTE: DNS Y HTTPS (30 min)

### Paso 5.1: Apuntar dominio

1. En tu proveedor de dominio (GoDaddy, Namecheap, etc.)
2. Ve a DNS o Zone Editor
3. Crea/modifica registro **A**:
   - Nombre: @ o umbral
   - Valor: [IP del servidor de producción]
4. Espera propagación (hasta 48 horas, usualmente 1-2 horas)

### Paso 5.2: Instalar SSL

En cPanel:

1. Ve a **SSL/TLS** o **Let's Encrypt**
2. Selecciona tu dominio
3. Clic en **Emitir** o **Install**
4. Espera a que se active

### Paso 5.3: Forzar HTTPS

Añade a `.htaccess`:

```apache
# Force HTTPS
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

Añade a `wp-config.php`:

```php
define('FORCE_SSL_ADMIN', true);
define('FORCE_SSL_LOGIN', true);
```

---

## SEXTA PARTE: QA FINAL (45 min)

### Paso 6.1: Verificar navegación

Abre tu dominio de producción y verifica:

- [ ] Home carga correctamente
- [ ] Menú funciona
- [ ] Tienda muestra productos
- [ ] Producto individual abre
- [ ] Carrito funciona
- [ ] Checkout funciona
- [ ] Página de gracias aparece

### Paso 6.2: Realizar pedido de prueba

1. Añade producto al carrito
2. Ve al checkout
3. Usa datos de PRUEBA (tarjeta sandbox de MercadoPago)
4. Completa el pedido
5. Verifica:
   - [ ] Pedido aparece en WooCommerce
   - [ ] Email de confirmación llegó

### Paso 6.3: Verificar móvil

1. Abre Chrome DevTools (F12)
2. Clic en icono de móvil
3. Navega por todas las páginas

### Paso 6.4: PageSpeed

1. Ve a: https://pagespeed.web.dev/
2. Analiza tu dominio de producción
3. Meta: > 70 en móvil

### Paso 6.5: Wordfence

1. Ve a: Wordfence → Dashboard
2. Ejecuta scan completo
3. Revisa alertas

---

## SÉPTIMA PARTE: CONFIGURACIÓN POST-DESPLIEGUE

### Cambiar URLs y credenciales:

| Servicio | Acción |
|----------|--------|
| WordPress | Verificar URLs en Ajustes → Generales |
| Google Analytics | Actualizar en Rank Math o MonsterInsights |
| Search Console | Enviar nuevo sitemap de producción |
| MercadoPago | Actualizar credenciales de producción |
| Email | Configurar SMTP si es necesario |

### Programar backups:

1. UpdraftPlus → Settings
2. Programa: Diario o Semanal
3. Destino: Google Drive o Dropbox

---

## OCTAVA PARTE: DOCUMENTACIÓN

### Crear documento de credenciales:

Guarda en un lugar seguro (NO en el servidor):

```
════════════════════════════════════════
UMBRAL - CREDENCIALES DE ACCESO
════════════════════════════════════════

HOSTING
- Panel: https://tudominio.com/cpanel
- Usuario: ___________
- Contraseña: ___________

BASE DE DATOS
- Host: localhost
- Base de datos: umbral_produccion
- Usuario: umbral_user
- Contraseña: ___________

WORDPRESS
- URL Admin: https://tudominio.com/wp-admin
- Usuario: ___________
- Contraseña: ___________

FTP
- Host: ftp.tudominio.com
- Usuario: ___________
- Contraseña: ___________

DOMINIO
- Proveedor: ___________
- Panel: ___________

SSL
- Proveedor: Let's Encrypt / Comodo
- Fecha expiración: ___________

MERCADOPAGO
- Client ID: ___________
- Client Secret: ___________

EMAIL SMTP
- Host: mail.tudominio.com
- Usuario: ___________
- Contraseña: ___________
- Puerto: 587

FECHA DE ENTREGA: ___________
════════════════════════════════════════
```

---

## 📁 Archivo del Día 10

| Archivo | Descripción |
|---------|-------------|
| **[`dia-10-woocommerce-config.php`](dia-10-woocommerce-config.php)** | Script con checklist de despliegue |

---

## 🔗 Enlaces del Hosting (configurar después)

| Servicio | URL |
|---------|-----|
| Tu sitio (producción) | _______________ |
| cPanel | _______________ |
| phpMyAdmin | _______________ |
| SSL | _______________ |

---

## ⏱️ TIEMPO ESTIMADO

| Parte | Tiempo |
|-------|--------|
| Script de verificación | 5 min |
| Backup completo | 45 min |
| Preparar hosting | 45 min |
| Migración | 60 min |
| DNS y HTTPS | 30 min |
| QA Final | 45 min |
| Post-despliegue | 30 min |
| **TOTAL** | **~4.5 horas** |

---

## 🎉 ¡DESPLIEGUE COMPLETADO!

Si llegaste hasta aquí, ¡felicitaciones! Tu tienda Umbral está en producción.

**Recuerda:**
- Guardar el documento de credenciales en lugar seguro
- Programar backups automáticos
- Monitorear el sitio regularmente

---

*¿Preguntas sobre el despliegue? Consulta con tu instructor.*