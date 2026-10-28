<?php
// POST /api/pedidos.php                -> registra un pedido (JSON)
// GET  /api/pedidos.php?cliente_id=ID  -> pedidos de un cliente con su detalle
require_once __DIR__ . '/bootstrap.php';

$controller = new PedidoController();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $datos = json_decode(file_get_contents('php://input'), true);
        if (!is_array($datos)) {
            Respuesta::json(['ok' => false, 'mensaje' => 'JSON inválido'], 400);
        }
        $controller->crear($datos);
        break;

    case 'GET':
        if (!isset($_GET['cliente_id'])) {
            Respuesta::json(['ok' => false, 'mensaje' => 'Falta cliente_id'], 400);
        }
        $controller->porCliente($_GET['cliente_id']);
        break;

    default:
        Respuesta::json(['ok' => false, 'mensaje' => 'Método no permitido'], 405);
}
