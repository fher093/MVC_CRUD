<?php
class ClienteController
{
    public function listar()
    {
        Respuesta::json(['ok' => true, 'datos' => ClienteModel::listar()]);
    }

    public function buscarPorCedula($cedula)
    {
        $cedula = trim($cedula);
        if (!preg_match('/^[0-9]{10}$/', $cedula)) {
            Respuesta::json(['ok' => false, 'mensaje' => 'La cédula debe tener 10 dígitos'], 400);
        }
        $cliente = ClienteModel::buscarPorCedula($cedula);
        if (!$cliente) {
            Respuesta::json(['ok' => false, 'mensaje' => 'No existe un cliente con esa cédula'], 404);
        }
        Respuesta::json(['ok' => true, 'datos' => [$cliente]]);
    }
}
