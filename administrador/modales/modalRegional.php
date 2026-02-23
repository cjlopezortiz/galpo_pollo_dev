<?php
require '../modelo/datos-regional.php';
$mi_regional = new misRegionales();
?>
<!-- MODAL PARA INSERTAR REGISTROS -->
<div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Agregar regional</h4>
			</div>
			<div class="modal-body">
			<label>Nombre de la regional</label>
				<select type="text" name="nombre_regional" id="nombre_regional" class="form-control" required="">
					<option selected></option>
					<?php
					$miregional = $mi_regional->viewRegionales();
					foreach ($miregional as $value) { ?>
						<option value="<?php echo $value['cod_regional'] ?>"><?php echo $value['nombre_regional'] ?></option>
					<?php
					}
					?>
				</select>
				<div id="errornombre_regional"></div>
				<br />
				<label>Código de la regional</label>
				<input type="text" id="cod_regional" class="form-control input-sm" required="">
				<div id="errorcod_regional"></div>
				<br />
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="guardarNuevoRegional">
					Agregar
				</button>
			</div>
		</div>
	</div>
</div>
<!-- MODAL PARA EDICION DE DATOS-->
<div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Actualizar regional</h4>
			</div>
			<div class="modal-body">
				<label>Item de la regional</label>
				<input type="text" id="id_regionalu" class="form-control input-sm" readonly required>
				<label>Nombre de la regional</label>
				<select type="text" name="nombre_regionalu" id="nombre_regionalu" class="form-control" required="">
					<option selected></option>
					<?php
					$miregional = $mi_regional->viewRegionales();
					foreach ($miregional as $value) { ?>
						<option value="<?php echo $value['nombre_regional'] ?>"><?php echo $value['nombre_regional'] ?></option>
					<?php
					}
					?>
				</select>
				<br />
				<label>Código de la regional</label>
				<input type="text" id="cod_regionalu" class="form-control input-sm" required="">
				<br />
			</div>
			<div class="modal-footer">
				<div class="col-sm-6 text-left">
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="eliminarDatosRegional">
						Eliminar
					</button>
				</div>
				<div class="col-sm-6 text-right">
					<button type="button" class="btn btn-warning" data-dismiss="modal" id="actualizaDatosRegional">
						Actualizar
					</button>
				</div>
			</div>
		</div>
	</div>
</div>