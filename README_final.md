# Sistema de Registro de Usuarios y Recuperación de Contraseña

Este proyecto en PHP permite registrar usuarios, iniciar sesión (incluyendo con Google), recuperar contraseñas y cerrar sesión. Utiliza MySQL para la base de datos y está diseñado para ejecutarse en un entorno local con XAMPP.

## ✅ Requisitos Previos

- [XAMPP](https://www.apachefriends.org/) instalado en tu computadora.
- Navegador web.
- Composer (para instalar dependencias de Google API).
- Cuenta de Google Cloud con OAuth 2.0 habilitado.

## 📁 Archivos Incluidos

- `index.php`
- `login.php`
- `logout.php`
- `registro.php`
- `procesar_registro.php`
- `verificar_login.php`
- `recuperar_clave.php`
- `recuperar_claveext.php`
- `recuperar_clave_confirmar.php`
- `stock (1).sql`
- `con_db.php`

## ⚙️ Configuración Paso a Paso

### 1. Mover los archivos al directorio de XAMPP

Colocá la carpeta del proyecto dentro de `htdocs`, por ejemplo:

```
C:\xampp\htdocs\TP\
```

### 2. Iniciar los servicios de XAMPP

- Abrí el **Panel de Control de XAMPP**
- Iniciá **Apache** y **MySQL**

### 3. Crear la base de datos

1. Ingresá a [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Elegí la pestaña **Importar**
3. Seleccioná el archivo `stock (1).sql`
4. Hacé clic en **Continuar**

Esto crea la base de datos `registro` con las tablas `usuarios` y `recuperar`.

### 4. Conexión a la base de datos

El archivo `con_db.php` ya incluye la conexión básica:

```php
<?php
$conex = mysqli_connect("localhost","root","","registro"); 
?>
```

Modificá los datos si tu entorno tiene credenciales diferentes.

---

## 🔐 Integración con Google Login (OAuth 2.0)

### 1. Crear proyecto en Google Cloud

- Accedé a [https://console.cloud.google.com/](https://console.cloud.google.com/)
- Creá un proyecto
- Habilitá la **pantalla de consentimiento OAuth** (tipo Externa)
- Luego, creá credenciales de tipo **ID de cliente de OAuth**
  - Tipo: Aplicación Web
  - URI de redirección:
    ```
    http://localhost/TP/index.php
    ```

### 2. Agregar credenciales en `registro.php`

Editá `registro.php` y colocá tu Client ID y Secret:

```php
$google_client->setClientId('TU_CLIENT_ID');
$google_client->setClientSecret('TU_CLIENT_SECRET');
$google_client->setRedirectUri('http://localhost/TP/index.php');
```

### 3. Instalar dependencias de Google API

Desde la raíz del proyecto, ejecutá:

```bash
composer require google/apiclient
```

Esto creará el directorio `vendor/` necesario para usar:

```php
require_once 'vendor/autoload.php';
```

---

## 🧱 Estructura del Sistema

| Archivo                        | Función                                     |
|-------------------------------|---------------------------------------------|
| `index.php`                   | Página principal                            |
| `login.php`                   | Formulario de inicio de sesión              |
| `logout.php`                  | Cierra la sesión del usuario                |
| `registro.php`                | Registro de usuario y login con Google      |
| `procesar_registro.php`       | Procesa el registro manual                  |
| `verificar_login.php`         | Verifica credenciales                       |
| `recuperar_clave.php`         | Formulario de recuperación por email        |
| `recuperar_claveext.php`      | Genera token y lo envía                     |
| `recuperar_clave_confirmar.php` | Permite definir nueva contraseña         |
| `con_db.php`                  | Conexión a la base de datos                 |

---

## 🛡️ Seguridad Recomendaciones

- Usar `password_hash()` y `password_verify()` en lugar de guardar contraseñas planas.
- Validar y sanear todas las entradas del usuario.
- Implementar expiración de tokens en la tabla `recuperar`.

## ✅ Final

Tu aplicación estará disponible en:

```
http://localhost/TP/registro.php
```

Probá el registro manual, login con Google y la recuperación de contraseña.

---

📧 En caso de errores, revisá los logs de Apache y MySQL desde el panel de XAMPP.
