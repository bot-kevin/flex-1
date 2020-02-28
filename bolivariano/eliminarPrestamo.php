<?php
//si el campo cedula del formulario esta lleno

require_once("myconexion.php"); // IMPORTA EL ARCHIVO CON LA CONEXION A LA DB
        $conexion = conexion(); // CREA LA CONEXION

    if(isset($_POST['profesor'])){

            $sentence = $conexion->prepare("DELETE FROM prestamo WHERE profesor = :profesor AND producto = :producto ");
        
            $sentence->execute(array(":profesor"=>$_POST['profesor'], ":producto"=>$_POST['producto']));
            //$sentence->execute(array(":profesor"=>"ajja", ":producto"=>"hola" ));
       }
        

?>

