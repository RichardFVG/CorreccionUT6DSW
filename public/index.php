<?php
// public/index.php

// 1. Incluyo los controladores de Login 
// y Productos
require_once __DIR__ . 
'/../controllers/LoginController.php';

require_once __DIR__ . 
'/../controllers/ProductosController.php';

// 2. Capturo el controlador y la acción 
// desde la URL (GET)
$controller = $_GET['controller'] ?? 'Login';
$action = $_GET['action'] ?? 'index';

// 3. Verifico si el controlador es 
// 'Login'
if ($controller == 'Login') {
    $loginCtrl = new LoginController();
    // 4. Si la acción es 'login' con 
    // método POST, llamo al método login
    if (
        $action == 'login' && 
        $_SERVER['REQUEST_METHOD'] === 'POST'
    ) {
        $loginCtrl->login();
    // 5. Si la acción es 'logout', 
    // llamo al método logout
    } 
    
    elseif ($action == 'logout') {
        $loginCtrl->logout();
    } 
    
    else {
        // 6. Cualquier otro caso, 
        // muestro la vista de login
        require_once __DIR__ . 
        '/../views/login/index.php';
    }
} 

elseif ($controller == 'Productos') {
    // 7. Creo instancia del controlador 
    // de productos
    $productosCtrl = new ProductosController();
    // 8. Dependiendo de la acción, 
    // llamo al método correspondiente
    if ($action == 'listar') {
        $productosCtrl->listar();
    } 
    
    elseif ($action == 'detalle') {
        $productosCtrl->detalle($_GET['id']);
    } 
    
    elseif ($action == 'crear') {
        $productosCtrl->crear();
    } 
    
    elseif ($action == 'update') {
        $productosCtrl->update($_GET['id']);
    } 
    
    elseif ($action == 'borrar') {
        $productosCtrl->borrar($_GET['id']);
    }
}
