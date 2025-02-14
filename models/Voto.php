<?php
// models/Voto.php

require_once __DIR__ . "/../config/db.php";

class Voto {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    /**
     * Inserta un voto si no existía antes.
     * Devuelve false si el usuario ya había votado el producto.
     */
    public function votar($idUs, $idPr, $cantidad) {
        // Compruebo si ya existe
        $check = $this->db->prepare(
            "SELECT * FROM votos WHERE idUs = ? AND idPr = ?"
        );
        $check->execute([$idUs, $idPr]);
        $resultado = $check->fetch(\PDO::FETCH_ASSOC);

        if ($resultado) {
            // Ya estaba valorado
            return false;
        } else {
            // Inserto nuevo
            $stmt = $this->db->prepare(
                "INSERT INTO votos (idUs, idPr, cantidad) VALUES (?, ?, ?)"
            );
            $stmt->execute([$idUs, $idPr, $cantidad]);
            return true;
        }
    }

    /**
     * Devuelve la media y el total de votos de un producto.
     */
    public function getValoracion($idPr) {
        $stmt = $this->db->prepare(
            "SELECT AVG(cantidad) AS media, COUNT(*) AS total 
               FROM votos 
               WHERE idPr = ?"
        );
        $stmt->execute([$idPr]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$data) {
            return ['media' => null, 'total' => 0];
        }
        return $data;
    }

    /**
     * NUEVO: Recupera el voto (fila completa) de un usuario a un producto
     * o false si no existe.
     */
    public function getVoto($idUs, $idPr) {
        $stmt = $this->db->prepare(
            "SELECT * FROM votos WHERE idUs = ? AND idPr = ?"
        );
        $stmt->execute([$idUs, $idPr]);
        return $stmt->fetch(\PDO::FETCH_ASSOC); // array o false
    }

    /**
     * NUEVO: Actualiza la cantidad de un voto ya existente.
     */
    public function updateVoto($idUs, $idPr, $cantidad) {
        $stmt = $this->db->prepare(
            "UPDATE votos SET cantidad = ? WHERE idUs = ? AND idPr = ?"
        );
        return $stmt->execute([$cantidad, $idUs, $idPr]);
    }
}
