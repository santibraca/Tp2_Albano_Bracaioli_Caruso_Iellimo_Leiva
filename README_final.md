# Sistema de Registro de Usuarios y Recuperación de Contraseña

Este proyecto en PHP permite registrar usuarios, iniciar sesión, recuperar contraseñas y cerrar sesión. Utiliza MySQL para la base de datos y está pensado para ser ejecutado en un entorno local con XAMPP.

## ✅ Requisitos Previos

- [XAMPP](https://www.apachefriends.org/) instalado en tu computadora (incluye Apache y MySQL).
- Navegador web.
- Editor de texto o IDE (opcional, recomendado: VS Code).
- (Opcional) Composer para manejo de dependencias de Google API.

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
- `config.php`

## ⚙️ Configuración Paso a Paso

### 1. Mover los archivos al directorio de XAMPP

Ubica la carpeta del proyecto (que contenga todos los archivos PHP mencionados) dentro de la carpeta `htdocs` de XAMPP. Por ejemplo:

```
C:\xampp\htdocs\registro-app\
```

### 2. Iniciar los servicios de XAMPP

- Abrí el **Panel de Control de XAMPP**
- Activá los módulos **Apache** y **MySQL**

### 3. Crear la base de datos

1. Abrí tu navegador y andá a [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Hacé clic en la pestaña **Importar**
3. Seleccioná el archivo `stock (1).sql`
4. Hacé clic en **Continuar**

Esto va a crear la base de datos `registro` con las tablas necesarias:
- `usuarios`
- `recuperar`

### 4. Configuración de conexión a la base de datos

Este proyecto ya incluye los archivos `config.php` y `con_db.php` que centralizan la conexión con la base de datos.

Ejemplo de `config.php`:

```php
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "registro";
?>
```

Ejemplo de `con_db.php`:

```php
<?php
include 'config.php';
$conexion = new mysqli($host, $user, $pass, $db);
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
```

---

## 🔐 Integración con Google Login (OAuth 2.0)

Este sistema incluye autenticación con Google. Para configurarlo:

### 1. Crear proyecto en Google Cloud

- Accedé a [https://console.cloud.google.com/](https://console.cloud.google.com/)
- Creá un proyecto
- Configurá la pantalla de consentimiento OAuth (tipo: Externa)
- Creá una credencial de tipo **ID de cliente de OAuth**
  - Tipo de aplicación: **Aplicación web**
  - URI autorizado de redirección:
    ```
    http://localhost/TP/index.php
    ```

### 2. Configurar Client ID y Secret

Agregalos en `config.php` u otro archivo de configuración:

```php
$google_client_id = "TU_CLIENT_ID";
$google_client_secret = "TU_CLIENT_SECRET";
$google_redirect_uri = "http://localhost/TP/index.php";
```

### 3. Cargar Google API Client

Instalación por Composer (opcional pero recomendado):

```bash
composer require google/apiclient:^2.0
```

Código de inicialización:

```php
require_once 'vendor/autoload.php';

$client = new Google_Client();
$client->setClientId($google_client_id);
$client->setClientSecret($google_client_secret);
$client->setRedirectUri($google_redirect_uri);
$client->addScope("email");
$client->addScope("profile");
```

---

## 🧱 Estructura del Sistema

| Archivo                        | Función                                     |
|-------------------------------|---------------------------------------------|
| `index.php`                   | Página principal                            |
| `login.php`                   | Formulario de inicio de sesión              |
| `logout.php`                  | Cierra la sesión del usuario                |
| `registro.php`                | Formulario de registro                      |
| `procesar_registro.php`       | Procesa y guarda nuevos usuarios            |
| `verificar_login.php`         | Verifica las credenciales al iniciar sesión |
| `recuperar_clave.php`         | Solicita email para recuperar contraseña    |
| `recuperar_claveext.php`      | Genera y envía token de recuperación        |
| `recuperar_clave_confirmar.php` | Permite definir nueva contraseña         |
| `config.php`                  | Contiene los datos de conexión              |
| `con_db.php`                  | Establece la conexión con la base de datos  |

## 🛡️ Seguridad (Recomendaciones)

- Usar `password_hash()` y `password_verify()` para manejar contraseñas.
- Manejar vencimiento de tokens con `fechaalta` en la tabla `recuperar`.
- Proteger formularios contra CSRF y validar entradas del usuario.

## ✅ Listo

Una vez configurado todo, el sistema debería estar en funcionamiento en tu entorno local. Podés registrar nuevos usuarios, iniciar sesión, iniciar sesión con Google y usar la recuperación de contraseña.

---

📧 Si tenés dudas o errores al ejecutar el sistema, revisá los logs de Apache y MySQL en el panel de XAMPP.
