<?php
// config/db.php

// 1. Declaro la clase Database para gestionar 
// la conexión a la base de datos
class Database {
    // 2. Defino la variable estática $host 
    // para especificar el servidor de la BD
    private static $host = "localhost";
    // 3. Guardo el nombre de la base de datos 
    // en la variable estática $dbname
    private static $dbname = "valoracion_stars";
    // 4. Especifico el usuario de la base de 
    // datos en la variable estática $username
    private static $username = "root";
    // 5. Esta variable estática almacena la 
    // contraseña del usuario de la BD
    private static $password = "";
    // 6. Mantengo una sola instancia de conexión 
    // (patrón singleton) en $conn
    private static $conn = null;

    // 7. La función connect() devuelve la 
    // conexión a la BD, creándola solo si no existe
    public static function connect() {
        // 8. Verifico si $conn ya tiene una conexión 
        // establecida
        if (self::$conn == null) {
            try {
                // 9. Creo un nuevo objeto PDO con 
                // los datos de conexión
                self::$conn = new PDO(
                    "mysql:host=" . self::$host . 
                    ";dbname=" . self::$dbname . ";charset=utf8",
                    self::$username,
                    self::$password
                );
                // 10. Configuro el modo de reporte 
                // de errores para lanzar excepciones
                self::$conn->setAttribute(
                    PDO::ATTR_ERRMODE, 
                    PDO::ERRMODE_EXCEPTION
                );
            } 
            
            catch (PDOException $e) {
                // 11. Si ocurre un error, detengo 
                // la ejecución y muestro un mensaje
                die("Error de conexión: " . $e->getMessage());
            }
        }
        // 12. Devuelvo la conexión ya creada o la 
        // recién creada
        return self::$conn;
    }
}
