<?php
// models/Producto.php

// 1. Incluyo la clase Database para obtener 
// la conexión
require_once __DIR__ . "/../config/db.php";

// 2. Defino la clase Producto que interactúa 
// con la tabla 'productos'
class Producto {
    // 3. Guardo la referencia a la conexión 
    // en $db
    private $db;

    // 4. En el constructor conecto a la BD 
    // usando Database::connect()
    public function __construct() {
        $this->db = Database::connect();
    }

    // 5. Método para obtener todos los 
    // productos
    public function getAll() {
        $stmt = 
        $this->db->prepare(
            "SELECT * FROM productos ORDER BY id ASC"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 6. Método para crear un nuevo 
    // producto
    public function create($nombre, $descripcion, $precio) {
        $stmt = 
        $this->db->prepare(
            "INSERT INTO productos (nombre, descripcion, precio) 
                    VALUES (?, ?, ?)"
        );
        return $stmt->execute(
            [$nombre, $descripcion, $precio]
        );
    }

    // 7. Método para obtener un producto 
    // por su ID
    public function getById($id) {
        $stmt = 
        $this->db->prepare(
            "SELECT * FROM productos WHERE id = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 8. Método para actualizar los campos 
    // de un producto según su ID
    public function update(
        $id, $nombre, $descripcion, $precio
    ) {
        $stmt = $this->db->prepare(
            "UPDATE productos 
                    SET nombre=?, descripcion=?, precio=? 
                    WHERE id=?"
        );
        return $stmt->execute(
            [$nombre, $descripcion, $precio, $id]
        );
    }

    // 9. Método para borrar un producto por 
    // ID
    public function delete($id) {
        $stmt = 
        $this->db->prepare(
            "DELETE FROM productos WHERE id=?"
        );

        return $stmt->execute([$id]);
    } 
}
