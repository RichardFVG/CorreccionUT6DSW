<?php
// models/Voto.php

// 1. Incluyo la clase Database para realizar 
// consultas
require_once __DIR__ . "/../config/db.php";

// 2. Declaro la clase Voto para gestionar la 
// tabla 'votos'
class Voto {
    // 3. Guardo la conexión en la propiedad $db
    private $db;

    // 4. En el constructor, obtengo la conexión 
    // con la base de datos
    public function __construct() {
        $this->db = Database::connect();
    }

    // 5. Método para insertar un voto, 
    // comprobando que el usuario no haya 
    // votado el mismo producto antes
    public function votar(
        $idUs, $idPr, $cantidad
    ) {
        // 6. Verifico si ya existe un 
        // voto del mismo usuario para el 
        // producto
        $check = 
        $this->db->prepare(
            "SELECT * 
                    FROM votos 
                    WHERE idUs = ? AND idPr = ?"
        );
        $check->execute([$idUs, $idPr]);
        $resultado = $check->fetch(PDO::FETCH_ASSOC);

        // 7. Si ya hay un resultado, no 
        // puedo volver a votar
        if ($resultado) {
            return false;
        } else {
            // 8. Inserto la nueva valoración 
            // si no existía
            $stmt = 
            $this->db->prepare(
                "INSERT INTO votos (idUs, idPr, cantidad) 
                        VALUES (?, ?, ?)"
            );
            $stmt->execute([$idUs, $idPr, $cantidad]);
            return true;
        }
    }

    // 9. Método para obtener la valoración 
    // media y el total de votos de un producto
    public function getValoracion($idPr) {
        $stmt = 
        $this->db->prepare(
            "SELECT AVG(cantidad) AS media, COUNT(*) AS total 
                    FROM votos WHERE idPr = ?"
        );
        $stmt->execute([$idPr]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // 10. Si no hay datos, devuelvo un 
        // array con valores por defecto
        if (!$data) {
            return [
                'media' => null,
                'total' => 0
            ];
        }

        return $data;
    }
}
