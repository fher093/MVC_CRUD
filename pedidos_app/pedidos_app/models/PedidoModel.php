<?php
class PedidoModel
{
    public static function crear($clienteId, $productoId, $cantidad, $total)
    {
        $pdo = Database::conectar();
        $st = $pdo->prepare("INSERT INTO pedidos (cliente_id, producto_id, cantidad, total)
                             VALUES (:c, :p, :cant, :total)");
        $st->execute([
            ':c'     => $clienteId,
            ':p'     => $productoId,
            ':cant'  => $cantidad,
            ':total' => $total
        ]);
        return $pdo->lastInsertId();
    }

    public static function porCliente($clienteId)
    {
        $pdo = Database::conectar();
        $st = $pdo->prepare("SELECT pe.id, pr.nombre AS producto, pr.precio,
                                    pe.cantidad, pe.total, pe.fecha
                             FROM pedidos pe
                             INNER JOIN productos pr ON pr.id = pe.producto_id
                             WHERE pe.cliente_id = :c
                             ORDER BY pe.fecha DESC, pe.id DESC");
        $st->execute([':c' => $clienteId]);
        return $st->fetchAll();
    }
}
