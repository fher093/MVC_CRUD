<?php 

require __DIR__ . "/conexion.php";
 
$sql="SELECT * FROM estudiante"; 

$respuesta = $conn->query($sql); 
$resultado = array(); 

if($respuesta->num_rows>0){
    while($fila=$respuesta->fetch_array()){
        array_push($resultado,$fila);
    }
}else{
    $resultado = "no hay estudiantes";
} 

print_r (json_encode($resultado)); //para transofmrar el array a json 


?>