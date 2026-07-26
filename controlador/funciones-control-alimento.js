// Vincula el evento click al botón de guardar registro
function initControlAlimento() {
    $('#guardarNuevoControlAlimento').click(function (evt) {
        evt.preventDefault();
        agregarDatosControlAlimento();
    });
}

// Función exclusiva para registrar el producto
function agregarDatosControlAlimento() {
    codigo_orions = $('#codigo_orions').val();
    fecha_control_aliment = $('#fecha_control_aliment').val();
    entradas = $('#entradas').val();
    salidas = $('#salidas').val();
    consumo_tabla = $('#consumo_tabla').val();
    consumo_real = $('#consumo_real').val();
    acumulado_tabla = $('#acumulado_tabla').val();
    acumulado_real = $('#acumulado_real').val();
    saldo_real = $('#saldo_real').val();
    programacion = $('#programacion').val();
    observaciones = $('#observaciones').val();

    cadena = "codigo_orions=" + codigo_orions +
             "&fecha_control_aliment=" + fecha_control_aliment +
             "&entradas=" + entradas +
             "&salidas=" + salidas +
             "&consumo_tabla=" + consumo_tabla +
             "&consumo_real=" + consumo_real +
             "&acumulado_tabla=" + acumulado_tabla +
             "&acumulado_real=" + acumulado_real +
             "&saldo_real=" + saldo_real +
             "&programacion=" + programacion +
             "&observaciones=" + observaciones;

    mensaje_si = "Los datos se han registrado correctamente.";
    mensaje_no = "Error, NO se registró los datos.";

    $.ajax({
        type: "POST",
        url: "../modelo/acciones-control-alimento.php?accion=registrar",
        data: cadena,
        success: function (r) {
            console.log(r);
            if (r == 0) {
                alertify.error(mensaje_no);
            } else {
                alertify.success(mensaje_si);
                cargarTablaControlAlimento();
            }
        }
    });
}

// Función para cargar información a modificar
function agregarFormControlAlimento(datos) {
    d = datos.split('||');
    $('#codigou').val(d[0]);
    $('#codigo_orionsu').val(d[1]);
    $('#fecha_control_alimentu').val(d[2]);
    $('#entradasu').val(d[3]);
    $('#salidasu').val(d[4]);
    $('#consumo_tablau').val(d[5]);
    $('#consumo_realu').val(d[6]);
    $('#acumulado_tablau').val(d[7]);
    $('#acumulado_realu').val(d[8]);
    $('#saldo_realu').val(d[9]);
    $('#programacionu').val(d[10]);
    $('#observacionesu').val(d[11]);
}

// Función para modificar 
function modificarControlAlimento() {
    codigou = $('#codigou').val();
    codigo_orionsu = $('#codigo_orionsu').val();
    fecha_control_alimentu = $('#fecha_control_alimentu').val();
    entradasu = $('#entradasu').val();
    salidasu = $('#salidasu').val();
    consumo_tablau = $('#consumo_tablau').val();
    consumo_realu = $('#consumo_realu').val();
    acumulado_tablau = $('#acumulado_tablau').val();
    acumulado_realu = $('#acumulado_realu').val();
    saldo_realu = $('#saldo_realu').val();
    programacionu = $('#programacionu').val();
    observacionesu = $('#observacionesu').val();

    cadena = "codigou=" + codigou +
             "&codigo_orionsu=" + codigo_orionsu +
             "&fecha_control_alimentu=" + fecha_control_alimentu +
             "&entradasu=" + entradasu +
             "&salidasu=" + salidasu +
             "&consumo_tablau=" + consumo_tablau +
             "&consumo_realu=" + consumo_realu +
             "&acumulado_tablau=" + acumulado_tablau +
             "&acumulado_realu=" + acumulado_realu +
             "&saldo_realu=" + saldo_realu +
             "&programacionu=" + programacionu +
             "&observacionesu=" + observacionesu;

    mensaje_si = "Los datos se han modificado con éxito.";
    mensaje_no = "Error de registro";

    $.ajax({
        type: "POST",
        url: "../modelo/acciones-control-alimento.php?accion=modificar",
        data: cadena,
        success: function (r) {
            console.log(r);
            if (r == 0) {
                alertify.error(mensaje_no);
            } else {
                alertify.success(mensaje_si);
                cargarTablaControlAlimento();
            }
        }
    });
}

// Función para cargar información de la vista
function cargarTablaControlAlimento() {
    $.ajax({
        type: "POST",
        url: "../administrador/control_alimento.php",
        async: true,
        success: function (respuesta) {
            $("#tablaControlAlimento").html("");
            $("#tablaControlAlimento").html(respuesta);
        },
        error: function (request, error) {
            alertify.error("Error al cargar la tabla");
        }
    });
}

// Función para confirmar la eliminación de un registro
function preguntarSiNoControlAlimento() {
    codigo = $('#codigou').val();
    var opcion = confirm("¿Está seguro de eliminar el registro?");
    if (opcion == true) {
        eliminardatosControlAlimento(codigo);
    } else {
        alert("El proceso de eliminación del registro ha sido cancelado.");
    }
}

function eliminardatosControlAlimento(codigo) {
    cadena = "codigo=" + codigo;

    mensaje_si = "Los datos se han borrado correctamente.";
    mensaje_no = "Error.. NO se eliminaron los datos.";

    $.ajax({
        type: "POST",
        url: "../modelo/acciones-control-alimento.php?accion=eliminar",
        data: cadena,
        success: function (r) {
            console.log(r);
            if (r == 0) {
                alertify.error(mensaje_no);
            } else {
                alertify.success(mensaje_si);
                cargarTablaControlAlimento();
            }
        }
    });
}