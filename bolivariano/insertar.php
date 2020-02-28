<?php
//si el campo cedula del formulario esta lleno

require_once("myconexion.php"); // IMPORTA EL ARCHIVO CON LA CONEXION A LA DB
        $conexion = conexion(); // CREA LA CONEXION

    if(isset($_POST['profesor'])){

            $sentence = $conexion->prepare("INSERT INTO 
                                            prestamo (profesor,producto,estado)
                                        VALUES 
                                            (:profesor, :producto, :estado)");
        
            $sentence->execute(array(":profesor"=>$_POST['profesor'], ":producto"=>$_POST['producto'],":estado"=>1 ));
            //$sentence->execute(array(":profesor"=>"ajja", ":producto"=>"hola" ));
       }
        
        
//Nota: esta seccion de codigo se ejecuta simepre
//selecciona todos los registros de la base de datos y crea una estructura xml a retornar


$sentence = $conexion->prepare("SELECT * from prestamo");    
    $sentence->execute();

$Return = "<personas>";

//recorre todo el arreglo de registros obtenido de la base de datos mediante la consulta
//y los agrega a la estructura xml

if($result=$sentence->fetchAll(PDO::FETCH_ASSOC)){
    foreach ($result as $data) {
        $Return .= "<persona>
                        <id>".$data ['id']."</id>
                        <productos>".$data ['producto']."</productos>
                        <docentes>".$data ['profesor']."</docentes>
                    </persona>";
        //$Return .= "<persona><cedula>".$data ['id']."</cedula></persona>";
        //$Return .= "Hola";
    }
} 

$Return .= "</personas>";

    print($Return);
?>

