// VARIABLE GLOBAL PARA GUARDAR EL PRECIO DEL POLLO
var precioGlobalPollo = 0;


// LLENAR DATOS EN EL MODAL
function agregarFormProcesar(datos) {

    var d = datos.split('||');

    // Mapeo correcto según la cadena generada PHP:
    // d[0] -> id
    // d[1] -> bruto
    // d[2] -> precio_pollo
    // d[3] -> canastas
    // d[4] -> total fila
    // d[5] -> codigo cosecha
    // d[6] -> peso_observacion
    // d[7] -> numero de fila ($i)

    $('#codigou').val(d[0]);          // id
    $('#brutou').val(d[1]);           // bruto
    $('#canastasu').val(d[3]);        // canastas
    $('#total_generalu').val(d[4]);   // total fila
    $('#codigo_orions_u').val(d[5]);  // codigo cosecha
    $('#peso_observacionu').val(d[6]);// OBSERVACION CLIENTE (CORREGIDO)
    $('#fila_u').val(d[7]);           // NUMERO DE FILA (CORREGIDO)

    let precioDB = parseFloat(d[2]) || 0;

    // SI LA BASE DE DATOS TIENE PRECIO LO USA
    if(precioDB > 0){
        $('#precio_pollou').val(precioDB);
        precioGlobalPollo = precioDB;
    }else{
        // SI NO TIENE PRECIO USA EL GLOBAL
        $('#precio_pollou').val(precioGlobalPollo);
    }
}


// CALCULAR TOTAL AUTOMÁTICO EN EL MODAL
$(document).on('input', '#brutou, #canastasu', function() {

    // Remplazamos comas por puntos por si vienen en formato '31,3'
    let valBruto = $('#brutou').val().replace(',', '.');
    let valCanastas = $('#canastasu').val().replace(',', '.');

    let bruto = parseFloat(valBruto) || 0;
    let canastas = parseFloat(valCanastas) || 0;
    
    let total = (bruto - canastas).toFixed(3);

    $('#total_generalu').val(total);

});


// GUARDAR PRECIO GLOBAL
$(document).on('input', '#precio_pollou', function() {

    precioGlobalPollo = parseFloat($(this).val()) || 0;

});


    function modificarProcesar() {
    var datos = {
        codigo: $('#codigou').val(),
        codigo_orions: $('#codigo_orions_u').val(), // ¡Importante!
        fila: $('#fila_u').val(),                   // ¡Importante!
        bruto: $('#brutou').val(),
        canastas: $('#canastasu').val(),
        total_general: $('#total_generalu').val(),
        precio_pollo: $('#precio_pollou').val(),
        peso_observacion: $('#peso_observacionu').val()
    };
    $.ajax({
            type: "POST",
            url: "../controlador/actualizarProcesar.php",
            data: datos,
            success: function(r) {
                if (r == 1) {

                    $('#modalEdicionProcesar').modal('hide'); // 🔥 cerrar aquí

                    let params = new URLSearchParams(window.location.search);
                    let cod = params.get('codigo_orions');

                    $('#contenedorProcesar')
                        .load('./vista_admin/vista_procesar.php?codigo_orions=' + cod);

                    alertify.success("Actualizado con éxito");
                } else {
                    alertify.error("Error al actualizar");
                }
            }
        });

}
function preguntarSiNoProcesar() {
    let id = $('#codigou').val();
    if(id === "") {
        alertify.error("No se puede eliminar un registro no guardado");
        return false;
    }
    alertify.confirm('Eliminar', '¿Seguro que desea eliminar este proceso?', function(){ 
        eliminarDatosProcesar(id);
    }, function(){});
}

function eliminarDatosProcesar(id) {
    $.ajax({
        type: "POST",
        url: "../modelo/acciones-procesar.php?accion=eliminar",
        data: "codigo=" + id,
        success: function(r) {
            if (r == 1) {
                alertify.success("Registro eliminado");
                $('#contenedorProcesar').load('./vista_admin/vista_procesar.php');
            }
        }
    });
}