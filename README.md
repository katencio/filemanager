## Aplicación de Gestión de Archivos con Laravel y Docker (Apache)

Esta es una aplicación sencilla en Laravel para gestionar archivos:

- Área superior para subir archivos.
- Listado de archivos ya subidos con opciones para **descargar** y **eliminar**.
- Desplegada con Docker usando **PHP 8.2 + Apache** y **MySQL 8.0**.

### Requisitos previos

- Docker
- Docker Compose

### Puesta en marcha

1. Construir e iniciar los contenedores:

   ```bash
   docker compose up --build
   ```

   El script de entrada (`entrypoint.sh`) ejecutará automáticamente:
   - Generación de `APP_KEY` si no existe
   - Migraciones de base de datos
   - Creación del enlace simbólico de storage
   - Ajuste de permisos

2. Acceder a la aplicación en el navegador:

   - `http://localhost:8000`

**Nota:** Si necesitas ejecutar comandos manualmente dentro del contenedor:

```bash
docker compose exec app bash
```

### Configuración de base de datos

Por defecto, `docker-compose.yml` define:

- `DB_HOST=db`
- `DB_DATABASE=laravel`
- `DB_USERNAME=laravel`
- `DB_PASSWORD=secret`

Asegúrate de que tu `.env` dentro del contenedor utiliza estos mismos valores.

### Estructura relevante

- `app/Models/File.php`: Modelo Eloquent para los archivos.
- `app/Http/Controllers/FileController.php`: Controlador con lógica de subida, descarga y borrado.
- `database/migrations/*create_files_table.php`: Migración de la tabla `files`.
- `routes/web.php`: Rutas principales de la aplicación.
- `resources/views/layouts/app.blade.php`: Layout base.
- `resources/views/files/index.blade.php`: Vista principal con el formulario de subida y el listado de archivos.


