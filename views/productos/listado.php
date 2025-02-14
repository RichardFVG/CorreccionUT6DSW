<!-- views/productos/listado.php -->

<!-- 1. Incluir la cabecera general (HTML base y 
 menú) -->
<?php
include_once __DIR__ . "/../layout/header.php";

// 2. Muestro el nombre del usuario en un fondo 
// específico
?>
<p style="background-color: #000000; color: #39FF14; border: 4px solid #ffbf00; border-radius: 10px; padding: 10px;">
    <strong>Bienvenido, <?php 
        echo $_SESSION['usuario']; 
    ?></strong>
</p>

<!-- 3. Título para la lista de productos -->
<h2>Listado de Productos</h2>

<?php
// 4. Función para pintar estrellas según una 
// media
function pintarEstrellas($media) {
    // 5. Convierto el valor a float por si viene 
    // como string
    $valor = floatval($media);

    // 6. Calculo cuántas estrellas completas 
    // (parte entera)
    $estrellasCompletas = floor($valor);

    // 7. Averiguo si hay media estrella (parte 
    // decimal >= 0.5)
    $parteDecimal = $valor - $estrellasCompletas;
    $hayMediaEstrella = ($parteDecimal >= 0.5) ? 1 : 0;

    // 8. El resto serán estrellas vacías
    $estrellasVacias = 
    5 - $estrellasCompletas - $hayMediaEstrella;
    
    // 9. Construyo el HTML de estrellas
    $html = "";
    
    // 10. Pinto las estrellas completas
    for ($i = 0; $i < $estrellasCompletas; $i++) {
        $html .= 
        '<i class="fas fa-star" style="color:#ffc107;"></i>';
    }

    // 11. Pinto la media estrella si corresponde
    if ($hayMediaEstrella) {
        $html .= 
        '<i class="fas fa-star-half-stroke" style="color:#ffc107;"></i>';
    }

    // 12. Pinto las estrellas vacías
    for ($j = 0; $j < $estrellasVacias; $j++) {
        $html .= 
        '<i class="far fa-star" style="color:#ffc107;"></i>';
    }
    
    return $html;
}
?>

<!-- 13. Genero la tabla con productos -->
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Valoración</th>
        <th>Acciones</th>
    </tr>

    <?php
        // 14. Verifico si la variable $productos existe y 
        // recorro cada uno
        if (isset($productos)) {
            foreach ($productos as $producto) {
                $media = $producto['media'];
                // 15. Si no hay valoraciones, lo transformo 
                // a 0 para pintar 0 estrellas
                if ($media === 'N/A') {
                    $media = 0;
                }
                ?>
                <tr>
                    <td><?php echo $producto['id']; ?></td>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo $producto['descripcion']; ?></td>
                    <td>€<?php echo $producto['precio']; ?></td>
                    
                    <td>
                        <?php
                        // 16. Pinto las estrellas según la media 
                        // calculada
                        echo pintarEstrellas($media);
                        // 17. Muestro la media numérica entre 
                        // paréntesis
                        echo ' <span style="color:#666;">(' . 
                        round($media, 2) . '/5)</span>';
                        ?>
                    </td>
                    
                    <td>
                        <!-- 18. Enlaces para ver detalle, editar o borrar el producto -->
                        <a href="../../public/index.php?controller=Productos&action=detalle&id=<?php 
                            echo $producto['id']; 
                        ?>">Ver</a>

                        <a href="../../public/index.php?controller=Productos&action=update&id=<?php 
                            echo $producto['id']; 
                        ?>">Editar</a>

                        <a href="../../public/index.php?controller=Productos&action=borrar&id=<?php 
                            echo $producto['id']; 
                        ?>" onclick="return confirm('¿Estás seguro?')">
                        Borrar
                        </a>
                    </td>
                </tr>
            <?php
            }
        } 
        
        else {
            // 19. Si no hay productos, muestro un mensaje
            echo "<tr><td colspan='6'>No hay productos disponibles.</td></tr>";
        }
    ?>
</table>

<!-- 20. Enlace para crear un nuevo producto -->
<p>
    <a href="../../public/index.php?controller=Productos&action=crear">
        Crear nuevo producto
    </a>
</p>

<!-- 21. Cierro con el footer general -->
<?php
include_once __DIR__ . 
"/../layout/footer.php";
?>
