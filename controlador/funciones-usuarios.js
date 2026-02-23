// -------- VARIABLES --------
var cmp_tipo_documento   = document.getElementById('tipo_documento');
var cmp_numero_documento = document.getElementById('numero_documento');
var cmp_nombre           = document.getElementById('nombre');
var cmp_usuario          = document.getElementById('usuario');
var cmp_contrasena       = document.getElementById('contrasena');
var cmp_email            = document.getElementById('email');
var cmp_telefono         = document.getElementById('telefono');
var cmp_estado           = document.getElementById('estado');
var cmp_rol              = document.getElementById('rol_id');

// -------- SPAN DE ERRORES --------
var errortipo_documento      = document.getElementById('errortipo_documento');
var errornumero_documento    = document.getElementById('errornumero_documento');
var errornombre              = document.getElementById('errornombre');
var errorusuario             = document.getElementById('errorusuario');
var errorcontrasena          = document.getElementById('errorcontrasena');
var erroremail               = document.getElementById('erroremail');
var errortelefono            = document.getElementById('errortelefono');
var errorestado              = document.getElementById('errorestado');
var errorrol                 = document.getElementById('errorrol');

// Colorear errores en rojo
[
    errortipo_documento, errornumero_documento, errornombre, errorusuario,
    errorcontrasena, erroremail, errortelefono, errorestado, errorrol
].forEach(e => e.style.color = 'red');


// -------- INICIALIZACIÓN --------
function initUsuario() {
    $('#agregarNuevoUsuario').click(function (evt) {
        evt.preventDefault();
        validarUsuario();
    });
}


// -------- VALIDACIONES --------
function validarUsuario() {

    var restriccion = 0;

    // Limpia errores
    errortipo_documento.innerHTML   = "";
    errornumero_documento.innerHTML = "";
    errornombre.innerHTML           = "";
    errorusuario.innerHTML          = "";
    errorcontrasena.innerHTML       = "";
    erroremail.innerHTML            = "";
    errortelefono.innerHTML         = "";
    errorestado.innerHTML           = "";
    errorrol.innerHTML           = "";

    // Validar campos

    if (!cmp_tipo_documento.value) {
        restriccion++;
        errortipo_documento.innerHTML = "Debe seleccionar el tipo de documento.";
        cmp_tipo_documento.focus();
    }

    if (!cmp_numero_documento.value) {
        restriccion++;
        errornumero_documento.innerHTML = "Debe ingresar el número de documento.";
    }

    if (!cmp_nombre.value) {
        restriccion++;
        errornombre.innerHTML = "Debe ingresar el nombre.";
    }

    if (!cmp_usuario.value) {
        restriccion++;
        errorusuario.innerHTML = "Debe ingresar el usuario.";
    }

    if (!cmp_contrasena.value) {
        restriccion++;
        errorcontrasena.innerHTML = "Debe ingresar la contraseña.";
    }

    if (!cmp_email.value) {
        restriccion++;
        erroremail.innerHTML = "Debe ingresar el correo electrónico.";
    }

    if (!cmp_telefono.value) {
        restriccion++;
        errortelefono.innerHTML = "Debe ingresar el teléfono.";
    }

    if (!cmp_estado.value) {
        restriccion++;
        errorestado.innerHTML = "Debe seleccionar el estado.";
    }

    if (!cmp_rol.value) {
        restriccion++;
        errorrol.innerHTML = "Debe seleccionar el rol.";
    }

    // -------- ENVÍO --------
    if (restriccion < 1) {
        console.log("Vamos a registrar usuario...");

        agregardatosUsuario(
            cmp_tipo_documento.value,
            cmp_numero_documento.value,
            cmp_nombre.value,
            cmp_usuario.value,
            cmp_contrasena.value,
            cmp_email.value,
            cmp_telefono.value,
            cmp_estado.value,
            cmp_rol.value
        );

    } else {
        console.log("Debe revisar los errores por favor...");
    }
}


//función para registrar la información
function agregardatosUsuario() {
    tipo_documento = $('#tipo_documento').val();
    numero_documento = $('#numero_documento').val();
    nombre = $('#nombre').val();
    usuario = $('#usuario').val();
    contrasena = $('#contrasena').val();
    email = $('#email').val();
    telefono = $('#telefono').val();
    estado = $('#estado').val();
    rol_id = $('#rol_id').val();

    cadena = "tipo_documento=" + tipo_documento +
                "&numero_documento=" + numero_documento +
                "&nombre=" + nombre +
                "&usuario=" + usuario +
                "&contrasena=" + contrasena +
                "&email=" + email +
                "&telefono=" + telefono +
                "&estado=" + estado +
                "&rol_id=" + rol_id;
             
    accion = "registrar";
    mensaje_si = "El usuario registrado correctamente.";
    mensaje_no = "Error, NO se registró el usuario.";
   
    $.ajax({
        type: "POST",
        url: "../modelo/accionesUsuario.php?accion=registrar",
        data: cadena,
        success: function(r) {
            console.log(r);
            if (r == 0) {
                alertify.error(mensaje_no);
            } else {
                alertify.success(mensaje_si);
                cargarTablaUsuario(); 
                location.reload();
            }
        }
    });
}
// Función para vaciar el modal

// Función para cargar información  a modificar
function agregarformUsuario(datos) {
    d = datos.split('||');
    $('#codigou').val(d[0]);
    $('#tipo_documentou').val(d[1]);
    $('#numero_documentou').val(d[2]);
    $('#nombreu').val(d[3]);
    $('#usuariou').val(d[4]);
    $('#contrasenau').val(d[5]);
    $('#emailu').val(d[6]);
    $('#telefonou').val(d[7]);
    $('#estadou').val(d[8]);
    $('#rol_idu').val(d[9]);
}
// Función para modificar 
function modificarUsuario() {
    codigo = $('#codigou').val();
    tipo_documento = $('#tipo_documentou').val();
    numero_documento = $('#numero_documentou').val();
    nombre = $('#nombreu').val();
    usuario = $('#usuariou').val();
    contrasena = $('#contrasenau').val();
    email = $('#emailu').val();
    telefono = $('#telefonou').val();
    estado = $('#estadou').val();
    rol_id = $('#rol_idu').val();

    cadena = "codigo=" + codigo +
            "&tipo_documento=" + tipo_documento +
            "&numero_documento=" + numero_documento +
            "&nombre=" + nombre +
            "&usuario=" + usuario +
            "&contrasena=" + contrasena +
            "&email=" + email +
            "&telefono=" + telefono +
            "&estado=" + estado +
            "&rol_id=" + rol_id;
            
            accion = "modificar";
            mensaje_si = "El usuario modificado con exito";
            mensaje_no = "Error de registro";
    
        $.ajax({
            type: "POST",
            url: "../modelo/accionesUsuario.php?accion=modificar",
            data: cadena,
            success: function(r) {
                console.log(r);
                if (r == 0) {
                    alertify.error(mensaje_no);
                } else {
                    alertify.success(mensaje_si);
                    cargarTablaUsuario();
                }
            }
        });
    }
    // Función para cargar información de la vista
function cargarTablaUsuario() {
    $.ajax({
        type: "POST",
        url: "../administrador/usuarios.php",
        async: true,
        success: function(respuesta) {
           // console.log(respuesta);
            $("#tablaUsuarios").html("");
            $("#tablaUsuarios").html(respuesta);
        },
        error: function(request, error) {
            alertify.success(error);
        }
    });
}

// Función apra confirmar la eliminación de un registro
function preguntarSiNoUsuario() {
    codigo = $("#codigou").val();
    var opcion = confirm("¿Esta seguro de eliminar el registro?");
    if (opcion == true) {
        eliminarDatos(codigo);
    } else {
      alert("El proceso de eliminación del registro ha sido cancelado.");
    }
  }

function eliminarDatos(codigo) {
    cadena = "codigo=" + codigo;
    accion = "eliminar";
    mensaje_si = "Los datos de los galpñon se han borrado correctamente.";
    mensaje_no = "Error.. NO se eliminólos datos.";
        $.ajax({
            type: "POST",
            url: "../modelo/accionesUsuario.php?accion=eliminar",
            data: cadena,
            success: function(r) {
                console.log(r);
                if (r == 0) {
                    alertify.error(mensaje_no);
                } else {
                    alertify.success(mensaje_si);
                    cargarTablaUsuario();
                }
            }
        });
    }