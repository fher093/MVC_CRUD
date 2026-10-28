<?php
class Database
{
    private static $host = 'localhost';
    private static $db   = 'ventas_db';
    private static $user = 'root';
    private static $pass = '';

    public static function conectar()
    {
        try {
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=utf8mb4";
            $pdo = new PDO($dsn, self::$user, self::$pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            Respuesta::json(['ok' => false, 'mensaje' => 'No se pudo conectar a la base de datos'], 500);
        }
    }
}
