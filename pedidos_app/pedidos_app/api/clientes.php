<?php
// GET /api/clientes.php                   -> lista todos los clientes
// GET /api/clientes.php?cedula=XXXXXXXXXX -> busca un cliente por cédula
require_once __DIR__ . '/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    Respuesta::json(['ok' => false, 'mensaje' => 'Método no permitido'], 405);
}

$controller = new ClienteController();
if (isset($_GET['cedula']) && $_GET['cedula'] !== '') {
    $controller->buscarPorCedula($_GET['cedula']);
} else {
    $controller->listar();
}
