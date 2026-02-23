// // Información del formulario
var cmp_nombre_cedula = document.getElementById('nombre');
var cmp_sigla = document.getElementById('sigla');
// Información para capturar los errores
var errornombre_cedula = document.getElementById('errornombre_cedula');
var errorsigla = document.getElementById('errorsigla');

errornombre_cedula.style.color = 'red';
errorsigla.style.color = 'red';

function initDocumento() {
    $('#guardarNuevoDocumento').click(function (evt) {
        evt.preventDefault();
        validarDocumento();
    });
}

function validarDocumento() {

    var mensajenombre_cedula = [];
    var mensajesigla = [];

    restriccion = 0;

    if (cmp_nombre_cedula.value === null || cmp_nombre_cedula.value === '') {
        restriccion++;
        mensajenombre_cedula.push('Debe digitar el nombre del documento.');
        cmp_nombre_cedula.focus();
    }else if (cmp_sigla.value === null || cmp_sigla.value === '') {
        restriccion++;
        mensajesigla.push('Debe digitar la sigla.');
        cmp_sigla.focus();
    } else {
        console.log("TODOS LOS CAMPOS ESTAN LLENOS");
    }

    // Verifica que todos los campos estén diligenciados
    if (restriccion < 1) {
        console.log("Vamos a registrar...");
        agregarDatosDocumento(cmp_nombre_cedula,cmp_sigla.value);
    } else {
        console.log("Debe continuar revisando por favor...");

        errornombre_cedula.innerHTML = mensajenombre_cedula;
        errorsigla.innerHTML = mensajesigla;
    }

}
// Función para cargar información en el modal
// function cargarDatosDocumento() {
//     $('#nombre').val("");
//     $('#sigla').val("");
// }
// Función para registrar productos
function agregarDatosDocumento() {
    nombre = $('#nombre').val();
    sigla = $('#sigla').val();

cadena = "nombre=" + nombre +
         "&sigla=" + sigla;

accion = "registrar";
mensaje_si = "Los datos  se han registrado correctamente.";
mensaje_no = "Error, NO se registró los datos.";

$.ajax({
type: "POST",
url: "../modelo/acciones-documento.php?accion=registrar",
data: cadena,
success: function (r) {
    console.log(r);
    if (r == 0) {
        alertify.error(mensaje_no);
    } else {
        alertify.success(mensaje_si);
        cargarTablaDocumento();
        //$('#tabla').load("../administrador/redConocimiento.php");
        // location.reload();
    }
}
});
}
// Función para cargar información  a modificar
function agregarFormDocumentos(datos) {
d = datos.split('||');
$('#id_tipo_documentou').val(d[0]);
$('#nombreu').val(d[1]);
$('#siglau').val(d[2]);
}
// Función para modificar 
function modificarDocumento() {
id_tipo_documento = $('#id_tipo_documentou').val();
nombre = $('#nombreu').val();
sigla = $('#siglau').val();

cadena = "id_tipo_documento=" + id_tipo_documento +
            "&nombre=" + nombre +
            "&sigla=" + sigla;

accion = "modificar";
mensaje_si = "los datos  se han modificado con exito";
mensaje_no = "Error de registro";

$.ajax({
type: "POST",
url: "../modelo/acciones-documento.php?accion=modificar",
data: cadena,
success: function (r) {
    console.log(r);
    if (r == 0) {
        alertify.error(mensaje_no);
    } else {
        alertify.success(mensaje_si);
        cargarTablaDocumento();
        // $('#tabla').load("../administrador/redConocimiento.php");
        //location.reload();
    }
}
});
}
// Función para cargar información de la vista
function cargarTablaDocumento() {
$.ajax({
type: "POST",
url: "../administrador/documento.php",
async: true,
success: function (respuesta) {
    //console.log(respuesta);
    $("#tablaDocumento").html("");
    $("#tablaDocumento").html(respuesta);
},
error: function (request, error) {
    alertify.success(error);
}
});
}
// Función apra confirmar la eliminación de un registro
function preguntarSiNoDocumento() {
id_tipo_documento = $('#id_tipo_documentou').val();
var opcion = confirm("¿Esta seguro de eliminar el registro?");
if (opcion == true) {
eliminardatosDocumento(id_tipo_documento);
} else {
alert("El proceso de eliminación del registro ha sido cancelado.");
}
}

function eliminardatosDocumento(id_tipo_documento) {
cadena = "id_tipo_documento=" + id_tipo_documento;

accion = "eliminar";
mensaje_si = "Los datos se han borrado correctamente.";
mensaje_no = "Error.. NO se eliminólos datos.";

$.ajax({
type: "POST",
url: "../modelo/acciones-documento.php?accion=eliminar",
data: cadena,
success: function (r) {
    console.log(r);
    if (r == 0) {
        alertify.error(mensaje_no);
    } else {
        alertify.success(mensaje_si);
        cargarTablaDocumento();
        // $('#tabla').load("../administrador/redConocimiento.php");
        // location.reload();
    }
}
});
}
