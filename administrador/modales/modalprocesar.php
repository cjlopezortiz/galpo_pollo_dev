<?php
require_once __DIR__ . '/../../modelo/datos-almacen.php';
require_once __DIR__ . '/../../modelo/datos-procesar.php';
$mis_almacen = new misAlmacenes();
$obj         = new misProcesos();

// El código se recibe por GET (Asegúrate de que la URL lo envíe)
$codigo = $_GET['codigo'] ?? null;
$res = $mis_almacen->viewAlmacenes($codigo);

// Obtenemos el código único del almacén
$codigoUnico = $res[0]['codigo_orions_almacen'] ?? null;

// Consultamos el total neto usando ese código
$total_data = $obj->totalNetoPorCodigo($codigoUnico);
$valor_total_neto = $total_data['total_neto'] ?? 0;
// var_dump($valor_total_neto);
//die();
?>
<div class="modal fade" id="modalEdicionProcesar" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Actualizar Proceso</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="codigou"> <input type="hidden" id="fila_u"> <input type="hidden" id="codigo_orions_u"> <label>Peso Bruto (Kg)</label>
        <input type="number" id="brutou" class="form-control input-calculo" step="0.1">
        <br>

        <label>Canastas (Kg)</label>
        <input type="number" id="canastasu" class="form-control input-calculo" step="0.1">
        <br>
        <label>Valor (Kg)</label>
        <input type="number" id="precio_pollou" class="form-control input-calculo">
        <br>
        <label>Total Fila</label>
        <input type="number" id="total_generalu" class="form-control" readonly
          style="background:#e9f7f6; font-weight: bold; border: 1px solid #26a69a; color: #000;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" id="eliminarDatosProcesar">Eliminar</button>
        <button type="button"
          class="btn btn-warning"
          id="actualizaDatosProcesar">
          Actualizar
        </button>
      </div>
    </div>
  </div>
</div>