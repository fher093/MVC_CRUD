<?php  
 
 $servername="localhost"; 
 $username="root"; 
 $password="Fernando10032001"; 
 $database="cuartob"; 

 $conn=mysqli_connect($servername,$username,$password,$database); //para establecer la conexion en la base de datos (me devuelte bollenao true o false) 
//segunda forma de conexion
//$connection=new mysqli($servername,$username,$password,$database); 


 //verificacion de conexion a la base de datos 
 if(!$conn){
    echo "error en la conexion".mysqli_connect_error(); 
    //die "error en la conexion".mysqli_connect_error(); cierra lo conexion a la base de datos- por precaucion 
     
 }else{
    //echo "conexion exitosa";
 } 

  //cerrar la conexion para liberar recursos  
 //mysqli_close($conn);

?> 
