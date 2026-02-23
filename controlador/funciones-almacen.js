// // Información del formulario
var cmp_codigo_orions = document.getElementById('codigo_orions');
// Información para capturar los errores
var errorcodigo_orions = document.getElementById('errorcodigo_orions');

errorcodigo_orions.style.color = 'red';

function initAlmacen() {
    $('#guardarNuevoAlmacen').click(function (evt) {
        evt.preventDefault();
        validarAlmacen();
    });
}

function validarAlmacen() {

    var mensajecodigo_orions = [];

    restriccion = 0;

    if (cmp_codigo_orions.value === null || cmp_codigo_orions.value === '') {
        restriccion++;
        mensajecodigo_orions.push('Debe seleccionar el código orions.');
        cmp_codigo_orions.focus();
    } else {
        console.log("TODOS LOS CAMPOS ESTAN LLENOS");
    }

    if (restriccion < 1) {
        console.log("Vamos a registrar los materiales...");
        agregarDatosAlmacen(cmp_codigo_orions.value);
    } else {
        console.log("Debe continuar revisando por favor...");
        errorcodigo_orions.innerHTML = mensajecodigo_orions;
    }
}


// ----------------------------------------------------------
// FUNCIÓN PARA REGISTRAR PRODUCTOS
// ----------------------------------------------------------
function agregarDatosAlmacen() {

    codigo_orions = $('#codigo_orions').val();
    descripcion_material = $('#descripcion_material').val();
    cantidad_total = $('#cantidad_total').val();
    precio_kilo = $('#precio_kilo').val();
    cloro = $('#cloro').val();
    vinagre = $('#vinagre').val();
    hacido_hacetico = $('#hacido_hacetico').val();
    vitaminas = $('#vitaminas').val();
    precio_cloro = $('#precio_cloro').val();
    precio_vinagre = $('#precio_vinagre').val();
    yodo = $('#yodo').val();
    precio_yodo = $('#precio_yodo').val();
    precio_hacido = $('#precio_hacido').val();
    precio_vitamina = $('#precio_vitamina').val();
    anores = $('#anores').val();
    precio_anores = $('#precio_anores').val();
    vacunas = $('#vacunas').val();
    precio_vacunas = $('#precio_vacunas').val();
    respiros = $('#respiros').val();
    precio_respiros = $('#precio_respiros').val();
    tamo = $('#tamo').val();
    precio_tamo = $('#precio_tamo').val();
    cal = $('#cal').val();
    precio_cal = $('#precio_cal').val();
    antibiotico = $('#antibiotico').val();
    precio_antibiotico = $('#precio_antibiotico').val();
    abc = $('#abc').val();
    precio_abc = $('#precio_abc').val();
    vicarbonato = $('#vicarbonato').val();
    precio_vicarbonato = $('#precio_vicarbonato').val();
    melasa = $('#melasa').val();
    precio_melasa = $('#precio_melasa').val();
    agua_potable = $('#agua_potable').val();
    precio_agua = $('#precio_agua').val();
    luz = $('#luz').val();
    precio_luz = $('#precio_luz').val();
    arriendo = $('#arriendo').val();
    precio_arriendo = $('#precio_arriendo').val();
    gastos_varios = $('#gastos_varios').val();
    precio_gastos_varios = $('#precio_gastos_varios').val();


    // CADENA FINAL
    cadena = 
        "codigo_orions=" + codigo_orions +
        "&descripcion_material=" + descripcion_material +
        "&cantidad_total=" + cantidad_total +
        "&precio_kilo=" + precio_kilo +
        "&cloro=" + cloro +
        "&vinagre=" + vinagre +
        "&hacido_hacetico=" + hacido_hacetico +
        "&vitaminas=" + vitaminas +
        "&precio_cloro=" + precio_cloro +
        "&precio_vinagre=" + precio_vinagre +
        "&yodo=" + yodo +
        "&precio_yodo=" + precio_yodo +
        "&precio_hacido=" + precio_hacido +
        "&precio_vitamina=" + precio_vitamina +
        "&anores=" + anores +
        "&precio_anores=" + precio_anores +
        "&vacunas=" + vacunas +
        "&precio_vacunas=" + precio_vacunas +
        "&respiros=" + respiros +
        "&precio_respiros=" + precio_respiros +
        "&tamo=" + tamo +
        "&precio_tamo=" + precio_tamo +
        "&cal=" + cal +
        "&precio_cal=" + precio_cal +
        "&antibiotico=" + antibiotico +
        "&precio_antibiotico=" + precio_antibiotico +
        "&abc=" + abc +
        "&precio_abc=" + precio_abc +
        "&vicarbonato=" + vicarbonato +
        "&precio_vicarbonato=" + precio_vicarbonato +
        "&melasa=" + melasa +
        "&precio_melasa=" + precio_melasa +
        "&agua_potable=" + agua_potable +
        "&precio_agua=" + precio_agua +
        "&luz=" + luz +
        "&precio_luz=" + precio_luz +
        "&arriendo=" + arriendo +
        "&precio_arriendo=" + precio_arriendo +
        "&gastos_varios=" + gastos_varios +
        "&precio_gastos_varios=" + precio_gastos_varios;


    $.ajax({
        type: "POST",
        url: "../modelo/accionesAlmacen.php?accion=registrar",
        data: cadena,
        success: function (r) {
            console.log(r);
            if (r == 0) {
                alertify.error("Error, NO se registró los datos.");
            } else {
                alertify.success("Los datos del almacen se han registrado correctamente.");
                location.reload();
            }
        }
    });
}


// ----------------------------------------------------------
// CARGAR FORMULARIO PARA MODIFICAR
// ----------------------------------------------------------
function agregarFormAlmacen(datos) {

    d = datos.split('||');
    $('#codigou').val(d[0]);
    $('#codigo_orionsu').val(d[1]);
    $('#descripcion_materialu').val(d[2]);
    $('#cantidad_totalu').val(d[3]);
    $('#precio_kilou').val(d[4]);
    $('#clorou').val(d[5]);
    $('#vinagreu').val(d[6]);
    $('#hacido_haceticou').val(d[7]);
    $('#vitaminasu').val(d[8]);
    $('#precio_clorou').val(d[9]);
    $('#precio_vinagreu').val(d[10]);
    $('#yodou').val(d[11]);
    $('#precio_yodou').val(d[12]);
    $('#precio_hacidou').val(d[13]);
    $('#precio_vitaminau').val(d[14]);
    $('#anoresu').val(d[15]);
    $('#precio_anoresu').val(d[16]);
    $('#vacunasu').val(d[17]);
    $('#precio_vacunasu').val(d[18]);
    $('#respirosu').val(d[19]);
    $('#precio_respirosu').val(d[20]);
    $('#tamou').val(d[21]);
    $('#precio_tamou').val(d[22]);
    $('#calu').val(d[23]);
    $('#precio_calu').val(d[24]);
    $('#antibioticou').val(d[25]);
    $('#precio_antibioticou').val(d[26]);
    $('#abcu').val(d[27]);
    $('#precio_abcu').val(d[28]);
    $('#vicarbonatou').val(d[29]);
    $('#precio_vicarbonatou').val(d[30]);
    $('#melasau').val(d[31]);
    $('#precio_melasau').val(d[32]);
    $('#agua_potableu').val(d[33]);
    $('#precio_aguau').val(d[34]);
    $('#luzu').val(d[35]);
    $('#precio_luzu').val(d[36]);
    $('#arriendou').val(d[37]);
    $('#precio_arriendou').val(d[38]);
    $('#gastos_variosu').val(d[39]);
    $('#precio_gastos_variosu').val(d[40]);
}


// ----------------------------------------------------------
// MODIFICAR
// ----------------------------------------------------------
function modificarAlmacen() {

    codigo = $('#codigou').val();
    codigo_orions = $('#codigo_orionsu').val();
    descripcion_material = $('#descripcion_materialu').val();
    cantidad_total = $('#cantidad_totalu').val();
    precio_kilo = $('#precio_kilou').val();
    cloro = $('#clorou').val();
    vinagre = $('#vinagreu').val();
    hacido_hacetico = $('#hacido_haceticou').val();
    vitaminas = $('#vitaminasu').val();
    precio_cloro = $('#precio_clorou').val();
    precio_vinagre = $('#precio_vinagreu').val();
    yodo = $('#yodou').val();
    precio_yodo = $('#precio_yodou').val();
    precio_hacido = $('#precio_hacidou').val();
    precio_vitamina = $('#precio_vitaminau').val();
    // NUEVOS CAMPOS
    anores = $('#anoresu').val();
    precio_anores = $('#precio_anoresu').val();
    vacunas = $('#vacunasu').val();
    precio_vacunas = $('#precio_vacunasu').val();
    respiros = $('#respirosu').val();
    precio_respiros = $('#precio_respirosu').val();
    tamo = $('#tamou').val();
    precio_tamo = $('#precio_tamou').val();
    cal = $('#calu').val();
    precio_cal = $('#precio_calu').val();
    antibiotico = $('#antibioticou').val();
    precio_antibiotico = $('#precio_antibioticou').val();
    abc = $('#abcu').val();
    precio_abc = $('#precio_abcu').val();
    vicarbonato = $('#vicarbonatou').val();
    precio_vicarbonato = $('#precio_vicarbonatou').val();
    melasa = $('#melasau').val();
    precio_melasa = $('#precio_melasau').val();
    agua_potable = $('#agua_potableu').val();
    precio_agua = $('#precio_aguau').val();
    luz = $('#luzu').val();
    precio_luz = $('#precio_luzu').val();
    arriendo = $('#arriendou').val();
    precio_arriendo = $('#precio_arriendou').val();
    gastos_varios = $('#gastos_variosu').val();
    precio_gastos_varios = $('#precio_gastos_variosu').val();


    cadena = 
        "codigo=" + codigo +
        "&codigo_orions=" + codigo_orions +
        "&descripcion_material=" + descripcion_material +
        "&cantidad_total=" + cantidad_total +
        "&precio_kilo=" + precio_kilo +
        "&cloro=" + cloro +
        "&vinagre=" + vinagre +
        "&hacido_hacetico=" + hacido_hacetico +
        "&vitaminas=" + vitaminas +
        "&precio_cloro=" + precio_cloro +
        "&precio_vinagre=" + precio_vinagre +
        "&yodo=" + yodo +
        "&precio_yodo=" + precio_yodo +
        "&precio_hacido=" + precio_hacido +
        "&precio_vitamina=" + precio_vitamina +
        "&anores=" + anores +
        "&precio_anores=" + precio_anores +
        "&vacunas=" + vacunas +
        "&precio_vacunas=" + precio_vacunas +
        "&respiros=" + respiros +
        "&precio_respiros=" + precio_respiros +
        "&tamo=" + tamo +
        "&precio_tamo=" + precio_tamo +
        "&cal=" + cal +
        "&precio_cal=" + precio_cal +
        "&antibiotico=" + antibiotico +
        "&precio_antibiotico=" + precio_antibiotico +
        "&abc=" + abc +
        "&precio_abc=" + precio_abc +
        "&vicarbonato=" + vicarbonato +
        "&precio_vicarbonato=" + precio_vicarbonato +
        "&melasa=" + melasa +
        "&precio_melasa=" + precio_melasa +
        "&agua_potable=" + agua_potable +
        "&precio_agua=" + precio_agua +
        "&luz=" + luz +
        "&precio_luz=" + precio_luz +
        "&arriendo=" + arriendo +
        "&precio_arriendo=" + precio_arriendo +
        "&gastos_varios=" + gastos_varios +
        "&precio_gastos_varios=" + precio_gastos_varios;


    $.ajax({
        type: "POST",
        url: "../modelo/accionesAlmacen.php?accion=modificar",
        data: cadena,
        success: function (r) {
            console.log(r);
            if (r == 0) {
                alertify.error("Error de registro");
            } else {
                alertify.success("Los datos del almacen se han modificado con éxito");
                cargarTablaAlmacen();
            }
        }
    });
}


// ----------------------------------------------------------
// CARGAR TABLA
// ----------------------------------------------------------
function cargarTablaAlmacen() {
    $.ajax({
        type: "POST",
        url: "../administrador/almacen.php",
        async: true,
        success: function (respuesta) {
            $("#tablaAlmacen").html(respuesta);
        },
        error: function (request, error) {
            alertify.success(error);
        }
    });
}


// ----------------------------------------------------------
// ELIMINAR
// ----------------------------------------------------------
function preguntarSiNoAlmacen() {
    codigo = $('#codigou').val();
    codigo_orions = $('#codigo_orionsu').val();
    var opcion = confirm("¿Esta seguro de eliminar el registro?");
    if (opcion == true) {
        eliminardatosAlmacen(codigo,codigo_orions);
    } else {
        alert("El proceso de eliminación del registro ha sido cancelado.");
    }
}

function eliminardatosAlmacen(codigo,codigo_orions) {
    cadena = "codigo=" + codigo +
             "&codigo_orions=" + codigo_orions;

    $.ajax({
        type: "POST",
        url: "../modelo/accionesAlmacen.php?accion=eliminar",
        data: cadena,
        success: function (r) {
            console.log(r);
            if (r == 0) {
                alertify.error("Error.. NO se eliminó los datos.");
            } else {
                alertify.success("Los datos del almacen se han borrado correctamente.");
                cargarTablaAlmacen();
            }
        }
    });
}
