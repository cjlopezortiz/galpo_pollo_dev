<!-- MODAL PARA INSERTAR REGISTROS -->
<div class="modal fade" id="modalNuevoDocumento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Agregar un documento</h4>
			</div>
			<div class="modal-body">
			    <label>Sigla</label>
				<input type="text" id="sigla" class="form-control input-sm" required="">
				<div id="errorsigla"></div>
				<br />
                <label>Nombre</label>
				<input type="text" id="nombre" class="form-control input-sm" required="">
				<div id="errornombre_cedula"></div>
				<br />
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="guardarNuevoDocumento">
					Agregar
				</button>
			</div>
		</div>
	</div>
</div>
<!-- MODAL PARA EDICION DE DATOS-->
<div class="modal fade" id="modalEdicionDocumentos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Actualizar</h4>
			</div>
			<div class="modal-body">
				<label>Item</label>
				<input type="text" id="id_tipo_documentou" class="form-control input-sm" readonly required>
				<br/>
				<label>Sigla</label>
				<input type="text" id="siglau" class="form-control input-sm" required="">
				<br />
                <label>Nombre</label>
				<input type="text" id="nombreu" class="form-control input-sm" required="">
				<br />
			</div>
			<div class="modal-footer">
				<div class="col-sm-6 text-left">
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="eliminarDatosDocumento">
						Eliminar
					</button>
				</div>
				<div class="col-sm-6 text-right">
					<button type="button" class="btn btn-warning" data-dismiss="modal" id="actualizaDatosDocumento">
						Actualizar
					</button>
				</div>
			</div>
		</div>
	</div>
</div>