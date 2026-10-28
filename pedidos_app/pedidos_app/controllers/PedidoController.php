<?php
class PedidoController
{
    public function crear($datos)
    {
        $clienteId  = isset($datos['cliente_id'])  ? (int)$datos['cliente_id']  : 0;
        $productoId = isset($datos['producto_id']) ? (int)$datos['producto_id'] : 0;
        $cantidad   = isset($datos['cantidad'])    ? (int)$datos['cantidad']    : 0;

        if ($clienteId <= 0 || $productoId <= 0 || $cantidad <= 0) {
            Respuesta::json(['ok' => false, 'mensaje' => 'Datos incompletos o inválidos'], 400);
        }
        if (!ClienteModel::buscarPorId($clienteId)) {
            Respuesta::json(['ok' => false, 'mensaje' => 'El cliente no existe'], 404);
        }
        $producto = ProductoModel::buscarPorId($productoId);
        if (!$producto) {
            Respuesta::json(['ok' => false, 'mensaje' => 'El producto no existe'], 404);
        }

        $total = round($producto['precio'] * $cantidad, 2);
        $id = PedidoModel::crear($clienteId, $productoId, $cantidad, $total);

        Respuesta::json([
            'ok' => true,
            'mensaje' => 'Pedido registrado correctamente',
            'datos' => ['id' => $id, 'total' => $total]
        ], 201);
    }

    public function porCliente($clienteId)
    {
        $clienteId = (int)$clienteId;
        if ($clienteId <= 0 || !ClienteModel::buscarPorId($clienteId)) {
            Respuesta::json(['ok' => false, 'mensaje' => 'El cliente no existe'], 404);
        }
        Respuesta::json(['ok' => true, 'datos' => PedidoModel::porCliente($clienteId)]);
    }
}
