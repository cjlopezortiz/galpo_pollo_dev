<!-- MODAL PARA INSERTAR REGISTROS -->
<div class="modal fade" id="modalNuevoEstadoReporte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Agregar un estado de reporte</h4>
			</div>
			<div class="modal-body">
		    	<label>Código estado</label>
				<input type="text" id="id_estado_reporte" class="form-control input-sm" required>
				<div id="errorid_estado_reporte"></div>
				<br/>
				<label>Estado</label>
				<select type="text" name="estado" id="estado" class="form-control" required>
					<option></option>
					<option value="REGISTRADO">REGISTRADO</option>
					<option value="EN PROCESO">EN PROCESO</option>
					<option value="CERRADO">CERRADO</option>
					<option value="CANCELADO">CANCELADO</option>
				</select>
				<div id="errorestadoreporte"></div>
				<br />
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="guardarNuevoEstadoReporte">
					Agregar
				</button>
			</div>
		</div>
	</div>
</div>
<!-- MODAL PARA EDICION DE DATOS-->
<div class="modal fade" id="modalEdicionEstadoReporte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Actualizar almacen</h4>
			</div>
			<div class="modal-body">
			<label>Item</label>
				<input type="text" id="id_estado_repu" class="form-control input-sm" readonly required>
				<br/>
				<label>Código estado</label>
				<input type="text" id="id_estado_reporteu" class="form-control input-sm" readonly required>
				<br/>
				<label>Estado</label>
				<select type="text" name="estadou" id="estadou" class="form-control" required>
					<option></option>
					<option value="REGISTRADO">REGISTRADO</option>
					<option value="EN PROCESO">EN PROCESO</option>
					<option value="CERRADO">CERRADO</option>
					<option value="CANCELADO">CANCELADO</option>
				</select>
				<br />
			</div>
			<div class="modal-footer">
				<div class="col-sm-6 text-left">
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="eliminarDatosEstadoReporte">
						Eliminar
					</button>
				</div>
				<div class="col-sm-6 text-right">
					<button type="button" class="btn btn-warning" data-dismiss="modal" id="actualizaDatosEstadoReporte">
						Actualizar
					</button>
				</div>
			</div>
		</div>
	</div>
</div>