<!-- MODAL AGREGAR NUEVO MEDICAMENTO -->
<div class="modal fade" id="modalNuevoMedicamento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Registrar Medicamento / Tratamiento</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form id="formNuevoMedicamento">
          <div class="row">
            <div class="col-md-4 form-group">
              <label>Código Orions</label>
              <input type="text" id="codigo_orions" name="codigo_orions" class="form-control" required>
            </div>
            <div class="col-md-4 form-group">
              <label>Fecha</label>
              <input type="date" id="fecha" name="fecha" class="form-control" required>
            </div>
            <div class="col-md-4 form-group">
              <label>Nombre del Producto</label>
              <input type="text" id="nombre_producto" name="nombre_producto" class="form-control">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 form-group">
              <label>Causa</label>
              <input type="text" id="causa" name="causa" class="form-control">
            </div>
            <div class="col-md-6 form-group">
              <label>Laboratorio</label>
              <input type="text" id="laboratorio" name="laboratorio" class="form-control">
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 form-group">
              <label>Registro ICA</label>
              <input type="text" id="registro_ica" name="registro_ica" class="form-control">
            </div>
            <div class="col-md-4 form-group">
              <label>Dosis</label>
              <input type="text" id="dosis" name="dosis" class="form-control">
            </div>
            <div class="col-md-4 form-group">
              <label>Lote del Producto</label>
              <input type="text" id="lote_producto" name="lote_producto" class="form-control">
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 form-group">
              <label>Fecha Vencimiento</label>
              <input type="date" id="vencimiento" name="vencimiento" class="form-control">
            </div>
            <div class="col-md-4 form-group">
              <label>Administración</label>
              <input type="text" id="administracion" name="administracion" class="form-control">
            </div>
            <div class="col-md-4 form-group">
              <label>Animales</label>
              <input type="number" id="animales" name="animales" class="form-control" value="0">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 form-group">
              <label>Galpón Tratado</label>
              <input type="text" id="galpon_tratado" name="galpon_tratado" class="form-control">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="guardarNuevoMedicamento">Guardar Datos</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL EDICIÓN MEDICAMENTO -->
<div class="modal fade" id="modalEdicionMedicamento" tabindex="-1" role="dialog" aria-labelledby="">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Editar Medicamento / Tratamiento</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form id="formEdicionMedicamento">
          <input type="hidden" id="codigou" name="codigou">

          <div class="row">
            <div class="col-md-4 form-group">
              <label>Código Orions</label>
              <input type="text" name="codigo_orionsu" id="codigo_orionsu" class="form-control" readonly>
            </div>
            <div class="col-md-4 form-group">
              <label>Fecha</label>
              <input type="date" name="fechau" id="fechau" class="form-control" required="" onclick="this.showPicker()">
            </div>
            <div class="col-md-4 form-group">
              <label>Nombre del Producto</label>
              <input type="text" name="nombre_productou" id="nombre_productou" class="form-control">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 form-group">
              <label>Causa</label>
              <input type="text" name="causau" id="causau" class="form-control">
            </div>
            <div class="col-md-6 form-group">
              <label>Laboratorio</label>
              <input type="text" name="laboratoriou" id="laboratoriou" class="form-control">
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 form-group">
              <label>Registro ICA</label>
              <input type="text" name="registro_icau" id="registro_icau" class="form-control">
            </div>
            <div class="col-md-4 form-group">
              <label>Dosis</label>
              <input type="text" name="dosisu" id="dosisu" class="form-control">
            </div>
            <div class="col-md-4 form-group">
              <label>Lote del Producto</label>
              <input type="text" name="lote_productou" id="lote_productou" class="form-control">
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 form-group">
              <label>Fecha Vencimiento</label>
              <input type="date" name="vencimientou" id="vencimientou" class="form-control" required="" onclick="this.showPicker()">
            </div>
            <div class="col-md-4 form-group">
              <label>Administración</label>
              <input type="text" name="administracionu" id="administracionu" class="form-control">
            </div>
            <div class="col-md-4 form-group">
              <label>Animales</label>
              <input type="number" name="animalesu" id="animalesu" class="form-control">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 form-group">
              <label>Galpón Tratado</label>
              <input type="text" name="galpon_tratadou" id="galpon_tratadou" class="form-control">
            </div>
          </div>
        </form>
      </div>
          <div class="modal-footer">
                <div class="row">
                    <div class="col-xs-6 text-left">
                        <button type="button" class="btn btn-danger" id="">
                            Eliminar
                        </button>
                    </div>
                    <div class="col-xs-6 text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal" id="actualizaDatosRegistroMedicamentos">
                            Actualizar
                        </button>
                    </div>
                </div>
            </div>
    </div>
  </div>
</div>