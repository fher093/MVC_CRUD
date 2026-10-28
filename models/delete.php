<?php 

//primero la conexcion 
require __DIR__ . "/conexion.php"; 

//sentencia sql 
$cedula=$_POST["txtcedula"];
$sql= "DELETE FROM estudiante WHERE estcedula='$cedula'"; 

//METODO DE COMPROBACION 
if($conn->query($sql)==true){
    echo json_encode(['success'=>'estudiante ELIMINADO correctamente']);
}else{
    echo json_encode(['success'=>'estudiante NO SE ELIMINO']);
}



?>