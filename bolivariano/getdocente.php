<?php
require_once("myconexion.php"); // IMPORTA EL ARCHIVO CON LA CONEXION A LA DB
$conexion = conexion(); // CREA LA CONEXION

$sentence = $conexion->prepare("SELECT * from docente");    
$sentence->execute();



$Return = "<productos>";

if($result=$sentence->fetchAll(PDO::FETCH_ASSOC)){
foreach ($result as $data) {
    $Return .= "<producto>    
                <cedula>".$data ['nombredeldocente']."</cedula>                
                </producto>";
    //$Return .= "<persona><cedula>".$data ['id']."</cedula></persona>";
    //$Return .= "Hola";
}
} 

$Return .= "</productos>";

print($Return);

?>