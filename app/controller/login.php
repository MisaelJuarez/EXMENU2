<?php
require_once '../config/conexion.php';
session_start();

if(isset($_POST['usuario']) && !empty($_POST['usuario']) && isset($_POST['pass']) && !empty($_POST['pass'])) {

    $usuario = $_POST['usuario'];
    $passw = $_POST['pass'];

    $consulta = $conexion->prepare("SELECT * FROM t_usuarios WHERE usuario = :usuario");
    $consulta->bindParam(':usuario',$usuario);
    $consulta->execute();
    $datos = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($datos) {
        if ($datos['pass'] == $passw) {
            
            if ($datos['rol'] == 'estudiante') {
                $alumno = $conexion->prepare("SELECT * FROM t_alumno WHERE nombre = :nombre");
                $alumno->bindParam(':nombre',$usuario);
                $alumno->execute();
                $datosAlumno = $alumno->fetch(PDO::FETCH_ASSOC);   

                if ($datosAlumno) {
                    $_SESSION['usuario'] = $datos;
                    echo json_encode([1,"Datos de acceso correctos","estudiante"]);
                } else {
                    echo json_encode([0,"El administrador aun no ingresa informacion tuya"]);
                }

            } else if ($datos['rol'] == 'administrador') {
                $_SESSION['usuario'] = $datos;
                echo json_encode([1,"Datos de acceso correctos","administrador"]);
            }

        } else {
                echo json_encode([0,"Error en credenciales de acceso"]);
            }
    } else {
        echo json_encode([0,"Informacion no localizada"]);
    }
} else {
    echo json_encode([0,"Tienes que llenar los datos en el formulario"]);
}


?>