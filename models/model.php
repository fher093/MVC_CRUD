<?php

class EnlacesPaginas{
     static function enlacesPaginasModelo($enlacesModel){
        if($enlacesModel== "Nosotros" ||
           $enlacesModel == "Servicios" ||
           $enlacesModel == "Contacto"){
                 
                $module="views/$enlacesModel.php";
           }else{
                $module="views/inicio.php";
           } 

           return $module;
    }
}

?>