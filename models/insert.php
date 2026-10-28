<?php 
 
include __DIR__ ."/conexion.php";   

$cedula=$_POST["estcedula"];
$nombre=$_POST["estnombre"];
$apellido=$_POST["estapellido"];
$direccion=$_POST["estdireccion"];
$telefono=$_POST["esttelefono"];


$sql = "INSERT INTO estudiante values
(   '$cedula',
    '$nombre',
    '$apellido',
    '$direccion',
    '$telefono' 
)";

if($conn->query($sql)==true){
    echo json_encode("estudiante agregado correctamente");
}else{
    echo json_encode("estudiante NO agregado");
}


?>