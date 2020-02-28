<?php
    header('Access-Control-Allow-Origin: *'); 
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    
    require_once("myconexion.php"); // IMPORTA EL ARCHIVO CON LA CONEXION A LA DB
  
    // response the table query
    $json = file_get_contents('php://input'); // RECIBE EL JSON DE ANGULAR
    $params = json_decode($json); 


    $conexion = conexion(); // CREA LA CONEXION

    $sentence = $conexion->prepare("SELECT id,title,category,description,date,time,place,nameimage,namefile,baseimg FROM $params->table ORDER BY id DESC LIMIT 10");
    
    $sentence->execute();

    if($result=$sentence->fetchAll(PDO::FETCH_ASSOC)){
        foreach ($result as $data) {
            $vec ['id']= $data ['id'];
            $vec ['title']= $data ['title'];
            $vec ['category']= $data ['category'];
            $vec ['description']= $data ['description'];
            $vec ['date']= $data ['date'];
            $vec ['time']= $data ['time'];
            $vec ['place']= $data ['place'];
            $vec ['nameimg']= $data ['nameimage'];
            $vec ['namefile']= $data ['namefile'];
            $vec ['baseimg']=base64_encode( $data ['baseimg']);
            

            $datos []= $vec;
        }

        $json = json_encode($datos); // GENERA EL JSON CON LOS DATOS OBTENIDOS  
        echo $json; // MUESTRA EL JSON GENERADO

    }      
  //header('Content-Type: application/json');

?>