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
				<h4 class="modal-title" id="myModalLabel">Agregar centro formación</h4>
			</div>
			<div class="modal-body">
				<label>Código de la regional</label>
				<select type="text" name="regional_cod" id="regional_cod" class="form-control" required="">
					<option selected></option>
					<?php
					$miregional = $mi_regional->viewRegionales();
					foreach ($miregional as $value) { ?>
						<option value="<?php echo $value['cod_regional'] ?>"><?php echo $value['nombre_regional'] ?></option>
					<?php
					}
					?>
				</select>
				<div id="errorregioncod"></div>
				<br />
				<label>Código del centro formacion</label>
				<input type="number" id="cod_centro_formacion" class="form-control input-sm" required="">
				<div id="errorcodcentro"></div>
				<br />
                <label>Sigla</label>
				<input type="text" id="sigla" class="form-control input-sm" required="">
				<div id="errorsigla"></div>
				<br />
                <label>Nombre centro formación</label>
				<textarea id="nombre_centro" name="nombre_centro" rows="4" cols="34"></textarea>
				<div id="errornombrecentro"></div>
				<br />
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary"  id="guardarNuevoCentroFormacion">
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
				<h4 class="modal-title" id="myModalLabel">Actualizar centro formación</h4>
			</div>
			<div class="modal-body">
                <label>Codígo</label>
				<input type="text" id="id_centrou" class="form-control input-sm" disabled>
				<br />
				<label>Código dela regional</label>
				<select type="text" name="regional_codu" id="regional_codu" class="form-control" required="">
					<option selected></option>
					<?php
					$miregional = $mi_regional->viewRegionales();
					foreach ($miregional as $value) { ?>
						<option value="<?php echo $value['cod_regional'] ?>"><?php echo $value['nombre_regional'] ?></option>
					<?php
					}
					?>
				</select>
				<br />
				<label>Código centro formacion</label>
				<input type="number" id="cod_centro_formacionu" class="form-control input-sm" required="">
				<br />
                <label>Sigla</label>
				<input type="text" id="siglau" class="form-control input-sm" required="">
				<br />
                <label>Nombre centro de formación</label>
				<textarea id="nombre_centrou" name="nombre_centrou" rows="4" cols="34"></textarea>
				<br />
			</div>
			<div class="modal-footer">
				<div class="col-sm-6 text-left">
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="eliminarDatosCentroFormacion">
						Eliminar
					</button>
				</div>
				<div class="col-sm-6 text-right">
					<button type="button" class="btn btn-warning" data-dismiss="modal" id="actualizaDatosCentroFormacion">
						Actualizar
					</button>
				</div>
			</div>
		</div>
	</div>
</div>