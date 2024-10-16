<?php
require_once "../config/conexion.php";
session_start();


if (isset($_POST['usuario']) && !empty($_POST['usuario']) && 
    isset($_POST['pass']) && !empty($_POST['pass']) &&
    isset($_POST['rol']) && !empty($_POST['rol'])) {

    if(is_numeric($_POST['usuario'])) {
        echo json_encode([0,"No puedes agregar numeros en el input nombre"]);
    } else {

        $usuario = $_POST['usuario'];
        $passw = $_POST['pass'];
        $rol = $_POST['rol'];

        $insercion = $conexion->prepare("INSERT INTO t_usuarios (usuario,pass,rol) 
                                        VALUES(:usuario,:pass,:rol)");
        
        $insercion->bindParam(':usuario',$usuario);
        $insercion->bindParam(':pass',$passw);
        $insercion->bindParam(':rol',$rol);

        $insercion->execute();

        if ($insercion) {
            echo json_encode([1,"Usuario registrado correctamente"]);
        } else {
            echo json_encode([0,"Usuario NO registrado"]);
        }
    }
    
} else {
    echo json_encode([0,"No puedes dejar campos vacios"]);
}




?>