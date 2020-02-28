<?php
require_once("myconexion.php"); // IMPORTA EL ARCHIVO CON LA CONEXION A LA DB
$conexion = conexion(); // CREA LA CONEXION

$sentence = $conexion->prepare("SELECT * from productos WHERE cantidad >=1");    
$sentence->execute();



$Return = "<productos>";

if($result=$sentence->fetchAll(PDO::FETCH_ASSOC)){
foreach ($result as $data) {
    $Return .= "<producto>
                <id>".$data ['id']."</id>
                <nombre>".$data ['nombre']."</nombre>
                <descripcion>".$data ['description']."</descripcion>

                </producto>";
    //$Return .= "<persona><cedula>".$data ['id']."</cedula></persona>";
    //$Return .= "Hola";
}
} 

$Return .= "</productos>";

print($Return);

?>