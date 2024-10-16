<?php
require_once '../config/conexion.php';
session_start();

if (isset($_POST['nombre']) && !empty($_POST['nombre']) && 
    isset($_POST['apellido']) && !empty($_POST['apellido']) && 
    isset($_POST['year']) && !empty($_POST['year']) && 
    isset($_POST['carrera']) && !empty($_POST['carrera']) && 
    isset($_POST['fecha']) && !empty($_POST['fecha'])) {
    
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $year = $_POST['year'];
    $carrera = $_POST['carrera'];
    $fecha = $_POST['fecha'];

    $insercion = $conexion->prepare("INSERT INTO t_alumno (nombre,apellido,ingreso,carrera,fecha_nacimiento) 
                                        VALUES(:nombre,:apellido,:ingreso,:carrera,:fecha_nacimiento)");

    $insercion->bindParam(':nombre',$nombre);
    $insercion->bindParam(':apellido',$apellido);
    $insercion->bindParam(':ingreso',$year);
    $insercion->bindParam(':carrera',$carrera);
    $insercion->bindParam(':fecha_nacimiento',$fecha);

    $insercion->execute();
    
    if ($insercion) {
        echo json_encode([1,"Alumno registrado"]);
    } else {
        echo json_encode([0,"Alumno NO registrado"]);
    }
   

} else {
    echo json_encode([0,"No puedes dejar campos vacios"]);
}

?>