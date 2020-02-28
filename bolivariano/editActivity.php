<?php

    header('Access-Control-Allow-Origin: *'); 
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    $json = file_get_contents('php://input');

    $params = json_decode($json);
    if ($params) { 
        require_once('myconexion.php');

        $conexion =conexion();

        if ($params->namefile == "" && $params->baseimg == "") { // validacion fro see if empty fiels, para ver si el suario quiere modificar la imagen, asi evitamos que la app deba de cargar los datos de la img x64 pesados
            $sentence=$conexion->prepare("UPDATE activities SET 
                                    title=:title, category=:category, description=:description, date=:date,time=:time, place=:place,lastmodifieddate=:lastmodifieddate                                
                                    WHERE id =$params->id ");
            $sentence->execute(array(":title"=>$params->title, ":category"=>$params->category,":description"=>$params->description,
                                    ":date"=>$params->date, ":time"=>$params->time, ":place"=>$params->place,
                                    ":lastmodifieddate"=>$params->lastModifiedDate));
        } else {
            $sentence=$conexion->prepare("UPDATE activities SET 
                                    title=:title, category=:category, description=:description, date=:date,time=:time, place=:place,lastmodifieddate=:lastmodifieddate, 
                                    nameimage=:nameimage, namefile=:namefile, baseimg=:baseimg
                                    WHERE id =$params->id ");
            $sentence->execute(array(":title"=>$params->title, ":category"=>$params->category,":description"=>$params->description,
                                    ":date"=>$params->date, ":time"=>$params->time, ":place"=>$params->place,
                                    ":lastmodifieddate"=>$params->lastModifiedDate, ":nameimage"=>$params->nameimg, ":namefile"=>$params->namefile,
                                    ":baseimg"=>$params->baseimg));
        }
                                                                                
        class Result {}

        // GENERA LOS DATOS DE RESPUESTA
        $response = new Result();
        $response->resultado = 'OK';
        $response->mensaje = 'EL USUARIO SE ACTUALIZO EXITOSAMENTE 2';
        
        header('Content-Type: application/json');
        
        echo json_encode($response); // MUESTRA EL JSON GENERADO                                
    }
    
?>