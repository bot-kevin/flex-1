<?php
require_once("myconexion.php"); // IMPORTA EL ARCHIVO CON LA CONEXION A LA DB
$conexion = conexion(); // CREA LA CONEXION

if( isset($_POST['nombre']) ){
    $sentence = $conexion->prepare("SELECT cantidad from productos WHERE nombre like :nombre ");    
    $sentence->execute(array(":nombre"=>$_POST['nombre']));

    $Return = "<productos>";
    if($result=$sentence->fetchAll(PDO::FETCH_ASSOC)){
        foreach ($result as $data) {
            $Return .= "<producto>
                        <cantidad>".$data ['cantidad']."</cantidad>                               
                        </producto>";
                      
        }
    }     
    $Return .= "</productos>";

    print($Return);
}




/*$Return = "<productos>";

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

print($Return);*/

?>
