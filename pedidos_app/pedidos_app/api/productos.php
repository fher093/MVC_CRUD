<?php
// GET /api/productos.php -> lista los productos predefinidos
require_once __DIR__ . '/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    Respuesta::json(['ok' => false, 'mensaje' => 'Método no permitido'], 405);
}

(new ProductoController())->listar();
