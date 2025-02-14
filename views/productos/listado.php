<!-- views/productos/listado.php -->

<?php
include_once __DIR__ . "/../layout/header.php";
?>
<p style="background-color: #000; color: #39FF14; border: 4px solid #ffbf00; border-radius: 10px; padding: 10px;">
    <strong>Bienvenido, <?php echo $_SESSION['usuario']; ?></strong>
</p>

<h2>Listado de Productos</h2>

<?php
// Función para pintar estrellas según un valor numérico
function pintarEstrellas($valorNumerico) {
    $valor = floatval($valorNumerico);
    $estrellasCompletas = floor($valor);
    $parteDecimal = $valor - $estrellasCompletas;
    $hayMediaEstrella = ($parteDecimal >= 0.5) ? 1 : 0;
    $estrellasVacias = 5 - $estrellasCompletas - $hayMediaEstrella;

    $html = "";
    for ($i = 0; $i < $estrellasCompletas; $i++) {
        $html .= '<i class="fas fa-star" style="color:#ffc107;"></i>';
    }
    if ($hayMediaEstrella) {
        $html .= '<i class="fas fa-star-half-stroke" style="color:#ffc107;"></i>';
    }
    for ($j = 0; $j < $estrellasVacias; $j++) {
        $html .= '<i class="far fa-star" style="color:#ffc107;"></i>';
    }
    return $html;
}
?>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Tu Voto</th>
        <th>Acciones</th>
    </tr>

    <?php
    if (isset($productos) && is_array($productos)) {
        foreach ($productos as $producto) {
            // Voto del usuario logueado
            $miVoto = isset($producto['miVoto']) ? (int)$producto['miVoto'] : 0;
            ?>
            <tr>
                <td><?php echo $producto['id']; ?></td>
                <td><?php echo $producto['nombre']; ?></td>
                <td><?php echo $producto['descripcion']; ?></td>
                <td>€<?php echo $producto['precio']; ?></td>
                <td>
                    <!-- Formulario para cambiar mi voto -->
                    <form method="POST" 
                          action="../../public/index.php?controller=Votos&action=updateRating">
                        <input type="hidden" name="idPr" value="<?php echo $producto['id']; ?>" />

                        <!-- Select para elegir la cantidad de estrellas (mi voto) -->
                        <select name="cantidad">
                            <option value="1" <?php echo ($miVoto == 1 ? 'selected' : ''); ?>>1 estrella</option>
                            <option value="2" <?php echo ($miVoto == 2 ? 'selected' : ''); ?>>2 estrellas</option>
                            <option value="3" <?php echo ($miVoto == 3 ? 'selected' : ''); ?>>3 estrellas</option>
                            <option value="4" <?php echo ($miVoto == 4 ? 'selected' : ''); ?>>4 estrellas</option>
                            <option value="5" <?php echo ($miVoto == 5 ? 'selected' : ''); ?>>5 estrellas</option>
                        </select>

                        <button type="submit" name="modo" value="set">
                            Cambiar voto
                        </button>
                    </form>

                    <!-- Mostramos gráficamente tu voto -->
                    <p style="margin:5px 0 0;font-weight:bold;">Tu voto actual:</p>
                    <?php
                    if ($miVoto > 0) {
                        echo pintarEstrellas($miVoto);
                        echo ' <span style="color:#666;">(' . $miVoto . '/5)</span>';
                    } else {
                        echo '<span style="color:red;">Aún no has votado.</span>';
                    }
                    ?>
                </td>
                <td>
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
    } else {
        echo "<tr><td colspan='6'>No hay productos disponibles.</td></tr>";
    }
    ?>
</table>

<p>
    <a href="../../public/index.php?controller=Productos&action=crear">
        Crear nuevo producto
    </a>
</p>

<?php
include_once __DIR__ . "/../layout/footer.php";
?>
