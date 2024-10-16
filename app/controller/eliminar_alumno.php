<?php
require_once '../config/conexion.php';
session_start();

$id = $_POST['id'];

$eliminar = $conexion->prepare("DELETE FROM t_alumno WHERE id = :id");
$eliminar->bindParam(':id',$id);
$eliminar->execute();

if ($eliminar) {
    echo json_encode([1,'Alumno eliminado correctamente']);
} else {
    echo json_encode([0,'Alumno NO eliminado correctamente']);
}

?>