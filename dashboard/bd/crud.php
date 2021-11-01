<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$Becario = (isset($_POST['Becario'])) ? $_POST['Becario'] : '';
$Actividad = (isset($_POST['Actividad'])) ? $_POST['Actividad'] : '';
$Estado = (isset($_POST['Estado'])) ? $_POST['Estado'] : '';
$Fecha = (isset($_POST['Fecha'])) ? $_POST['Fecha'] : '';
$Hora_de_entrada = (isset($_POST['Hora_de_entrada'])) ? $_POST['Hora_de_entrada'] : '';
$Hora_de_salida = (isset($_POST['Hora_de_salida'])) ? $_POST['Hora_de_salida'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO becarios (Becario, Actividad, Estado, Fecha, Hora_de_entrada, Hora_de_salida) VALUES('$Becario', '$Actividad', '$Estado', '$Fecha', '$Hora_de_entrada', '$Hora_de_salida') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id, Becario, Actividad, Estado, Fecha, Hora_de_entrada, Hora_de_salida FROM becarios ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE becarios SET Becario='$Becario', Actividad='$Actividad', Estado='$Estado', Fecha='$Fecha', Hora_de_entrada='$Hora_de_entrada', Hora_de_salida='$Hora_de_salida' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, Becario, Actividad, Estado, Fecha, Hora_de_entrada, Hora_de_salida FROM becarios WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM becarios WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;    
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
