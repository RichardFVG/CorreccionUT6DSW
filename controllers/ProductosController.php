<?php
// controllers/ProductosController.php

// 1. Incluyo los modelos necesarios para gestionar productos y votos
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Voto.php';

// 2. Defino la clase ProductosController para controlar la lógica de productos
class ProductosController {
    // 3. Declaro propiedades para los modelos de productos y votos
    private $productoModel;
    private $votoModel;

    // 4. En el constructor, instancio los modelos correspondientes
    public function __construct() {
        $this->productoModel = new Producto();
        $this->votoModel = new Voto();
    }

    // 5. Función para verificar si el usuario está logueado
    private function checkLogin() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header("Location: ../../public/index.php?controller=Login&action=login");
            exit;
        }
    }

    // 6. Método para mostrar el listado de productos
    public function listar() {
        // 7. Verifico si hay sesión activa
        $this->checkLogin();  

        // 8. Obtengo todos los productos
        $productos = $this->productoModel->getAll();

        // 9. Identifico al usuario logueado
        $idUs = $_SESSION['usuario'];

        // 10. Para cada producto, consulto su valoración
        // y también el voto personal del usuario 
        // (¡sin usar foreach con referencia!)
        foreach ($productos as $index => $prod) {
            // Valoración global
            $valoracion = $this->votoModel->getValoracion($prod['id']);
            $productos[$index]['media'] = $valoracion['media'] 
                ? round($valoracion['media'], 2) 
                : 'N/A';
            $productos[$index]['total'] = $valoracion['total'] ?? 0;

            // Voto del usuario actual (si existe)
            $miVoto = $this->votoModel->getVoto($idUs, $prod['id']);
            $productos[$index]['miVoto'] = $miVoto ? $miVoto['cantidad'] : 0;
        }

        // 11. Paso los productos con su valoración a la vista correspondiente
        require_once __DIR__ . '/../views/productos/listado.php';
    }

    // 12. Método para mostrar el detalle de un producto en concreto
    public function detalle($id) {
        // 13. Reviso sesión activa
        $this->checkLogin();
        // 14. Obtengo un producto por su ID
        $producto = $this->productoModel->getById($id);
    
        if (!$producto) {
            // Si no se encontró ningún producto con ese ID
            echo "<p style='color:red;'>No existe producto con ID=$id</p>";
            return; 
        }
    
        require_once __DIR__ . '/../views/productos/detalle.php';
    }

    // 15. Método para mostrar el formulario de crear un nuevo producto (GET)
    public function crearForm() {
        $this->checkLogin();
        require_once __DIR__ . '/../views/productos/crear.php';
    }

    // 16. Método que procesa la inserción de un nuevo producto (POST)
    public function crear() {
        // Verifico login
        $this->checkLogin();  

        // Capturamos los datos por POST
        $nombre = $_POST['nombre'] ?? null;
        $descripcion = $_POST['descripcion'] ?? null;
        $precio = $_POST['precio'] ?? null;

        // Insertamos a través del modelo
        $this->productoModel->create($nombre, $descripcion, $precio);

        // Redirigimos al listado
        header("Location: ../../public/index.php?controller=Productos&action=listar");
        exit;
    }

    // 19. Método para actualizar un producto existente
    public function update($id) {
        // 20. Reviso si hay sesión
        $this->checkLogin();  

        // 21. Si recibo datos por POST, procedo a actualizar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];

            $this->productoModel->update($id, $nombre, $descripcion, $precio);
            header("Location: ../../public/index.php?controller=Productos&action=detalle&id=$id");
            exit;
        } 
        else {
            // 22. En GET, cargo el producto y muestro el formulario
            $producto = $this->productoModel->getById($id);

            require_once __DIR__ . '/../views/productos/update.php';
        }
    }

    // 23. Método para borrar un producto
    public function borrar($id) {
        // 24. Reviso login
        $this->checkLogin();  

        // 25. Elimino el producto y redirijo al listado
        $this->productoModel->delete($id);
        header("Location: ../../public/index.php?controller=Productos&action=listar");
        exit;
    }

    // 26. Método para obtener valoraciones de un producto 
    // (lo usas o no, según tus necesidades)
    public function getValoraciones($idPr) {
        return $this->votoModel->getValoracion($idPr);
    }
}
