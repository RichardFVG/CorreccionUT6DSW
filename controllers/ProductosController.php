<?php
// controllers/ProductosController.php

// 1. Incluyo los modelos necesarios para 
// gestionar productos y votos
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Voto.php';

// 2. Defino la clase ProductosController 
// para controlar la lógica de productos
class ProductosController {
    // 3. Declaro propiedades para los 
    // modelos de productos y votos
    private $productoModel;
    private $votoModel;

    // 4. En el constructor, instancio los 
    // modelos correspondientes
    public function __construct() {
        $this->productoModel = new Producto();
        $this->votoModel = new Voto();
    }

    // 5. Función para verificar si el 
    // usuario está logueado
    private function checkLogin() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header(
                "Location: ../../public/index.php?controller=Login&action=login"
            ); 
            exit;
        }
    }

    // 6. Método para mostrar el listado 
    // de productos
    public function listar() {
        // 7. Verifico si hay sesión activa
        $this->checkLogin();  

        // 8. Obtengo todos los productos
        $productos = $this->productoModel->getAll();

        // 9. Para cada producto, consulto 
        // su valoración
        foreach ($productos as &$producto) {
            $valoracion = 
            $this->votoModel->getValoracion(
                $producto['id']
            );

            $producto['media'] = 
            $valoracion['media'] ? 
            round(
                $valoracion['media'], 2
            ) : 'N/A';

            $producto['total'] = 
            $valoracion['total'] ?? 0;
        }

        // 10. Paso los productos con su 
        // valoración a la vista 
        // correspondiente
        require_once __DIR__ . 
        '/../views/productos/listado.php';
    }

    // 11. Método para mostrar el detalle de 
    // un producto en concreto
    public function detalle($id) {
        // 12. Reviso sesión activa
        $this->checkLogin();  

        // 13. Obtengo un producto por su ID
        $producto = 
        $this->productoModel->getById($id);

        require_once __DIR__ . 
        '/../views/productos/detalle.php';
    }

    // 14. Método para crear un nuevo 
    // producto
    public function crear() {
        // 15. Verifico login
        $this->checkLogin();  

        // 16. Si el método es POST, se 
        // procesa el form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];

            $this->productoModel->create(
                $nombre, 
                $descripcion, 
                $precio
            );
            header(
                "Location: ../../public/index.php?controller=Productos&action=listar"
            );
        } 
        
        else {
            // 17. Si es GET, muestro la 
            // vista de creación
            require_once __DIR__ . 
            '/../views/productos/crear.php';
        }
    }

    // 18. Método para actualizar un producto 
    // existente
    public function update($id) {
        // 19. Reviso si hay sesión
        $this->checkLogin();  

        // 20. Si recibo datos por POST, 
        // procedo a actualizar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];

            $this->productoModel->update(
                $id, 
                $nombre, 
                $descripcion, 
                $precio
            );
            header(
                "Location: ../../public/index.php?controller=Productos&action=detalle&id=$id"
            );
        } 
        
        else {
            // 21. En GET, cargo el producto 
            // y muestro el formulario
            $producto = 
            $this->productoModel->getById($id);

            require_once __DIR__ . 
            '/../views/productos/update.php';
        }
    }

    // 22. Método para borrar un producto
    public function borrar($id) {
        // 23. Reviso login
        $this->checkLogin();  

        // 24. Elimino el producto y redirijo 
        // al listado
        $this->productoModel->delete($id);
        header(
            "Location: ../../public/index.php?controller=Productos&action=listar"
        );
    }

    // 25. Método para obtener valoraciones 
    // de un producto desde el modelo de votos
    public function getValoraciones(
        $idPr
    ) {
        return $this->votoModel->getValoracion(
            $idPr
        );
    }
}
