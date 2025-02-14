<!-- views/productos/update.php -->

<!-- 1. Incluyo la cabecera para generar 
 la estructura HTML -->
<?php include_once __DIR__ . 
"/../layout/header.php"; ?>

<!-- 2. Formulario para actualizar un 
 producto -->
<h2>Actualizar Producto</h2>
<form action="../../public/index.php?controller=Productos&action=update" 
method="POST">
    <!-- 3. Campo oculto con el ID del 
     producto -->
    <input type="hidden" name="id" 
    value="<?php 
        echo $producto['id']; 
    ?>">

    <!-- 4. Campo para modificar el 
     nombre -->
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" 
    name="nombre" value="<?php 
        echo $producto['nombre']; 
    ?>" required>

    <!-- 5. Campo para modificar la 
     descripción -->
    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" 
    required><?php 
        echo $producto['descripcion']; 
    ?></textarea>

    <!-- 6. Campo para modificar el 
     precio -->
    <label for="precio">Precio:</label>
    <input type="number" id="precio" 
    name="precio" step="0.01" 
    value="<?php 
        echo $producto['precio']; 
    ?>" required>

    <button type="submit">
        Actualizar Producto
    </button>
</form>

<!-- 7. Incluyo el footer que cierra 
 el documento -->
<?php include_once __DIR__ . 
"/../layout/footer.php"; ?>
