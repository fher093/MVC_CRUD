<?php
class ProductoModel
{
    public static function listar()
    {
        $pdo = Database::conectar();
        return $pdo->query("SELECT id, nombre, precio FROM productos ORDER BY nombre")->fetchAll();
    }

    public static function buscarPorId($id)
    {
        $pdo = Database::conectar();
        $st = $pdo->prepare("SELECT id, nombre, precio FROM productos WHERE id = :id");
        $st->execute([':id' => $id]);
        return $st->fetch();
    }
}
