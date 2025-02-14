<?php
// controllers/VotosController.php

// 1. Incluyo el modelo Voto para poder gestionar la lógica de valoraciones
require_once __DIR__ . '/../models/Voto.php';

// 2. Defino la clase VotosController
class VotosController {
    // 3. Declaro la propiedad para el 
    // modelo de Votos
    private $votoModel;

    // 4. En el constructor instancio el 
    // modelo Voto
    public function __construct() {
        $this->votoModel = new Voto();
    }

    // 5. Método para guardar los votos en 
    // la base de datos
    public function store() {
        session_start();
        // 6. Verifico que el usuario esté 
        // logueado
        if (!isset($_SESSION['usuario'])) {
            echo json_encode(
                ["ok" => false, "msg" => "No estás logueado"]
            );
            return;
        }

        // 7. Capturo los datos del formulario 
        // (id de producto, cantidad)
        $idUs = $_SESSION['usuario'];
        $idPr = $_POST['idPr'];
        $cantidad = $_POST['cantidad'];

        // 8. Llamo al método votar del modelo
        $exito = 
        $this->votoModel->votar(
            $idUs, $idPr, $cantidad
        );

        // 9. Respondo en JSON indicando si el 
        // voto fue guardado o ya existía
        if (!$exito) {
            echo json_encode(
                ["ok" => false, "msg" => "Ya has valorado este producto"]
            );
        } 
        
        else {
            echo json_encode(
                ["ok" => true, "msg" => "Valoración guardada con éxito"]
            );
        }
    }
}
