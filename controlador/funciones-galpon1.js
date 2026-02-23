// -------- VARIABLES --------
var cmp_codigo_orions      = document.getElementById('codigo_orions');
var cmp_cantidad_pollo     = document.getElementById('cantidad_pollo');
var cmp_precio_pollo       = document.getElementById('precio_pollo');
var cmp_color              = document.getElementById('color');
var cmp_fayido             = document.getElementById('fayido');
var cmp_tipo_alimento      = document.getElementById('tipo_alimento');
var cmp_cantidad           = document.getElementById('cantidad');
var cmp_precio_alimento    = document.getElementById('precio_alimento');
var cmp_fecha_inicio       = document.getElementById('fecha_inicio');
var cmp_fecha_fin          = document.getElementById('fecha_fin');
var cmp_descripcion        = document.getElementById('descripcion');
var cmp_alimento_inicio    = document.getElementById('alimento_inicio');
var cmp_precio_inicio      = document.getElementById('precio_inicio');
var cmp_alimento_preinicio = document.getElementById('alimento_preinicio');
var cmp_precio_preinicio   = document.getElementById('precio_preinicio');

// -------- SPAN DE ERRORES --------
var errorcodigo_orions      = document.getElementById('errorcodigo_orions');
var errorcantidad_pollo     = document.getElementById('errorcantidad_pollo');
var errorprecio_pollo       = document.getElementById('errorprecio_pollo');
var errorcolor              = document.getElementById('errorcolor');
var errorfayido             = document.getElementById('errorfayido');
var errortipo_alimento      = document.getElementById('errortipo_alimento');
var errorcantidad           = document.getElementById('errorcantidad');
var errorprecio_alimento    = document.getElementById('errorprecio_alimento');
var errorfecha_inicio       = document.getElementById('errorfecha_inicio');
var errorfecha_fin          = document.getElementById('errorfecha_fin');
var errordescripcion        = document.getElementById('errordescripcion');
var erroralimento_inicio    = document.getElementById('errorprecio_inicio');
var errorprecio_inicio      = document.getElementById('erroralimento_inicio');
var erroralimento_preinicio = document.getElementById('erroralimento_preinicio');
var errorprecio_preinicio   = document.getElementById('errorprecio_preinicio');

// color rojo para todos
[
    errorcodigo_orions, errorcantidad_pollo, errorprecio_pollo, errorcolor, errorfayido,
    errortipo_alimento, errorcantidad, errorprecio_alimento, errorfecha_inicio,
    errorfecha_fin, errordescripcion, errorprecio_inicio, erroralimento_inicio, erroralimento_preinicio, errorprecio_preinicio
].forEach(e => e.style.color = 'red');


function initgalpon1() {
    $('#guardarNuevoGalpon1').click(function (evt) {
        evt.preventDefault();
        validargalpon1();
    });
}

function validargalpon1() {

    var restriccion = 0;

    // -------- LIMPIAR ERRORES --------
    errorcodigo_orions.innerHTML      = "";
    errorcantidad_pollo.innerHTML     = "";
    errorprecio_pollo.innerHTML       = "";
    errorcolor.innerHTML              = "";
    errorfayido.innerHTML             = "";
    errortipo_alimento.innerHTML      = "";
    errorcantidad.innerHTML           = "";
    errorprecio_alimento.innerHTML    = "";
    errorfecha_inicio.innerHTML       = "";
    errorfecha_fin.innerHTML          = "";
    errordescripcion.innerHTML        = "";
    erroralimento_inicio.innerHTML    = "";
    errorprecio_inicio.innerHTML      = "";
    erroralimento_preinicio.innerHTML = "";
    errorprecio_preinicio.innerHTML   = "";

    // -------- VALIDACIONES --------

    if (!cmp_codigo_orions.value) {
        restriccion++;
        errorcodigo_orions.innerHTML = "Debe seleccionar el código Orions.";
        cmp_codigo_orions.focus();
    }

    if (!cmp_cantidad_pollo.value) {
        restriccion++;
        errorcantidad_pollo.innerHTML = "Debe ingresar la cantidad de pollos.";
    }

    if (!cmp_precio_pollo.value) {
        restriccion++;
        errorprecio_pollo.innerHTML = "Debe ingresar el precio del pollo.";
    }

    if (!cmp_color.value) {
        restriccion++;
        errorcolor.innerHTML = "Debe ingresar el color.";
    }

    if (!cmp_fayido.value) {
        restriccion++;
        errorfayido.innerHTML = "Debe ingresar los fayidos.";
    }

    if (!cmp_tipo_alimento.value) {
        restriccion++;
        errortipo_alimento.innerHTML = "Debe seleccionar el tipo de alimento.";
    }

    if (!cmp_cantidad.value) {
        restriccion++;
        errorcantidad.innerHTML = "Debe ingresar la cantidad de alimento.";
    }

    if (!cmp_precio_alimento.value) {
        restriccion++;
        errorprecio_alimento.innerHTML = "Debe ingresar el precio del alimento.";
    }

    if (!cmp_fecha_inicio.value) {
        restriccion++;
        errorfecha_inicio.innerHTML = "Debe ingresar la fecha de inicio.";
    }

    if (!cmp_fecha_fin.value) {
        restriccion++;
        errorfecha_fin.innerHTML = "Debe ingresar la fecha de fin.";
    }

    if (!cmp_descripcion.value) {
        restriccion++;
        errordescripcion.innerHTML = "Debe ingresar una descripción.";
    }

    if (!cmp_alimento_inicio.value) {
      restriccion++;
      erroralimento_inicio.innerHTML = "Debe ingresar el alimento de inicio.";
  }

  if (!cmp_precio_inicio.value) {
    restriccion++;
    errorprecio_inicio.innerHTML = "Debe ingresar el precio del alimento de inicio.";
  }
  
  if (!cmp_alimento_preinicio.value) {
    restriccion++;
    erroralimento_preinicio.innerHTML = "Debe ingresar el precio del alimento de crecimiento.";
  }

  if (!cmp_precio_preinicio.value) {
    restriccion++;
    errorprecio_preinicio.innerHTML = "Debe ingresar el precio del alimento de crecimiento.";
  }


    // -------- ENVÍO --------
    if (restriccion < 1) {
        console.log("Vamos a registrar los materiales...");
        agregarDatosGalpon1(
            cmp_codigo_orions.value,
            cmp_cantidad_pollo.value,
            cmp_precio_pollo.value,
            cmp_color.value,
            cmp_fayido.value,
            cmp_tipo_alimento.value,
            cmp_cantidad.value,
            cmp_precio_alimento.value,
            cmp_fecha_inicio.value,
            cmp_fecha_fin.value,
            cmp_descripcion.value,
            cmp_alimento_inicio.value,
            cmp_precio_inicio.value,
            cmp_alimento_preinicio.value,
            cmp_precio_preinicio.value
        );
    } else {
        console.log("Debe continuar revisando por favor...");
    }
}



// Función para registrar
function agregarDatosGalpon1() {
  codigo_orions   = $("#codigo_orions").val();
  cantidad_pollo  = $("#cantidad_pollo").val();
  precio_pollo    = $("#precio_pollo").val();
  color           = $("#color").val();
  fayido          = $("#fayido").val();
  tipo_alimento   = $("#tipo_alimento").val();
  cantidad        = $("#cantidad").val();
  precio_alimento = $("#precio_alimento").val();
  fecha_inicio    = $("#fecha_inicio").val();
  fecha_fin       = $("#fecha_fin").val();
  descripcion     = $("#descripcion").val();
  alimento_inicio = $("#alimento_inicio").val();
  precio_inicio   = $("#precio_inicio").val();
  alimento_preinicio = $("#alimento_preinicio").val();
  precio_preinicio   = $("#precio_preinicio").val();
  cadena =
    "&codigo_orions=" +
    codigo_orions +
    "&cantidad_pollo=" +
    cantidad_pollo +
    "&precio_pollo=" +
    precio_pollo +
    "&color=" +
    color +
    "&fayido=" +
    fayido +
    "&tipo_alimento=" +
    tipo_alimento +
    "&cantidad=" +
    cantidad +
    "&precio_alimento=" +
    precio_alimento +
    "&fecha_inicio=" +
    fecha_inicio +
    "&fecha_fin=" +
    fecha_fin +
    "&descripcion=" +
    descripcion +
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
    url: "../modelo/acciones-galpon1.php?accion=registrar",
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
function agregarFormGalpon1(datos) {
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
function modificarGalpon1() {
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
    "&cantidad_pollo=" +
    cantidad_pollo +
    "&precio_pollo=" +
    precio_pollo +
    "&color=" +
    color +
    "&fayido=" +
    fayido +
    "&tipo_alimento=" +
    tipo_alimento +
    "&cantidad=" +
    cantidad +
    "&precio_alimento=" +
    precio_alimento +
    "&fecha_inicio=" +
    fecha_inicio +
    "&fecha_fin=" +
    fecha_fin +
    "&descripcion=" +
    descripcion +
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
    url: "../modelo/acciones-galpon1.php?accion=modificar",
    data: cadena,
    success: function (r) {
      console.log(r);
      if (r == 0) {
        alertify.error(mensaje_no);
      } else {
        alertify.success(mensaje_si);
        cargarTablaGalpon1();
      }
    },
  });
}
// Función para cargar información de la vista
function cargarTablaGalpon1() {
  $.ajax({
    type: "POST",
    url: "../administrador/galpon1.php",
    async: true,
    success: function (respuesta) {
      //console.log(respuesta);
      $("#tablaGalpon1").html("");
      $("#tablaGalpon1").html(respuesta);
    },
    error: function (request, error) {
      alertify.success(error);
    },
  });
}
// Función apra confirmar la eliminación de un registro
function preguntarSiNoGalpon1() {
  codigo = $("#codigou").val();
  var opcion = confirm("¿Esta seguro de eliminar el registro?");
  if (opcion == true) {
    eliminardatosGalpon1(codigo);
  } else {
    alert("El proceso de eliminación del registro ha sido cancelado.");
  }
}

function eliminardatosGalpon1(codigo) {
  cadena = "codigo=" + codigo;

  accion = "eliminar";
  mensaje_si = "Los datos de los galpñon se han borrado correctamente.";
  mensaje_no = "Error.. NO se eliminólos datos.";

  $.ajax({
    type: "POST",
    url: "../modelo/acciones-galpon1.php?accion=eliminar",
    data: cadena,
    success: function (r) {
      console.log(r);
      if (r == 0) {
        alertify.error(mensaje_no);
      } else {
        alertify.success(mensaje_si);
        cargarTablaGalpon1();
        // $('#tabla').load("../administrador/redConocimiento.php");
        // location.reload();
      }
    },
  });
}
