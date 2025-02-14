<!-- views/login/index.php -->

<!-- 1. Incluyo la cabecera general 
 (header) -->
<?php include_once __DIR__ . 
"/../layout/header.php"; ?>

<!-- 2. Contenedor para el login, donde 
 pongo el formulario -->
<div class="login-container">
    <!-- 3. Inserto un ícono ( ! ) con 
     tooltip que muestra información de 
     usuario/contraseña -->
    <div class="tooltip">( ! )
        <span class="tooltiptext">
            Usuario1: admin, 1234<br>
            Usuario2: ana, 4321
        </span>
    </div>
    <h2 class="titulo2">Iniciar Sesión</h2>

    <!-- 4. Mensaje donde mostraré 
     resultados de validación -->
    <div id="mensajeResultado" 
    style="color: red; font-weight: bold;"></div>

    <!-- 5. Formulario para login, con 
     campos usuario y contraseña -->
    <form id="loginForm">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" 
        name="usuario" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" 
        name="password" required>

        <button type="submit" id="btnLogin">
            Entrar
        </button>
    </form>
</div>

<!-- 6. Incluyo el footer general -->
<?php 
    include_once __DIR__ . 
    "/../layout/footer.php"; 
?>
