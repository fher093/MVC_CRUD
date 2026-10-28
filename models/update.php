<?php 

//primero la conexcion 
require __DIR__ . "/conexion.php"; 

//sentencia sql 
$cedula=$_GET["estcedula"];
$nombre=$_POST["estnombre"]; 
$apellido=$_POST["estapellido"]; 
$direccion=$_POST["estdireccion"]; 
$telefono=$_POST["esttelefono"]; 

$sql= "UPDATE estudiante SET 
estnombre='$nombre',
estapellido='$apellido',
estdireccion='$direccion',
esttelefono='$telefono'

WHERE estcedula='$cedula'"; 

//METODO DE COMPROBACION 
if($conn->query($sql)==true){
    echo json_encode(['success'=>'estudiante EDITADO correctamente']);
}else{
    echo json_encode(['success'=>'estudiante NO EDITADO']);
}



?>