# Corrección Proyecto UT6

## Descripción del proyecto

He desarrollado este **sistema de valoración de productos con estrellas**, donde los usuarios pueden iniciar sesión, ver un listado de productos, consultar sus detalles y realizar valoraciones, siempre que no hayan valorado el producto con anterioridad. Además, permite la gestión de productos (crear, editar y eliminar) para un administrador o usuarios con permisos.

## Tecnologías utilizadas

- **PHP 7 o superior** (para la lógica del lado del servidor).
- **MySQL** (para la base de datos, donde almaceno usuarios, productos y votos).
- **HTML5 y CSS3** (para la estructura y estilos de la aplicación).
- **JavaScript (Axios)** (para manejar peticiones asíncronas en el login).
- **XAMPP** (Apache + MySQL) en Windows para el entorno de desarrollo local.
- **Visual Studio Code** con extensión **PHP Server** (opcional, para previsualizar el proyecto).

## Instrucciones de instalación y ejecución

1. **Clonar o descargar el repositorio**  
   - Descargo (o clono) este repositorio y lo coloco dentro de la carpeta `htdocs` de mi instalación de XAMPP.  
   - Por ejemplo, en Windows la ruta puede ser:
     ```
     C:\Users\Alpha\OneDrive\Documents\XAMPP\htdocs
     ```
   - Verifico que la estructura del proyecto se conserve tal como está (directorios y archivos).

2. **Levantar servidor Apache y MySQL con XAMPP**  
   - Inicio **XAMPP Control Panel**.  
   - Activo los módulos **Apache** (esencial para PHP) y **MySQL** (requerido para la base de datos).

3. **Configurar la base de datos**  
   - Accedo a `http://localhost/phpmyadmin/` en el navegador.  
   - Creo una base de datos llamada `valoracion_stars` (o cualquier otro nombre, pero luego ajusto la configuración en `config/db.php`).  
   - Importo el archivo `estrellas4.sql` que se encuentra en la raíz de este proyecto. Esto creará las tablas (`productos`, `usuarios`, `votos`) y los datos de ejemplo.

4. **Ejecutar el proyecto en el navegador**  
   - Con Apache y MySQL funcionando, abro mi navegador y voy a:
     ```
     http://localhost:3000/public/index.php
     ```
   - Ahí se mostrará el formulario de login y podré usar la aplicación.

5. **Uso de Visual Studio Code con la extensión PHP Server (opcional)**  
   - Abro la carpeta del proyecto en **Visual Studio Code**.  
   - Instalo la extensión **PHP Server** (si no la tengo).  
   - Hago clic derecho sobre el archivo `index.php` (ubicado en la carpeta `public`) y selecciono **“PHP Server: Serve project”**.  
   - Se abrirá el proyecto en el navegador, apuntando a un servidor local.  
   - Recuerdo mantener activo el servicio de MySQL en XAMPP para conectarme a la base de datos.

## Capturas de pantalla de la prueba de ejecución

*(Espacio reservado para agregar capturas de pantalla más adelante.)*
