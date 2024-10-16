//URL: dirreccion externa
//URI: direccion interna
const validar_usuario = () => {
    let usuario = document.getElementById('usuario').value;
    let pass = document.getElementById('pass').value;
    let data = new FormData();
    data.append("usuario",usuario); 
    data.append("pass",pass); 
    fetch("app/controller/login.php",{
        method:"POST",
        body: data
    }).then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            await Swal.fire({icon: "success",title:`${respuesta[1]}`});
            if (respuesta[2] == "estudiante") {
                window.location="informacion_usuario.php";
            } else if (respuesta[2] == "administrador") {
                window.location="index.php";
            }
        }else {
            Swal.fire({icon: "error",title:`${respuesta[1]}`});
        }
    });
}

const registrar_usuario = () => {
    let usuario = document.getElementById('usuario').value;
    let pass = document.getElementById('pass').value;
    let rol = document.getElementById('rol').value;
    let data = new FormData();
    data.append("usuario",usuario); //añade datos al formulario
    data.append("pass",pass); //añade datos al formulario
    data.append("rol",rol); //añade datos al formulario
    fetch("app/controller/registro.php",{
        method:"POST",
        body: data
    }).then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            await Swal.fire({icon: "success",title:`${respuesta[1]}`});
            window.location="login.php";
        }else {
            Swal.fire({icon: "error",title:`${respuesta[1]}`});
        }
    });
}

window.addEventListener('DOMContentLoaded',() => {
    //LOGIN
    if (document.getElementById('btn-saludar')) {
        document.getElementById('btn-saludar').addEventListener('click',() => {
            validar_usuario();
        });                
    }
    //REGISTRO
    if (document.getElementById('btn-registrar')) {
        document.getElementById('btn-registrar').addEventListener('click',() => {
            registrar_usuario();
        });        
    }
});

