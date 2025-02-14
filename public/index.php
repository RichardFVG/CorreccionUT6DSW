<?php
// public/index.php

// 1. Incluyo los controladores necesarios
require_once __DIR__ . '/../controllers/LoginController.php';
require_once __DIR__ . '/../controllers/ProductosController.php';
require_once __DIR__ . '/../controllers/VotosController.php';

// 2. Capturo el controlador y la acción desde la URL
$controller = $_GET['controller'] ?? 'Login';
$action = $_GET['action'] ?? 'index';

// 3. Ruteo según el controlador solicitado
if ($controller == 'Login') {
    $loginCtrl = new LoginController();

    if ($action == 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $loginCtrl->login();
    } elseif ($action == 'logout') {
        $loginCtrl->logout();
    } else {
        // 6. Cualquier otro caso, muestro la vista de login
        require_once __DIR__ . '/../views/login/index.php';
    }

} elseif ($controller == 'Productos') {
    $productosCtrl = new ProductosController();

    if ($action == 'listar') {
        $productosCtrl->listar();

    } elseif ($action == 'detalle') {
        // Verificamos si llega el ID
        if (isset($_GET['id'])) {
            $productosCtrl->detalle($_GET['id']);
        } else {
            echo "<p style='color:red;'>Falta el parámetro 'id' en la URL.</p>";
        }

    } elseif ($action == 'crear') {
        // Separamos GET y POST igual que en 'update'
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar la creación
            $productosCtrl->crear();
        } else {
            // Mostrar el formulario
            $productosCtrl->crearForm();
        }

    } elseif ($action == 'update') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Si llega por POST, recogemos el ID por $_POST
            $productosCtrl->update($_POST['id']);
        } elseif (isset($_GET['id'])) {
            // Si es GET y llega 'id' en la query, muestro el form de edición
            $productosCtrl->update($_GET['id']);
        } else {
            echo "<p style='color:red;'>Falta el parámetro 'id' en la URL.</p>";
        }

    } elseif ($action == 'borrar') {
        if (isset($_GET['id'])) {
            $productosCtrl->borrar($_GET['id']);
        } else {
            echo "<p style='color:red;'>Falta el parámetro 'id' en la URL.</p>";
        }
    } else {
        echo "<p style='color:red;'>Acción desconocida: $action</p>";
    }

} elseif ($controller == 'Votos') {
    // Controlador de valoraciones
    $votosCtrl = new VotosController();

    if ($action == 'store') {
        // guardar voto la 1ª vez
        $votosCtrl->store();
    } elseif ($action == 'updateRating') {
        // actualizar/editar voto
        $votosCtrl->updateRating();
    } else {
        echo "<p style='color:red;'>Acción desconocida en Votos: $action</p>";
    }

} else {
    // Si el controlador no coincide, muestro error simple
    echo "<p style='color:red;'>Controlador desconocido: $controller</p>";
}
