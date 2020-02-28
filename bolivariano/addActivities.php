<?php

    header('Access-Control-Allow-Origin: *'); 
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    $json = file_get_contents('php://input'); // RECIBE EL JSON DE ANGULAR
    $params = json_decode($json); // DECODIFICA EL JSON Y LO GUARADA EN LA VARIABLE

    if($params){
        require_once("myconexion.php"); // IMPORTA EL ARCHIVO CON LA CONEXION A LA DB
        $conexion = conexion(); // CREA LA CONEXION

        $sentence = $conexion->prepare("INSERT INTO 
                                            $params->onecategory (title,category,description,date,time,place,createdateactivity,lastmodifieddate,nameimage,namefile,baseimg)
                                        VALUES 
                                            (:title,:category,:description,:date,:time,:place,:createdateactivity,:lastmodifieddate,:nameimage,:namefile,:baseimg)");
        
        $sentence->execute(array(":title"=>$params->title, ":category"=>$params->category, ":description"=>$params->description,
                                    ":date"=>$params->date,":time"=>$params->time,":place"=>$params->place,":createdateactivity"=>$params->createDate,
                                    ":lastmodifieddate"=>$params->lastModifiedDate,":nameimage"=>$params->nameimg,":namefile"=>$params->nombreArchivo,
                                    ":baseimg"=>$params->base64textString));

        class Result {}
        // GENERA LOS DATOS DE RESPUESTA
        $response = new Result();
        if ($sentence) { // IF SENTENCE IS TRUE
            $response->resultado = 'OK';
            $response->mensaje = 'SE REGISTRO EXITOSAMENTE';
        } else {
            $response->resultado = 'NO';
            $response->mensaje = 'OCURRIO UN ERROR INTENTE DE NUEVO';
        }
                       
        header('Content-Type: application/json');
    
        echo json_encode($response); // MUESTRA EL JSON GENERADO

    } else {echo "Error";}
?>