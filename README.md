<a name="readme-top"></a>

# Explicación del proyecto

<p>Es un sitio de inventarios y ventas de productos.</p>

<br />
<br />

# Instalación de manera local

## Archivo .env

#### Que es este archivo

_El archivo `.env` en Laravel es un archivo de configuración que almacena variables de entorno para una aplicación. Estas variables se utilizan para configurar la aplicación en diferentes entornos, como desarrollo, pruebas y producción. El archivo `.env` se utiliza para almacenar información confidencial, como contraseñas de bases de datos, claves de API y credenciales de correo electrónico, que no deben ser compartidas en el código fuente de la aplicación. En su lugar, se almacenan en el archivo `.env` y se acceden a través de la función env en Laravel._

### Credenciales

_Al clonar este proyecto ve al archivo *.env.example* copia este archivo con el nombre de: `.env` y coloca tus credenciales, que coincidan con tu DB, Email_

-   Ejemplo de credenciales para la DB, asegurate que coincidan con tu tipo de conexión para tu DB.

1. **Asegúrate de configurar correctamente las siguientes variables:**

-   `APP_NAME`: El nombre de tu aplicación.
-   `APP_URL`: La URL base de tu aplicación (por ejemplo, `http://localhost:8000` o `http://127.0.0.1:8000`) o como sea la manera que levantes de manera local el proyecto.
-   `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`: Configuración de la base de datos.
-   `FILESYSTEM_DISK`: Establecer a `public` para el almacenamiento de imágenes.
    Ejemplo de `.env`:

```
APP_NAME=MiProyecto
APP_URL=http://127.0.0.1:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=base_de_datos_nombre
DB_USERNAME=usuario
DB_PASSWORD=password
FILESYSTEM_DISK=public
```

<br />
<br />

## Usuarios por defecto

_Lo posterior al "@" `laravel` corresponde al nombre de la app en el archivo `.env`._

| Admin      | Datos                     |
| ---------- | ------------------------- |
| Nombre     | Usuario Administrador     |
| Email      | administrador@laravel.com |
| Contraseña | 123                       |

<br />
<br />

# Comandos

## Comandos de Instalación

-   _La instalación de este proyecto necesita que se ejecuten de manera cronológica y ordenada._

```bash
  cd InventarioVentas
```

1. **Instalación de los paquetes _Composer_**

```bash
  composer install
```

2. **Instalación de los paquetes _Node_**

```bash
  npm install
```

3. **Construcción de los paquetes _Node_**

```bash
  npm run build
```

4. **Generación de la _llave_ del proyecto**

```bash
  php artisan key:generate
```

5. **Generación de la _DB_**

```bash
  php artisan migrate
```

6. **Utilización del _Seeder_**

```bash
  php artisan db:seed
```

7.  **Crear el enlace simbólico para el almacenamiento público:**

```bash
    php artisan storage:link
```

<br />
<br />

_Listado de comandos que podrian ser necesarios_

-   Limpieza de caché (events/views/cache/route/config/compiled)

    ```
     php artisan optimize:clear
    ```

-   Creación de los links de los archivos estaticos

    ```
    php artisan storage:link
    ```

-   Actualización de la información del cargador automático de clases.

    ```
    composer dump-autoload
    ```

-   Actualizar lang.

    ```
    php artisan lang:update
    ```

## Comandos DB/(SQL)

_Listado de comandos DB_

-   Reinicia desde cero la DB y crea los seeders

    ```
     php artisan migrate:fresh --seed
    ```

-   Revierte la/s última/s migración/es

    ```
     php artisan migrate:rollback
    ```

<br />
<br />

# Servidor Local

_El funcionamiento de esta aplicacion requiere que este levantado de manera simultanea._

## Servidores

_Para levantar este servicio debes estar en la carpeta donde esta este proyecto, debe ser ejecutado con CMD y de manera simultanea el servidor backend y frontend._

```bash
  cd InventarioVentas
```

### Backend

```bash
  php artisan serve
```

<br />

### Frontend

```bash
  npm run dev
```

## Configuración del servidor local

-   _En el archivo `.env` (linea 5)
    Asegúrate de que tu archivo `.env` tenga la variable APP_URL, (Si levantas el servidor con : `php artisan serve`), configurada correctamente:_

```bash
    APP_URL=http://127.0.0.1:8000
```

## Configuración de la zona horaria del servidor

-   _En el archivo `.env` (linea 6)
    Asegúrate de que tu archivo `.env` tenga la variable APP_TIMEZONE configurada correctamente (Concida con tu zona horaria):_

```bash
    APP_TIMEZONE=America/Mexico_City
```

<br />

#### Servidor temporal

_Es posible que quieras levantar este proyecto para que otro dispositivo pueda probar este, o hacer pruebas._

-   Encuentra la dirección IP de tu computadora:

-   Abre una terminal en tu computadora y ejecuta el comando:

```bash
ipconfig
```

Busca la línea que dice Dirección `IPv4` bajo la sección de tu adaptador de red. Será algo como `192.168.0.100.`

```bash
  php artisan serve --host 0.0.0.0 --port 8000
```

<p>
Aquí, --host 0.0.0.0 indica que el servidor debe aceptar conexiones de cualquier dirección IP, y --port 8000 especifica el puerto en el que el servidor escuchará las conexiones.
</p>

Recuerda ejecutar: la construcción de los paquetes _Node_

```bash
  npm run build
```

_Ejemplo:_

```bash
  http://192.168.0.100:8000/
```

<br />
<br />

## Programas Necesarios

-   [Node](https://nodejs.org/en)

### Programas Opcionales

-   [Laragon](https://laragon.org/)
-   [VS Code](https://code.visualstudio.com/)

### Paquetes utlizados

-   [Laravel](https://laravel.com/)
-   [Jetstream](https://jetstream.laravel.com/introduction.html)

# Contacto

Mi Cuenta GitHub: [https://github.com/DonMartinWorks](https://github.com/DonMartinWorks)

<a href="#readme-top">Subir a las instrucciones</a>
