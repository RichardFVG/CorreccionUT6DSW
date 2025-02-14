<!-- views/productos/borrar.php -->

<!-- 1. Incluyo la cabecera con el 
 HTML y menú -->
<?php include_once __DIR__ . 
"/../layout/header.php"; ?>

<!-- 2. Muestro un mensaje preguntando 
 confirmación de borrado -->
<h2>Eliminar Producto</h2>

<p>
    ¿Estás seguro de que quieres eliminar el producto <strong><?php 
        echo $producto['nombre']; 
    ?></strong>?
</p>

<!-- 3. Formulario para confirmar 
 eliminación -->
<form action="../../public/index.php?controller=Productos&action=borrar" 
method="POST">
    <!-- 4. Envío el ID oculto para 
     saber qué producto borrar -->
    <input type="hidden" name="id" 
    value="<?php 
        echo $producto['id']; 
    ?>">
    <button type="submit">Eliminar</button>
    <a href="../../public/index.php?controller=Productos&action=listar">
        Cancelar
    </a>
</form>

<!-- 5. Incluyo el footer para cerrar 
 el HTML -->
<?php 
    include_once __DIR__ . 
    "/../layout/footer.php"; 
?>
