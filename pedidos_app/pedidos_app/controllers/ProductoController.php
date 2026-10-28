<?php
class ProductoController
{
    public function listar()
    {
        Respuesta::json(['ok' => true, 'datos' => ProductoModel::listar()]);
    }
}
