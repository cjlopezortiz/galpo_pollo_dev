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
        <input type="hidden" id="codigou">
        <input type="hidden" id="fila_u">
        <input type="hidden" id="codigo_orions_u">

        <label>Peso Bruto (Kg)</label>
        <input type="number" step="any" id="brutou" class="form-control input-calculo">
        <br>

        <label>Canastas (Kg)</label>
        <input type="number" step="any" id="canastasu" class="form-control input-calculo">
        <br>

        <label>Valor (Kg)</label>
        <input type="number" step="any" id="precio_pollou" class="form-control input-calculo">
        <br>
        <label>Total Fila</label>
        <input type="number" step="any" id="total_generalu" class="form-control" readonly
          style="background:#e9f7f6; font-weight: bold; border: 1px solid #26a69a; color: #000;">
        <br>
        <label>Cliente</label>
       <input type="text" id="peso_observacionu" class="form-control">
        <br>
      </div>
      <div class="modal-footer">
        <button type="button"
          class="btn btn-danger pull-left"
          data-dismiss="modal"
          id="eliminarDatosProcesar"
          onclick="preguntarSiNoProcesar()">
          Eliminar
        </button>
        <button type="button"
          class="btn btn-warning"
          id="actualizaDatosProcesar"
          onclick="modificarProcesar()">
          Actualizar
        </button>
      </div>
    </div>
  </div>
</div>