<?php
class ClienteModel
{
    public static function listar()
    {
        $pdo = Database::conectar();
        $sql = "SELECT id, cedula, apellido, nombre, telefono, direccion
                FROM clientes ORDER BY apellido, nombre";
        return $pdo->query($sql)->fetchAll();
    }

    public static function buscarPorCedula($cedula)
    {
        $pdo = Database::conectar();
        $st = $pdo->prepare("SELECT id, cedula, apellido, nombre, telefono, direccion
                             FROM clientes WHERE cedula = :cedula");
        $st->execute([':cedula' => $cedula]);
        return $st->fetch();
    }

    public static function buscarPorId($id)
    {
        $pdo = Database::conectar();
        $st = $pdo->prepare("SELECT id FROM clientes WHERE id = :id");
        $st->execute([':id' => $id]);
        return $st->fetch();
    }
}
