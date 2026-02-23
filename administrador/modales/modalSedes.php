<?php
require '../modelo/datos-centroFormacion.php';
$micentroFormaciones = new misCentrosFormacion();
require '../modelo/datos-municipios.php';
$misMunicipios = new misMunicipios();
?>
<!-- MODAL PARA INSERTAR REGISTROS -->
<div class="modal fade" id="modalNuevoSedes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Agregar sedes</h4>
			</div>
			<div class="modal-body">
				<label>Centro formación</label>
				<select type="text" name="centro_formacion_cod" id="centro_formacion_cod" class="form-control" required>
					<option selected></option>
					<?php
					$micentroFormacion = $micentroFormaciones->viewCentrosFormacion();
					foreach ($micentroFormacion as $value) { ?>
						<option value="<?php echo $value['cod_centro_formacion'] ?>"><?php echo $value['nombre_centro'] ?></option>
					<?php
					}
					?>
				</select>
				<div id="errorcentroformacion"></div>
				<br />
				<label>Código sede</label>
				<input type="text" id="codigo_sede" class="form-control input-sm" required="">
				<div id="errorcodigosede"></div>
				<br />
                <label>Sede</label>
				<select type="text" name="municipioLocalidad" id="municipioLocalidad" class="form-control" required>
                    <option selected></option>
                    <?php
                    $municipio = $misMunicipios->viewMunicipios();
                    foreach ($municipio as $value) { ?>
                        <option value="<?php echo $value['municipios'] ?>"><?php echo $value['municipios'] ?></option>
                    <?php
                    }
                    ?>
                </select>
				<!-- <input type="text" id="sede" class="form-control input-sm" required=""> -->
				<div id="errorsedes"></div>
				<br />
                <label>Dirección</label>
				<input type="text" id="direccion" class="form-control input-sm" required="">
				<div id="errordireccionsede"></div>
				<br />
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="guardarNuevoSedes">
					Agregar
				</button>
			</div>
		</div>
	</div>
</div>
<!-- MODAL PARA EDICION DE DATOS-->
<div class="modal fade" id="modalEdicionSedes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
				<input type="text" id="id_sedeu" class="form-control input-sm" readonly required>
				<br/>
                <label>Centro formación</label>
				<select type="text" name="centro_formacion_codu" id="centro_formacion_codu" class="form-control" required>
					<option selected></option>
					<?php
					$micentroFormacion = $micentroFormaciones->viewCentrosFormacion();
					foreach ($micentroFormacion as $value) { ?>
						<option value="<?php echo $value['cod_centro_formacion'] ?>"><?php echo $value['nombre_centro'] ?></option>
					<?php
					}
					?>
				</select>
				<br />
				<label>Código sede</label>
				<input type="text" id="codigo_sedeu" class="form-control input-sm" required="">
				<br />
                <label>Sede</label>
				<select type="text" name="municipioLocalidadu" id="municipioLocalidadu" class="form-control" required>
                    <option selected></option>
                    <?php
                    $municipio = $misMunicipios->viewMunicipios();
                    foreach ($municipio as $value) { ?>
                        <option value="<?php echo $value['municipios'] ?>"><?php echo $value['municipios'] ?></option>
                    <?php
                    }
                    ?>
                </select>
				<!-- <input type="text" id="sedeu" class="form-control input-sm" required=""> -->
				<br />
                <label>Dirección</label>
				<input type="text" id="direccionu" class="form-control input-sm" required="">
				<br />
			</div>
			<div class="modal-footer">
				<div class="col-sm-6 text-left">
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="eliminarDatosSedes">
						Eliminar
					</button>
				</div>
				<div class="col-sm-6 text-right">
					<button type="button" class="btn btn-warning" data-dismiss="modal" id="actualizaDatosSedes">
						Actualizar
					</button>
				</div>
			</div>
		</div>
	</div>
</div>