<?php

require __DIR__ . "/conexion.php";

$cedula = $_REQUEST["estcedula"] ?? "";

$stmt = $conn->prepare("SELECT * FROM estudiante WHERE estcedula = ?");
$stmt->bind_param("s", $cedula);
$stmt->execute();

$respuesta = $stmt->get_result();
$resultado = array();

while ($fila = $respuesta->fetch_assoc()) {
    array_push($resultado, $fila);
}

echo json_encode($resultado);

?>