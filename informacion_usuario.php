<?php
require_once("./app/config/dependencias.php");
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location: ./login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=CSS."bootstrap.min.css";?>">
    <link rel="stylesheet" href="<?=CSS."informacion_usuario.css";?>">
    <link rel="stylesheet" href="<?=ICONS."bootstrap-icons.css";?>">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <div class="row m-4 c-datos">
        <div class="d-flex justify-content-around align-items-center w-100">
            <h1 class="text-white m-0">
                Tu informacion personal
                <i class="bi bi-clipboard-data-fill"></i>
            </h1>
            <div>
                <button class="btn btn-danger" id="btn-cerrrar">
                    <i class="bi bi-box-arrow-left me-2"></i>
                    Cerrar sesión
                </button>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col">
                <div class="m-5 p-3 contenedor_usuario">
                    <div class="text-center">
                        <i class="bi bi-person-circle text-white"></i>
                    </div>
                    <div class="text-center">
                        <p class="text-white nombre_usuario">
                            <?= $_SESSION['usuario']['usuario'];?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <form action="" class="m-5 p-4">
                    <div class="form-floating w-100 mb-3">
                        <input class="form-control" type="text" aria-label="default input example" name="nombre" id="nombre">
                        <label for="nombre">nombre</label>
                    </div>                        

                    <div class="form-floating w-100 mb-3">
                        <input class="form-control" type="text" aria-label="default input example" name="apellido" id="apellido">
                        <label for="nombre">apellido</label>
                    </div> 

                    <div class="form-floating w-100 mb-3">
                        <input class="form-control" type="text" aria-label="default input example" name="year" id="year">
                        <label for="nombre">año ingreso</label>
                    </div> 

                    <div class="form-floating w-100 mb-4">
                        <input class="form-control" type="text" aria-label="default input example" name="carrera" id="carrera">
                        <label for="nombre">Carrera</label>
                    </div>

                    <div class="form-floating w-100 mb-4">
                        <input class="form-control" type="text" aria-label="default input example" name="fecha" id="fecha">
                        <label for="nombre">Fecha nacimiento</label>
                    </div> 
                </form>
            </div>
        </div>
    </div>
    <script src="./public/js/alerts.js"></script>
    <script src="./public/js/informacion_usuario.js"></script>
</body>
</html>