<?php
require '../modelo/datos-regional.php';
require '../modelo/datos-municipios.php';
require '../modelo/datos-centroFormacion.php';
require '../modelo/datos-sedes.php';
require '../modelo/datos-estadoReporte.php';
require '../modelo/datos-reporte.php';
require_once '../modelo/datos-edificio.php';
require_once '../modelo/datos-usuarios.php';
$mi_regional = new misRegionales();
$mis_ciudad = new misMunicipios();
$micentroFormaciones = new misCentrosFormacion();
$mis_sedes = new misSedes();
$miestadoReportes = new misEstadosReportes();
$mis_reporte = new misReportes();
$mis_edificios = new misEdificios();
$mis_usuarios = new misUsuarios();
// $mis_rol= new misRoles();
if ($rol_user == 1 || $rol_user == 4) {
	$no_modificar = "readonly";
} else {
	$no_modificar = "";
}
?>
<!-- MODAL PARA INSERTAR REGISTROS -->
<div class="modal fade" id="modalNuevoReporte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Agregar reporte</h4>
			</div>
			<div class="modal-body">
				<h1 class="text-center">Usuario</h1>
				<label>Nombre Usuario</label>
				<select name="usuario_id" id="usuario_id" class="form-control" required="">
					<option></option>
					<?php
					$res1 = $mis_usuarios->viewUsuarioOperador(1);
					$res2 = $mis_usuarios->viewUsuarioOperador(2);
					$res3 = $mis_usuarios->viewUsuarioOperador(4);
					$res = array_merge($res1, $res2, $res3);
					foreach ($res as $data) {
					?>
						<option value="<?php echo $data["numero_documento"]; ?>"><?php echo $data["numero_documento"]; ?> - <?php echo $data["nombre"]; ?></option>
					<?php
					}
					?>
				</select>
				<input type="hidden" id="nombre_usuario" class="form-control input-sm" value="<?php echo $data["nombre"]; ?>" required="">
				<!-- <div id="errorusuario_id"></div>
				<div id="errordescripcion_usuario"></div> -->
				<br />
				<label>Regional</label>
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
				<!-- <div id="errorregional_cod"></div> -->
				<br />
				<label>Centro formación </label>
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
				<!-- <div id="errorcentro_formacion_cod"></div> -->

				<label>Sede</label>
				<input type="text" id="sede" class="form-control input-sm" required="">
				<!-- <div id="errorsede_cod"></div> -->
				<br />
				<label>Lugar situacón</label>
				<input type="text" id="lugar_situacion" class="form-control input-sm" required="">
				<!-- <div id="errorlugar_situacion"></div> -->
				<br />
				<label>Descripción usuario</label>
				<textarea name="descripcion_usuario" id="descripcion_usuario" rows="4" cols="35"></textarea>
				<br />
				<label>Fecha registro</label>
				<input type="text" id="fecha_registro" class="form-control input-sm" value="<?php echo date("Y-m-d"); ?>" ; readonly required>
				<h1 class="text-center">Operador</h1>

				<label>Nombre Operador</label>
				<?php
				if ($rol_user == 1 || $rol_user == 2) {
				?>
					<select name="operador_id" id="operador_id" class="form-control" required="">
						<option></option>
						<?php
						$res = $mis_usuarios->viewUsuarioOperador(3);
						foreach ($res as $data) {
						?>
							<option value="<?php echo $data["numero_documento"]; ?>"><?php echo $data["numero_documento"]; ?> - <?php echo $data["nombre"]; ?></option>
						<?php
						}
						?>
					</select>
				<?php
				} else {
				?>
					<input type="hidden" class="form-control" id="operador_id" value="<?php echo "" ?>" placeholder="operador_id" <?php echo $no_modificar; ?> required>
					<input type="text" class="form-control" id="estado_reporte_id_vista" value="<?php echo "Nombre operador" ?>" placeholder="operador_id" <?php echo $no_modificar; ?> required>
				<?php
				}
				?>
				<input type="hidden" id="nombre_operador" class="form-control input-sm" - <?php echo $data["nombre"]; ?> required="">
				<br />
				<label>Fecha asignasión</label>
				<input type="date" id="fecha_asignacion" class="form-control input-sm" readonly required>
				<!-- <div id="errorfecha_asignacion"></div> -->
				<br />
				<!-- <label>Descripción operador</label>
				<input type="text" id="descripcion_operador" class="form-control input-sm" required="">
				<br /> -->
				<label>Fecha cierre</label>
				<input type="date" id="fecha_cierre" class="form-control input-sm" readonly required>
				<!-- <div id="errorfecha_cierre"></div> -->
				<br />
				<label>Estado reporte</label>
				<?php
				if ($rol_user == 0 || $rol_user == 0) {
				?>
					<select type="text" name="estado_reporte_id" id="estado_reporte_id" class="form-control" required>
						<?php
						$miestadoReporte = $miestadoReportes->viewEstadoReportes();
						foreach ($miestadoReporte as $value) { ?>
							<option value="<?php echo $value['id_estado_reporte'] ?>"><?php echo $value['estado'] ?></option>
						<?php
						}
						?>
					</select>
				<?php
				} else {
				?>
					<input type="hidden" class="form-control" id="estado_reporte_id" value="<?php echo 1 ?>" placeholder="estado_reporte_id" <?php echo $no_modificar; ?> required>
					<input type="text" class="form-control" id="estado_reporte_id_vista" value="<?php echo "Registrado" ?>" placeholder="estado_reporte_id" <?php echo $no_modificar; ?> required>
				<?php
				}
				?>
				<!-- <div id="errorestado_reporte_id"></div> -->
				<br />
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal" id="guardarNuevoReporte">
					Agregar
				</button>
			</div>
		</div>
	</div>
</div>
<!-- MODAL PARA EDICION DE DATOS-->
<div class="modal fade" id="modalEdicionReporte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Actualizar reporte</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" id="id_reporteu" class="form-control input-sm" readonly required>
				<input type="hidden" id="codigou" class="form-control input-sm" readonly required>
				<h1 class="text-center">Usuario</h1>
				<label>Consecutivo</label>
				<input type="text" id="consecutivou" class="form-control input-sm"  readonly required>
				<br />
				<label>Nombre Usuario</label>
				<select name="usuario_idu" id="usuario_idu" class="form-control" required="">
					<option></option>
					<?php
					$res1 = $mis_usuarios->viewUsuarioOperador(1);
					$res2 = $mis_usuarios->viewUsuarioOperador(2);
					$res3 = $mis_usuarios->viewUsuarioOperador(4);
					$res = array_merge($res1, $res2, $res3);
					foreach ($res as $data) {
					?>
						<option value="<?php echo $data["numero_documento"]; ?>"><?php echo $data["numero_documento"]; ?> - <?php echo $data["nombre"]; ?></option>
					<?php
					}
					?>

				</select>

				<!-- <input type="text" id="nombre_usuariou" class="form-control input-sm" value="" required=""> -->
				<br />
				<label>Regional</label>
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
				<label>Ciudad</label>
				<select type="text"  name="ciudadu" id="ciudadu" class="form-control" required>
                        <option selected></option>
                        <?php
                        $mi_ciudad = $mis_ciudad->viewMunicipios();
                        foreach ($mi_ciudad as $value) { ?>
                            <option value="<?php echo $value['municipios'] ?>"><?php echo $value['municipios'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
				<br />
				<label>Centro formación </label>
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
				<br/>
				<label>Edificio</label>
				<select type="text" name="edificio_reporteu" id="edificio_reporteu" class="form-control" required>
                        <option selected></option>
						<?php
                        $mi_edificio = $mis_edificios->viewEdificios();
                        foreach ($mi_edificio as $value) { ?>
                            <option value="<?php echo $value['edificio_reporte'] ?>"><?php echo $value['edificio_reporte'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
				<br />
				<label>Sede</label>
				<select type="text" name="sedeu" id="sedeu" class="form-control" required>
                        <option selected></option>
                        <?php
                        $misede = $mis_sedes->viewSedes();
                        foreach ($misede as $value) { ?>
                            <option value="<?php echo $value['direccion'] ?>"><?php echo $value['direccion'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
				<br />
				<label>Lugar situacón</label>
				<input type="text" id="lugar_situacionu" class="form-control input-sm" required="">
				<br />
				<label>Descripción usuario</label>
				<textarea name="descripcion_usuariou" id="descripcion_usuariou" rows="4" cols="35"></textarea>
				<br />
				<!-- <label>Fecha registro</label> -->
				<input type="hidden" id="fecha_registrou" class="form-control input-sm" readonly required>
				<h1 class="text-center">Operador</h1>
				<label>Nombre Operador</label>
				<select name="operador_idu" id="operador_idu" class="form-control" required="">
					<option></option>
					<?php
					$res = $mis_usuarios->viewUsuarioOperador(3);
					foreach ($res as $data) {
					?>
						<option value="<?php echo $data["numero_documento"]; ?>"><?php echo $data["numero_documento"]; ?> - <?php echo $data["nombre"]; ?></option>
					<?php
					}
					?>
				</select>
				<input type="hidden" id="nombre_operadoru" class="form-control input-sm" required="">
				<br />
				<label>Fecha asignación</label>
				<input type="date" id="fecha_asignacionu" class="form-control input-sm" value="<?php echo date("Y-m-d"); ?>" readonly required>
				<br />
				<!-- <label>Descripción operador</label>
				<input type="text" id="descripcion_operadoru" class="form-control input-sm" required="">
				<br /> -->
				<label>Fecha cierre</label>
				<input type="date" id="fecha_cierreu" class="form-control input-sm" value="<?php echo date("Y-m-d"); ?>"  readonly required>
				<br />
				<label>Estado reporte</label>
				<?php
				if ($codigo != 1) {
				?>
					<select type="text" name="estado_reporte_idu" id="estado_reporte_idu" class="form-control" required>
						<?php
						$miestadoReporte = $miestadoReportes->viewEstadoReportes();
						foreach ($miestadoReporte as $value) { ?>
							<option value="<?php echo $value['id_estado_reporte'] ?>"><?php echo $value['estado'] ?></option>
						<?php
						}
						?>
					</select>
				<?php
				} elseif ($codigo == 1) {
				?>
					<input type="hidden" id="estado_reporte_idu" class="form-control input-sm" <?php echo $no_modificar; ?> required>
					<input type="text" id="nom_estado_reporteu" class="form-control input-sm" value="<?php echo 'REGISTRADO' ?>" <?php echo $no_modificar; ?> required>
				<?php
				}
				?>
				<br />
				<label>Observaciones reporte</label>
				<textarea name="observacionesu" id="observacionesu" rows="4" cols="35"></textarea>
				<br />
			</div>
			<div class="modal-footer">
				<div class="col-sm-6 text-left">
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="eliminarDatosReporte">
						Eliminar
					</button>
				</div>
				<div class="col-sm-6 text-right">
					<button type="button" class="btn btn-warning" data-dismiss="modal" id="actualizaDatosReporte">
						Actualizar
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- modal para modificar los estados y observasiones -->
<div class="modal fade" id="modalEdicionObservacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Actualizar reporte</h4>
			</div>
			<div class="modal-body">
				<label>Item</label>
				<input type="text" id="id_reporteObu" class="form-control input-sm" readonly required>
				<br />
				<label>Estado reporte</label>
				<select name="estado_reporte_idObu" id="estado_reporte_idObu" class="form-control" <?php echo $no_modificar; ?> required="">
					<option></option>
					<option value="2">EN PROCESO</option>
					<option value="3">CERRADO</option>
					<option value="4">CANCELADO</option>
				</select>
				<br />
				<!-- <label>Observaciones reporte</label> -->
				<!-- <input type="date" id="fecha_cierreObu" class="form-control input-sm" value="<?php echo date("Y-m-d"); ?>"  readonly required> -->
				<br />
				<label>Observaciones reporte</label>
				<textarea name="observacionesObu" id="observacionesObu" rows="4" cols="35"></textarea>
				<br />
			</div>
			<div class="modal-footer">
				<div class="col-sm-6 text-left">
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="eliminarDatosReporteOb">
						Eliminar
					</button>
				</div>
				<div class="col-sm-6 text-right">
					<button type="button" class="btn btn-warning" data-dismiss="modal" id="actualizaDatosReporteOb">
						Actualizar
					</button>
				</div>
			</div>
		</div>
	</div>
</div>