<?php 
 
 class controllerMVC{ 

    function getTemplate(){//para incluir el index el template
        include "views/template1.php";
    }

    function enlacesPaginasController(){
        if(isset($_GET["action"])){
             
            $enlacesController = $_GET["action"];
        } else{
            $enlacesController = "inicio.php";
        } 

        $respuesta=EnlacesPaginas::enlacesPaginasModelo($enlacesController); 
        include $respuesta;

    }
 }

?>