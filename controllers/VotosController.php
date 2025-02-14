<?php
// controllers/VotosController.php

require_once __DIR__ . '/../models/Voto.php';

class VotosController {
    private $votoModel;

    public function __construct() {
        $this->votoModel = new Voto();
    }

    // Guarda el voto por primera vez.
    public function store() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            echo json_encode(["ok" => false, "msg" => "No estás logueado"]);
            return;
        }

        $idUs = $_SESSION['usuario'];
        $idPr = $_POST['idPr'];
        $cantidad = $_POST['cantidad'];

        $exito = $this->votoModel->votar($idUs, $idPr, $cantidad);

        if (!$exito) {
            echo json_encode(["ok" => false, "msg" => "Ya has valorado este producto"]);
        } else {
            echo json_encode(["ok" => true, "msg" => "Valoración guardada con éxito"]);
        }
    }

    /**
     * Método para editar/actualizar la valoración de un producto concreto.
     * Sustituyendo la lógica de "sumar" o "restar" por un "asignar nuevo valor".
     */
    public function updateRating() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            // Si no hay sesión, redirigimos a login
            header("Location: ../../public/index.php?controller=Login&action=login");
            exit;
        }

        $idUs = $_SESSION['usuario'];
        // Vienen por POST:
        $idPr = $_POST['idPr'] ?? null;
        $nuevoValor = $_POST['cantidad'] ?? null;  // AHORA esto será el valor "directo"
        $modo = $_POST['modo'] ?? null; // Si quieres, puedes ignorar modo o directamente quitarlo

        if (!$idPr || !$nuevoValor) {
            echo "<p style='color:red;'>Faltan datos de 'idPr' o 'cantidad'.</p>";
            return;
        }

        // Verificar si ya existía un voto anterior
        $existeVoto = $this->votoModel->getVoto($idUs, $idPr);

        // Asegurar que está dentro de 1..5
        $nuevoRating = (int)$nuevoValor;
        if ($nuevoRating < 1) {
            $nuevoRating = 1;
        } elseif ($nuevoRating > 5) {
            $nuevoRating = 5;
        }

        // Si existía voto, lo actualizamos. Si no, lo insertamos.
        if ($existeVoto) {
            $this->votoModel->updateVoto($idUs, $idPr, $nuevoRating);
        } else {
            $this->votoModel->votar($idUs, $idPr, $nuevoRating);
        }

        // Redirigimos al listado de productos para que se vea la nueva media
        header("Location: ../../public/index.php?controller=Productos&action=listar");
        exit;
    }
}
