const cerrar_session = () => {
    fetch("app/controller/cerrar_sesion.php")
    .then(respuesta => respuesta.json())
    .then(async (respuesta) => {
        await Swal.fire({icon: "success",title:`${respuesta[1]}`});
        window.location = "login.php";
    });
}

const obtener_informacion = () => {
    fetch("app/controller/informacion_usuario.php")
    .then(respuesta => respuesta.json())
    .then((respuesta) => {
        document.getElementById('nombre').value = respuesta['nombre'];
        document.getElementById('apellido').value = respuesta['apellido'];
        document.getElementById('year').value = respuesta['ingreso'];
        document.getElementById('carrera').value = respuesta['carrera'];
        document.getElementById('fecha').value = respuesta['fecha_nacimiento'];
    });
}


document.addEventListener('DOMContentLoaded',() => {
    obtener_informacion();
});

document.getElementById('btn-cerrrar').addEventListener('click',() => {
    cerrar_session()
});

