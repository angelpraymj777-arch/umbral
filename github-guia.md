# GitHub - Guía de Configuración para Umbral

## Paso 1: Crear repositorio en GitHub.com

1. Abre **https://github.com** en tu navegador
2. Inicia sesión con tu cuenta (angel.praymj777@gmail.com)
3. Clic en **"New repository"** (botón verde)
4. Configuración:
   - **Repository name:** `umbral`
   - **Description:** "Tienda de ropa para hombres y mujeres"
   - **Visibility:** Public o Private (elige)
   - **NO** marques "Add a README file" (ya tienes archivos)
5. Clic en **"Create repository"**

## Paso 2: Conectar Git local con GitHub

Después de crear el repositorio en GitHub, GitHub te mostrará la URL. Se verá algo como:
```
https://github.com/TU-USERNAME/umbral.git
```

Ahora ejecuta estos comandos en la terminal (dentro de `C:\Users\angel\Local Sites\umbral`):

```bash
git remote add origin https://github.com/TU-USERNAME/umbral.git
git branch -M master
git push -u origin master
```

## Paso 3: Verificar conexión

```bash
git remote -v
```

Debería mostrar:
```
origin  https://github.com/TU-USERNAME/umbral.git (fetch)
origin  https://github.com/TU-USERNAME/umbral.git (push)
```

---

## Comandos Git útiles

### Ver estado
```bash
git status
```

### Agregar archivos
```bash
git add .
# o para archivos específicos:
git add archivo.php
```

### Hacer commit
```bash
git commit -m "Mensaje del commit"
```

### Subir a GitHub
```bash
git push origin master
```

### Ver commits
```bash
git log
```

---

## Archivo .gitignore creado

El proyecto ya tiene un `.gitignore` que excluye:
- `wp-config.php` (contiene credenciales)
- `wp-content/uploads/` (archivos grandes)
- `wp-content/cache/` (archivos temporales)
- Scripts de configuración (`dia-*.php`, `agregar-*.php`)
- Archivos del sistema (`node_modules/`, `.vscode/`)
- Directorios de Local by Flywheel (`.blueprint/`, `.site/`)

---

## ⚠️ IMPORTANTE: NO subir a GitHub

**NUNCA subas a GitHub:**
1. `wp-config.php` (contiene claves de base de datos)
2. Archivos con contraseñas o tokens
3. Uploads de productos (imágenes)
4. Directorios de caché

El `.gitignore` ya está configurado para evitar esto, pero ten cuidado.

---

## Resumen

1. ✅ Git configurado con tu email: angel.praymj777@gmail.com
2. ✅ Repositorio local inicializado
3. ⏳ Crear repositorio en github.com (tú lo haces manualmente)
4. ⏳ Conectar con `git remote add origin`
5. ⏳ Primer push con `git push -u origin master`