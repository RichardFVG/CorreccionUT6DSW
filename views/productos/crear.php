<!-- views/productos/crear.php -->

<!-- 1. Añadimos la cabecera (header) -->
<?php include_once __DIR__ . 
"/../layout/header.php"; ?>

<!-- 2. Formulario para crear un 
 producto nuevo -->
<h2>Crear Producto</h2>
<form action="../../public/index.php?controller=Productos&action=crear" 
method="POST">
    <!-- 3. Campo para el nombre del 
     producto -->
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" 
    name="nombre" required>

    <!-- 4. Campo para la descripción 
     del producto -->
    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" 
    required></textarea>

    <!-- 5. Campo para el precio del 
     producto -->
    <label for="precio">Precio:</label>
    <input type="number" id="precio" 
    name="precio" step="0.01" required>

    <!-- 6. Botón para crear el 
     producto -->
    <button type="submit">Crear Producto</button>
</form>

<!-- 7. Incluimos el footer -->
<?php include_once __DIR__ . 
"/../layout/footer.php"; ?>
