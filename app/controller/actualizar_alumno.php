<?php 
require_once '../config/conexion.php';
session_start();

if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['year']) &&
    !empty($_POST['carrera']) && !empty($_POST['fecha'])) {

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $year = $_POST['year'];
    $carrera = $_POST['carrera'];
    $fecha = $_POST['fecha'];

    
    $actualizacion = $conexion->prepare("UPDATE t_alumno
    SET nombre = :nombre, apellido = :apellido, ingreso = :ingreso, carrera = :carrera, fecha_nacimiento = :fecha_nacimiento
    WHERE id = :id");

    $actualizacion->bindParam(':nombre',$nombre);
    $actualizacion->bindParam(':apellido',$apellido);
    $actualizacion->bindParam(':ingreso',$year);
    $actualizacion->bindParam(':carrera',$carrera);
    $actualizacion->bindParam(':fecha_nacimiento',$fecha);
    $actualizacion->bindParam(':id',$id);

    $actualizacion->execute();

    if ($actualizacion) {
        echo json_encode([1,"Alumno actualizado correctamente"]);
    } else {
        echo json_encode([0,"Alumno NO actualizado correctamente"]);
    }
    

    
} else {
    echo json_encode([0,"Datos incompletos"]);
}

?>