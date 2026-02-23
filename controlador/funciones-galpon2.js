// -------- VARIABLES --------
var cmp_codigo_orions2      = document.getElementById('codigo_orions');
var cmp_cantidad_pollo2     = document.getElementById('cantidad_pollo');
var cmp_precio_pollo2      = document.getElementById('precio_pollo');
var cmp_color2              = document.getElementById('color');
var cmp_fayido2             = document.getElementById('fayido');
var cmp_tipo_alimento2      = document.getElementById('tipo_alimento');
var cmp_cantidad2           = document.getElementById('cantidad');
var cmp_precio_alimento2    = document.getElementById('precio_alimento');
var cmp_fecha_inicio2       = document.getElementById('fecha_inicio');
var cmp_fecha_fin2          = document.getElementById('fecha_fin');
var cmp_descripcion2        = document.getElementById('descripcion');
var cmp_alimento_inicio2    = document.getElementById('alimento_inicio');
var cmp_precio_inicio2      = document.getElementById('precio_inicio');
var cmp_alimento_preinicio2 = document.getElementById('alimento_preinicio');
var cmp_precio_preinicio2   = document.getElementById('precio_preinicio');

// -------- SPAN DE ERRORES --------
var errorcodigo_orions2      = document.getElementById('errorcodigo_orions2');
var errorcantidad_pollo2     = document.getElementById('errorcantidad_pollo2');
var errorprecio_pollo2      = document.getElementById('errorprecio_pollo2');
var errorcolor2              = document.getElementById('errorcolor2');
var errorfayido2             = document.getElementById('errorfayido2');
var errortipo_alimento2      = document.getElementById('errortipo_alimento2');
var errorcantidad2           = document.getElementById('errorcantidad2');
var errorprecio_alimento2    = document.getElementById('errorprecio_alimento2');
var errorfecha_inicio2       = document.getElementById('errorfecha_inicio2');
var errorfecha_fin2          = document.getElementById('errorfecha_fin2');
var errordescripcion2        = document.getElementById('errordescripcion2');
var erroralimento_inicio2    = document.getElementById('errorprecio_inicio2');
var errorprecio_inicio2      = document.getElementById('erroralimento_inicio2');
var erroralimento_preinicio2 = document.getElementById('erroralimento_preinicio2');
var errorprecio_preinicio2   = document.getElementById('errorprecio_preinicio2');

// color rojo para todos
[
    errorcodigo_orions2, errorcantidad_pollo2, errorprecio_pollo2, errorcolor2, errorfayido2,
    errortipo_alimento2, errorcantidad2, errorprecio_alimento2, errorfecha_inicio2,
    errorfecha_fin2, errordescripcion2,errorprecio_inicio2, erroralimento_inicio2, erroralimento_preinicio2, errorprecio_preinicio2
].forEach(e => e.style.color = 'red');


function initgalpon2() {
    $('#guardarNuevoGalpon2').click(function (evt) {
        evt.preventDefault();
        validargalpon2();
    });
}

function validargalpon2() {

    var restriccion = 0;

    // -------- LIMPIAR ERRORES --------
    errorcodigo_orions2.innerHTML      = "";
    errorcantidad_pollo2.innerHTML     = "";
    errorprecio_pollo2.innerHTML       = "";
    errorcolor2.innerHTML              = "";
    errorfayido2.innerHTML             = "";
    errortipo_alimento2.innerHTML      = "";
    errorcantidad2.innerHTML           = "";
    errorprecio_alimento2.innerHTML    = "";
    errorfecha_inicio2.innerHTML       = "";
    errorfecha_fin2.innerHTML          = "";
    errordescripcion2.innerHTML        = "";
    erroralimento_inicio2.innerHTML    = "";
    errorprecio_inicio2.innerHTML      = "";
    erroralimento_preinicio2.innerHTML = "";
    errorprecio_preinicio2.innerHTML   = "";

    // -------- VALIDACIONES --------

    if (!cmp_codigo_orions2.value) {
        restriccion++;
        errorcodigo_orions2.innerHTML = "Debe seleccionar el código Orions.";
        errorcantidad_pollo.classList.add('activo');
        cmp_codigo_orions.focus();
    }

    if (!cmp_cantidad_pollo2.value) {
        restriccion++;
        errorcantidad_pollo2.innerHTML = "Debe ingresar la cantidad de pollos.";
    }

    if (!cmp_precio_pollo2.value) {
        restriccion++;
        errorprecio_pollo2.innerHTML = "Debe ingresar el precio del pollo.";
    }

    if (!cmp_color2.value) {
        restriccion++;
        errorcolor2.innerHTML = "Debe ingresar el color.";
    }

    if (!cmp_fayido2.value) {
        restriccion++;
        errorfayido2.innerHTML = "Debe ingresar los fayidos.";
    }

    if (!cmp_tipo_alimento2.value) {
        restriccion++;
        errortipo_alimento2.innerHTML = "Debe seleccionar el tipo de alimento.";
    }

    if (!cmp_cantidad2.value) {
        restriccion++;
        errorcantidad2.innerHTML = "Debe ingresar la cantidad de alimento.";
    }

    if (!cmp_precio_alimento2.value) {
        restriccion++;
        errorprecio_alimento2.innerHTML = "Debe ingresar el precio del alimento.";
    }

    if (!cmp_fecha_inicio2.value) {
        restriccion++;
        errorfecha_inicio2.innerHTML = "Debe ingresar la fecha de inicio.";
    }

    if (!cmp_fecha_fin2.value) {
        restriccion++;
        errorfecha_fin2.innerHTML = "Debe ingresar la fecha de fin.";
    }

    if (!cmp_descripcion2.value) {
        restriccion++;
        errordescripcion2.innerHTML = "Debe ingresar una descripción.";
    }

    if (!cmp_alimento_inicio2.value) {
      restriccion++;
      erroralimento_inicio2.innerHTML = "Debe ingresar el alimento de inicio.";
  }

  if (!cmp_precio_inicio2.value) {
    restriccion++;
    errorprecio_inicio2.innerHTML = "Debe ingresar el precio del alimento de inicio.";
  }
  
  if (!cmp_alimento_preinicio2.value) {
    restriccion++;
    erroralimento_preinicio2.innerHTML = "Debe ingresar el precio del alimento de crecimiento.";
  }

  if (!cmp_precio_preinicio2.value) {
    restriccion++;
    errorprecio_preinicio2.innerHTML = "Debe ingresar el precio del alimento de crecimiento.";
  }

    // -------- ENVÍO --------
    if (restriccion < 1) {
        console.log("Vamos a registrar los materiales...");
        agregarDatosGalpon2(
            cmp_codigo_orions2.value,
            cmp_cantidad_pollo2.value,
            cmp_precio_pollo2.value,
            cmp_color2.value,
            cmp_fayido2.value,
            cmp_tipo_alimento2.value,
            cmp_cantidad2.value,
            cmp_precio_alimento2.value,
            cmp_fecha_inicio2.value,
            cmp_fecha_fin2.value,
            cmp_descripcion2.value,
            cmp_alimento_inicio2.value,
            cmp_precio_inicio2.value,
            cmp_alimento_preinicio2.value,
            cmp_precio_preinicio2.value
        );
    } else {
        console.log("Debe continuar revisando por favor...");
    }
}


// Función para registrar
function agregarDatosGalpon2() {
  codigo_orions = $("#codigo_orions").val();
  cantidad_pollo = $("#cantidad_pollo").val();
  precio_pollo = $("#precio_pollo").val();
  color = $("#color").val();
  fayido = $("#fayido").val();
  tipo_alimento = $("#tipo_alimento").val();
  cantidad = $("#cantidad").val();
  precio_alimento = $("#precio_alimento").val();
  fecha_inicio = $("#fecha_inicio").val();
  fecha_fin = $("#fecha_fin").val();
  descripcion = $("#descripcion").val();
  alimento_inicio = $("#alimento_inicio").val();
  precio_inicio   = $("#precio_inicio").val();
  alimento_preinicio = $("#alimento_preinicio").val();
  precio_preinicio   = $("#precio_preinicio").val();

  cadena =
    "&descripcion=" +
    descripcion +
    "&tipo_alimento=" +
    tipo_alimento +
    "&fayido=" +
    fayido +
    "&codigo_orions=" +
    codigo_orions +
    "&fecha_inicio=" +
    fecha_inicio +
    "&fecha_fin=" +
    fecha_fin +
    "&color=" +
    color +
    "&cantidad=" +
    cantidad +
    "&cantidad_pollo=" +
    cantidad_pollo +
    "&precio_pollo=" +
    precio_pollo +
    "&precio_alimento=" +
    precio_alimento +
    "&alimento_inicio=" +
    alimento_inicio +
    "&precio_inicio=" +
    precio_inicio +
    "&alimento_preinicio=" +
    alimento_preinicio +
    "&precio_preinicio=" +
    precio_preinicio;
    
  accion = "registrar";
  mensaje_si = "Los datos se han registrado correctamente.";
  mensaje_no = "Error, NO se registró los datos.";
    
  $.ajax({
    type: "POST",
    url: "../modelo/acciones-galpon2.php?accion=registrar",
    data: cadena,
    success: function (r) {
      console.log(r);
      if (r == 0) {
        alertify.error(mensaje_no);
      } else {
        alertify.success(mensaje_si);
        location.reload();
      }
    },
  });
 
}
// Función para cargar información  a modificar
function agregarFormGalpon2(datos) {
  d = datos.split("||");
  $("#codigou").val(d[0]);
  $("#codigo_orionsu").val(d[1]);
  $("#cantidad_pollou").val(d[2]);
  $("#precio_pollou").val(d[3]);
  $("#coloru").val(d[4]);
  $("#fayidou").val(d[5]);
  $("#tipo_alimentou").val(d[6]);
  $("#cantidadu").val(d[7]);
  $("#precio_alimentou").val(d[8]);
  $("#fecha_iniciou").val(d[9]);
  $("#fecha_finu").val(d[10]);
  $("#descripcionu").val(d[11]);
  $("#alimento_iniciou").val(d[12]);
  $("#precio_iniciou").val(d[13]);
  $("#alimento_preiniciou").val(d[14]);
  $("#precio_preiniciou").val(d[15]);
}

// Función para modificar
function modificarGalpon2() {
  codigo = $("#codigou").val();
  codigo_orions = $("#codigo_orionsu").val();
  cantidad_pollo = $("#cantidad_pollou").val();
  precio_pollo = $("#precio_pollou").val();
  color = $("#coloru").val();
  fayido = $("#fayidou").val();
  tipo_alimento = $("#tipo_alimentou").val();
  cantidad = $("#cantidadu").val();
  precio_alimento = $("#precio_alimentou").val();
  fecha_inicio = $("#fecha_iniciou").val();
  fecha_fin = $("#fecha_finu").val();
  descripcion = $("#descripcionu").val();
  alimento_inicio = $("#alimento_iniciou").val();
  precio_inicio = $("#precio_iniciou").val();
  alimento_preinicio = $("#alimento_preiniciou").val();
  precio_preinicio = $("#precio_preiniciou").val();


  cadena =
  "codigo=" +
  codigo +
  "&codigo_orions=" +
  codigo_orions +
  "&descripcion=" +
  descripcion +
  "&tipo_alimento=" +
  tipo_alimento +
  "&fayido=" +
  fayido +
  "&color=" +
  color +
  "&fecha_inicio=" +
  fecha_inicio +
  "&fecha_fin=" +
  fecha_fin +
  "&cantidad=" +
  cantidad +
  "&cantidad_pollo=" +
  cantidad_pollo +
 "&precio_pollo=" +
  precio_pollo +
  "&precio_alimento=" +
  precio_alimento +
  "&alimento_inicio=" +
  alimento_inicio +
  "&precio_inicio=" +
  precio_inicio +
  "&alimento_preinicio=" +
  alimento_preinicio +
  "&precio_preinicio=" +
  precio_preinicio;


  accion = "modificar";
  mensaje_si = "los datos del almacen se han modificado con exito";
  mensaje_no = "Error de registro";

  $.ajax({
    type: "POST",
    url: "../modelo/acciones-galpon2.php?accion=modificar",
    data: cadena,
    success: function (r) {
      console.log(r);
      if (r == 0) {
        alertify.error(mensaje_no);
      } else {
        alertify.success(mensaje_si);
        cargarTablaGalpon2();
      }
    },
  });
}
// Función para cargar información de la vista
function cargarTablaGalpon2() {
  $.ajax({
    type: "POST",
    url: "../administrador/galpon2.php",
    async: true,
    success: function (respuesta) {
      //console.log(respuesta);
      $("#tablaGalpon2").html("");
      $("#tablaGalpon2").html(respuesta);
    },
    error: function (request, error) {
      alertify.success(error);
    },
  });
}
// Función apra confirmar la eliminación de un registro
function preguntarSiNoGalpon2() {
  codigo = $("#codigou").val();
  var opcion = confirm("¿Esta seguro de eliminar el registro?");
  if (opcion == true) {
    eliminardatosGalpon2(codigo);
  } else {
    alert("El proceso de eliminación del registro ha sido cancelado.");
  }
}

function eliminardatosGalpon2(codigo) {
  cadena = "codigo=" + codigo;
  accion = "eliminar";
  mensaje_si = "Los datos de los galpñon se han borrado correctamente.";
  mensaje_no = "Error.. NO se eliminólos datos.";
  $.ajax({
    type: "POST",
    url: "../modelo/acciones-galpon2.php?accion=eliminar",
    data: cadena,
    success: function (r) {
      console.log(r);
      if (r == 0) {
        alertify.error(mensaje_no);
      } else {
        alertify.success(mensaje_si);
        cargarTablaGalpon2();
        // $('#tabla').load("../administrador/redConocimiento.php");
        // location.reload();
      }
    },
  });
}
