let editar;
let btnEditar = false;

const obtener_datos = () => {
    let tablaProducto = document.getElementById('tabla_productos');
    fetch("app/controller/obtener_datos.php")
    .then(respuesta => respuesta.json())
    .then((respuesta) => {
        let contenido = ''; 
        respuesta.map((dato) => {
        contenido += `
            <tr>
                <td>${dato['nombre']}</td>
                <td>${dato['apellido']}</td>
                <td>${dato['ingreso']}</td>
                <td>${dato['carrera']}</td>
                <td>${dato['fecha_nacimiento']}</td>
                <td>
                    <button class="btn btn-warning me-3 editar" data-btn="editar" data-id="${dato['id']}"
                     data-nombre="${dato['nombre']}"  data-apellido="${dato['apellido']}" data-ingreso="${dato['ingreso']}"
                     data-carrera="${dato['carrera']}" data-fecha="${dato['fecha_nacimiento']}">
                        Editar
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button class="btn btn-danger eliminar" data-btn="eliminar" data-id="${dato['id']}">
                        Eliminar
                        <i class="bi bi-trash3-fill"></i>
                    </button>
                </td>
            </tr>
            `; 
        });
        tablaProducto.innerHTML = contenido;
    });
}

const registrar_alumno = () => {
    let nombre = document.getElementById('nombre').value;
    let apellido = document.getElementById('apellido').value;
    let year = document.getElementById('year').value;
    let carrera = document.getElementById('carrera').value;
    let fecha = document.getElementById('fecha').value;
    let data = new FormData();
    data.append("nombre",nombre); 
    data.append("apellido",apellido); 
    data.append("year",year);
    data.append("carrera",carrera);
    data.append("fecha",fecha);
    fetch("app/controller/registro_alumno.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            await Swal.fire({icon: "success",title:`${respuesta[1]}`});
            obtener_datos();
            document.getElementById('nombre').value = '';
            document.getElementById('apellido').value = '';
            document.getElementById('year').value = '';
        } else if(respuesta[0] == 0) {
            Swal.fire({icon: "error",title:`${respuesta[1]}`});
        }
    })
}

const editar_alumno = () => {
    let nombre = document.getElementById('nombre').value;
    let apellido = document.getElementById('apellido').value;
    let year = document.getElementById('year').value;
    let carrera = document.getElementById('carrera').value;
    let fecha = document.getElementById('fecha').value;
    let data = new FormData();
    data.append('id',editar);
    data.append("nombre",nombre); 
    data.append("apellido",apellido); 
    data.append("year",year);
    data.append("carrera",carrera);
    data.append("fecha",fecha); 
    fetch(`app/controller/actualizar_alumno.php`,{
        method:"POST",
        body: data
    })
    .then(res => res.json())
    .then(async (res) => {
        if (res[0] == 1) {
            await Swal.fire({icon: "success",title:`${res[1]}`});
            obtener_datos();
            btnEditar = false;
            document.getElementById('nombre').value = '';
            document.getElementById('apellido').value = '';
            document.getElementById('year').value = '';
            document.getElementById('btn-registrar-producto').classList.remove('editar_producto');
            document.getElementById('btn-registrar-producto').classList.add('registrar_producto');
            document.getElementById('btn-registrar-producto').textContent = 'Registrar producto';
        } else if(res[0] == 0) {
            Swal.fire({icon: "error",title:`${res[1]}`});
        }
    })
} 

const eliminar_alumno = () => {
    let data = new FormData();
    data.append('id',editar);
    fetch('app/controller/eliminar_alumno.php', {
        method: 'POST',
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            await Swal.fire({icon: "success",title:`${respuesta[1]}`});
            obtener_datos();
        } else if(respuesta[0] == 0) {
            await Swal.fire({icon: "error",title:`${respuesta[1]}`});
        }
    })
}

document.addEventListener('DOMContentLoaded',() => {
    obtener_datos();
});

document.getElementById('btn-registrar-producto').addEventListener('click',() => {
    if (!btnEditar) {
        registrar_alumno();
    } else {
        editar_alumno();
    }
});

document.getElementById('tabla_productos').addEventListener('click', (e) => {
    if (e.target.classList.contains('editar')) {
        document.getElementById('nombre').value = e.target.dataset.nombre;
        document.getElementById('apellido').value = e.target.dataset.apellido;
        document.getElementById('year').value = e.target.dataset.ingreso;

        document.getElementById('btn-registrar-producto').classList.remove('registrar_producto');
        document.getElementById('btn-registrar-producto').classList.add('editar_producto');
        document.getElementById('btn-registrar-producto').textContent = 'Editar Producto';

        editar = e.target.dataset.id;
        btnEditar = true;
    }
    if (e.target.classList.contains('eliminar')) {
        Swal.fire({
            icon: "warning",
            text: "Estas seguro de eliminar este producto?",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar producto"
          }).then((result) => {
            if (result.isConfirmed) {
                editar = e.target.dataset.id;
                eliminar_alumno();
            }
          });
    }
});