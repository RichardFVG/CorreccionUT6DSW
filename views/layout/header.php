<!-- views/layout/header.php -->
<!DOCTYPE html>
<!-- 1. Indico que el documento está en HTML5 
 y en idioma español -->
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- 2. Meta etiqueta para tener un 
     diseño responsive en móviles -->
    <meta name="viewport" 
    content="width=device-width, initial-scale=1.0">
    <title>RFVG: Valoración con Estrellas</title>
    
    <!-- 3. Hoja de estilos principal de la 
     aplicación -->
    <link rel="stylesheet" href="../../public/css/estilos.css">
    
    <!-- 4. Incluyo la librería de iconos de 
     Font Awesome 6.x desde CDN -->
    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- 5. Encabezado principal, con el título 
     y un menú de navegación -->
    <header>
        <h1 class="titulo1">
            Proyecto UT6: Valoración con Estrellas
        </h1>
        <nav>
            <a href="../../public/index.php?controller=Productos&action=listar">
                Productos |
            </a>
            
            <a href="../../public/index.php?controller=Login&action=logout">
                | Cerrar sesión
            </a>
        </nav>
    </header>
    <main>
