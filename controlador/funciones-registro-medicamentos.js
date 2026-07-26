// Vincula el evento click al botón de guardar registro
function initRegistroMedicamentos() {
    $('#guardarNuevoRegistroMedicamentos').click(function (evt) {
        evt.preventDefault();
        agregarDatosRegistroMedicamentos();
    });
}

// Función exclusiva para registrar el producto
function agregarDatosRegistroMedicamentos() {
    codigo_orions = $('#codigo_orions').val();
    fecha = $('#fecha').val();
    nombre_producto = $('#nombre_producto').val();
    causa = $('#causa').val();
    laboratorio = $('#laboratorio').val();
    registro_ica = $('#registro_ica').val();
    dosis = $('#dosis').val();
    lote_producto = $('#lote_producto').val();
    vencimiento = $('#vencimiento').val();
    administracion = $('#administracion').val();
    animales = $('#animales').val();
    galpon_tratado = $('#galpon_tratado').val();

    cadena = "codigo_orions=" + codigo_orions +
             "&fecha=" + fecha +
             "&nombre_producto=" + nombre_producto +
             "&causa=" + causa +
             "&laboratorio=" + laboratorio +
             "&registro_ica=" + registro_ica +
             "&dosis=" + dosis +
             "&lote_producto=" + lote_producto +
             "&vencimiento=" + vencimiento +
             "&administracion=" + administracion +
             "&animales=" + animales +
             "&galpon_tratado=" + galpon_tratado;

    mensaje_si = "Los datos se han registrado correctamente.";
    mensaje_no = "Error, NO se registró los datos.";

    $.ajax({
        type: "POST",
        url: "../modelo/acciones-medicamentos.php?accion=registrar",
        data: cadena,
        success: function (r) {
            console.log(r);
            if (r == 0) {
                alertify.error(mensaje_no);
            } else {
                alertify.success(mensaje_si);
                cargarTablaRegistroMedicamentos();
            }
        }
    });
}

// Función para cargar información a modificar
function agregarFormRegistroMedicamentos(datos) {
    d = datos.split('||');
    $('#codigou').val(d[0]);
    $('#codigo_orionsu').val(d[1]);
    $('#fechau').val(d[2]);
    $('#nombre_productou').val(d[3]);
    $('#causau').val(d[4]);
    $('#laboratoriou').val(d[5]);
    $('#registro_icau').val(d[6]);
    $('#dosisu').val(d[7]);
    $('#lote_productou').val(d[8]);
    $('#vencimientou').val(d[9]);
    $('#administracionu').val(d[10]);
    $('#animalesu').val(d[11]);
    $('#galpon_tratadou').val(d[12]);
}

// Función para modificar 
function modificarMedicamento() {
    codigou = $('#codigou').val();
    codigo_orionsu = $('#codigo_orionsu').val();
    fechau = $('#fechau').val();
    nombre_productou = $('#nombre_productou').val();
    causau = $('#causau').val();
    laboratoriou = $('#laboratoriou').val();
    registro_icau = $('#registro_icau').val();
    dosisu = $('#dosisu').val();
    lote_productou = $('#lote_productou').val();
    vencimientou = $('#vencimientou').val();
    administracionu = $('#administracionu').val();
    animalesu = $('#animalesu').val();
    galpon_tratadou = $('#galpon_tratadou').val();

    cadena = "codigou=" + codigou +
             "&codigo_orionsu=" + codigo_orionsu +
             "&fechau=" + fechau +
             "&nombre_productou=" + nombre_productou +
             "&causau=" + causau +
             "&laboratoriou=" + laboratoriou +
             "&registro_icau=" + registro_icau +
             "&dosisu=" + dosisu +
             "&lote_productou=" + lote_productou +
             "&vencimientou=" + vencimientou +
             "&administracionu=" + administracionu +
             "&animalesu=" + animalesu +
             "&galpon_tratadou=" + galpon_tratadou;

    mensaje_si = "Los datos se han modificado con éxito.";
    mensaje_no = "Error de registro";

    $.ajax({
        type: "POST",
        url: "../modelo/acciones-medicamentos.php?accion=modificar",
        data: cadena,
        success: function (r) {
            console.log(r);
            if (r == 0) {
                alertify.error(mensaje_no);
            } else {
                alertify.success(mensaje_si);
                cargarTablaRegistroMedicamentos();
            }
        }
    });
}

// Función para cargar información de la vista
function cargarTablaRegistroMedicamentos() {
    $.ajax({
        type: "POST",
        url: "../administrador/registro_medicamentos.php",
        async: true,
        success: function (respuesta) {
            $("#tablaRegistroMedicamentos").html("");
            $("#tablaRegistroMedicamentos").html(respuesta);
        },
        error: function (request, error) {
            alertify.error("Error al cargar la tabla");
        }
    });
}

// Función para confirmar la eliminación de un registro
function preguntarSiNoRegistroMedicamentos() {
    codigo = $('#codigou').val();
    var opcion = confirm("¿Está seguro de eliminar el registro?");
    if (opcion == true) {
        eliminardatosRegistroMedicamentos(codigo);
    } else {
        alert("El proceso de eliminación del registro ha sido cancelado.");
    }
}

function eliminardatosRegistroMedicamentos(codigo) {
    cadena = "codigo=" + codigo;

    mensaje_si = "Los datos se han borrado correctamente.";
    mensaje_no = "Error.. NO se eliminaron los datos.";

    $.ajax({
        type: "POST",
        url: "../modelo/acciones-medicamentos.php?accion=eliminar",
        data: cadena,
        success: function (r) {
            console.log(r);
            if (r == 0) {
                alertify.error(mensaje_no);
            } else {
                alertify.success(mensaje_si);
                cargarTablaRegistroMedicamentos();
            }
        }
    });
}