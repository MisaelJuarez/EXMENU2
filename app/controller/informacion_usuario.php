<?php
session_start();
require_once '../config/conexion.php';

$consulta = $conexion->prepare("SELECT * FROM t_alumno WHERE nombre = :nombre");
$consulta->bindParam(':nombre',$_SESSION['usuario']['usuario']);
$consulta->execute();

$datos = $consulta->fetch(PDO::FETCH_ASSOC);

echo json_encode($datos);
?>