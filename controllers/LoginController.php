<?php
// controllers/LoginController.php

// 1. Incluyo la clase Database para poder 
// conectar con la base de datos
require_once __DIR__ . '/../config/db.php';

// 2. Defino la clase LoginController para 
// gestionar la lógica de inicio de sesión
class LoginController
{
    // 3. Método principal de login, que 
    // maneja tanto GET como POST
    public function login()
    {
        // 4. Fuerzo la salida como JSON 
        // para las respuestas por POST
        header(
            'Content-Type: application/json; charset=utf-8'
        );

        // 5. Verifico que la petición sea 
        // de tipo POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 6. Capturo el usuario y 
            // contraseña enviados por el formulario
            $usuario = $_POST['usuario'] ?? null;
            $password = $_POST['password'] ?? null;

            // 7. Si faltan credenciales, 
            // respondo con error en formato JSON
            if (!$usuario || !$password) {
                echo json_encode([
                    'ok' => false,
                    'msg' => 'Faltan credenciales.'
                ]);
                exit;
            }

            // 8. Conecto a la base de 
            // datos
            $db = Database::connect();

            // 9. Preparo la consulta para buscar 
            // al usuario con la contraseña dada
            $stmt = 
            $db->prepare(
                "SELECT * FROM usuarios WHERE usuario=? AND password=?"
            );
            $stmt->execute([$usuario, $password]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            // 10. Verifico si el usuario existe
            if ($user) {
                // 11. Si es válido, inicio la 
                // sesión y guardo el usuario
                session_start();
                $_SESSION['usuario'] = $user['usuario'];

                // 12. Envío una respuesta indicando 
                // éxito y la URL de redirección
                echo json_encode([
                    'ok' => true,
                    'msg' => 'Login correcto',
                    'redirectUrl' => '../../public/index.php?controller=Productos&action=listar'
                ]);
                exit;
            } 
            
            else {
                // 13. Si no existe el usuario, seteo 
                // la zona horaria y construyo un mensaje 
                // de debug
                date_default_timezone_set('Atlantic/Canary');
                $tz = new \DateTimeZone('Atlantic/Canary');
                $now = new \DateTime('now', $tz);
                $offsetStr = $now->format('P');
                $offsetStrNoColon = 
                str_replace(":", "", $offsetStr);

                $fechaFormateada = 
                $now->format("D M d Y H:i:s") . 
                " GMT{$offsetStrNoColon} (hora de Islas Canarias)";

                // 14. Simulo la salida de depuración 
                // parecida a Xajax
                $fakeDebugOutput = "
{$fechaFormateada}
CALLING: xjxFu
  [Usuario/Contraseña inválidos]
  URI: include/validar.php

RECEIVED [status: 200, size: 27 bytes, time: 19ms]
{\"xjxrv\":false,\"xjxobj\":[]}

DONE [208ms]
                ";

                // 15. Muestro el error en JSON, junto 
                // con el debugOutput
                echo json_encode([
                    'ok' => false,
                    'msg' => 'Usuario o contraseña incorrectos.',
                    'debugOutput' => $fakeDebugOutput
                ]);
                exit;
            }
        } 
        
        else {
            // 16. Si no es POST, cargo la vista de 
            // login (HTML)
            require_once __DIR__ . '/../views/login/index.php';
        }
    }

    // 17. Método para cerrar sesión
    public function logout()
    {
        // 18. Inicio la sesión para poder destruirla 
        // correctamente
        session_start();
        session_destroy();
        // 19. Redirijo al login tras cerrar sesión
        header(
            "Location: ../../public/index.php?controller=Login&action=login"
        );
        exit;
    }
}
