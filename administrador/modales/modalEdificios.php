<!-- MODAL PARA INSERTAR REGISTROS -->
<div class="modal fade" id="modalNuevoEdificios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Agregar edificios</h4>
            </div>
            <div class="modal-body">
                <label>Edificios</label>
                <textarea name="edificio_reporte" id="edificio_reporte" rows="4" cols="35"></textarea>
                <br />
                <div id="erroredificio_reporte"></div>
                <br />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="guardarNuevoEdificios">
                    Agregar
                </button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL PARA EDICION DE DATOS-->
<div class="modal fade" id="modalEdicionEdificios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Actualizar EDIFICIO</h4>
            </div>
            <div class="modal-body">
                <label>Item</label>
                <input type="text" id="codigou" class="form-control input-sm" readonly required>
                <br />
                <label>Edificios</label>
				<textarea name="edificio_reporteu" id="edificio_reporteu" rows="4" cols="35"></textarea>
                <br />
            </div>
            <div class="modal-footer">
                <div class="col-sm-6 text-left">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="eliminarDatosEdificios">
                        Eliminar
                    </button>
                </div>
                <div class="col-sm-6 text-right">
                    <button type="button" data-dismiss="modal" class="btn btn-warning"  id="actualizaDatosEdificios">
                        Actualizar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>