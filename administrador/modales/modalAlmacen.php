<!-- MODAL PARA INSERTAR REGISTROS -->
<div class="modal fade" id="modalNuevoAlmacen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Agregar ITEM</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<style>
						.modal-body label {
							white-space: nowrap;
							/* No permite salto de línea */
							overflow: hidden;
							/* Oculta lo que no cabe */
							text-overflow: ellipsis;
							/* Agrega "..." cuando se corta */
							display: block;
							/* Mantiene el formato estable */
						}
					</style>
					<!-- ITEM Y CODIGO -->
					<div class="col-md-6">
						<label>...</label>
						<input type="text" class="form-control input-sm" readonly required>
					</div>

					<div class="col-md-6">
						<label>Código cosecha</label>
						<input type="number" id="codigo_orions" name="codigo_orions" class="form-control input-sm" required>
					</div>

					<div class="text-center" id="errorcodigo_orions"></div>

					<div class="w-100"><br></div>

					<!-- CLORO -->
					<div class="col-md-6">
						<label>Cantidad Cloro</label>
						<input type="number" id="cloro" name="cloro" class="form-control input-sm" required>
					</div>

					<div class="col-md-6">
						<label>Precio cloro</label>
						<input type="number" id="precio_cloro" name="precio_cloro" class="form-control input-sm" required>
					</div>

					<div class="w-100"><br></div>

					<!-- VINAGRE -->
					<div class="col-md-6">
						<label>Cantidad Vinagre</label>
						<input type="number" id="vinagre" name="vinagre" class="form-control input-sm" required>
					</div>

					<div class="col-md-6">
						<label>Precio vinagre</label>
						<input type="number" id="precio_vinagre" name="precio_vinagre" class="form-control input-sm" required>
					</div>

					<div class="w-100"><br></div>

					<!-- YODO -->
					<div class="col-md-6">
						<label>Cantidad Yodo</label>
						<input type="number" id="yodo" name="yodo" class="form-control input-sm" required>
					</div>

					<div class="col-md-6">
						<label>Precio yodo</label>
						<input type="number" id="precio_yodo" name="precio_yodo" class="form-control input-sm" required>
					</div>

					<div class="w-100"><br></div>

					<!-- ACIDO ACÉTICO -->
					<div class="col-md-6">
						<label>Cantidad Ácido</label>
						<input type="number" id="hacido_hacetico" name="hacido_hacetico" class="form-control input-sm" required>
					</div>

					<div class="col-md-6">
						<label>Precio ácido</label>
						<input type="number" id="precio_hacido" name="precio_hacido" class="form-control input-sm" required>
					</div>

					<div class="w-100"><br></div>

					<!-- VITAMINAS -->
					<div class="col-md-6">
						<label>Cantidad vitamina</label>
						<input type="number" id="vitaminas" name="vitaminas" class="form-control input-sm" required>
					</div>

					<div class="col-md-6">
						<label>Precio vitamina</label>
						<input type="number" id="precio_vitamina" name="precio_vitamina" class="form-control input-sm" required>
					</div>

					<div class="w-100"><br></div>

					<!-- ANORES -->
					<div class="col-md-6">
						<label>Cantidad Anores</label>
						<input type="number" id="anores" name="anores" class="form-control input-sm" required>
					</div>

					<div class="col-md-6">
						<label>Precio Anores</label>
						<input type="number" id="precio_anores" name="precio_anores" class="form-control input-sm" required>
					</div>

					<div class="w-100"><br></div>

					<!-- VACUNAS -->
					<div class="col-md-6">
						<label>Cantidad Vacunas</label>
						<input type="number" id="vacunas" name="vacunas" class="form-control input-sm" required>
					</div>

					<div class="col-md-6">
						<label>Precio Vacunas</label>
						<input type="number" id="precio_vacunas" name="precio_vacunas" class="form-control input-sm" required>
					</div>

					<div class="w-100"><br></div>

					<!-- RESPIROS -->
					<div class="col-md-6">
						<label>Cantidad Respiros</label>
						<input type="number" id="respiros" name="respiros" class="form-control input-sm" required>
					</div>

					<div class="col-md-6">
						<label>Precio Respiros</label>
						<input type="number" id="precio_respiros" name="precio_respiros" class="form-control input-sm" required>
					</div>

					<div class="w-100"><br></div>

					<!-- TAMO -->
					<div class="col-md-6">
						<label>Cantidad Tamo</label>
						<input type="number" id="tamo" name="tamo" class="form-control input-sm" required>
					</div>

					<div class="col-md-6">
						<label>Precio Tamo</label>
						<input type="number" id="precio_tamo" name="precio_tamo" class="form-control input-sm" required>
					</div>

					<div class="w-100"><br></div>

					<!-- CAL -->
					<div class="col-md-6">
						<label>Cantidad Cal</label>
						<input type="number" id="cal" name="cal" class="form-control input-sm" required>
					</div>

					<div class="col-md-6">
						<label>Precio Cal</label>
						<input type="number" id="precio_cal" name="precio_cal" class="form-control input-sm" required>
					</div>

					<div class="w-100"><br></div>

					<!-- ANTIBIOTICO -->
					<div class="col-md-6">
						<label>Cantidad Antibiótico</label>
						<input type="number" id="antibiotico" name="antibiotico" class="form-control input-sm" required>
					</div>

					<div class="col-md-6">
						<label>Precio Antibiótico</label>
						<input type="number" id="precio_antibiotico" name="precio_antibiotico" class="form-control input-sm" required>
					</div>

					<div class="w-100"><br></div>

					<!-- ABC -->
					<div class="col-md-6">
						<label>Cantidad ABC</label>
						<input type="number" id="abc" name="abc" class="form-control input-sm" required>
					</div>

					<div class="col-md-6">
						<label>Precio ABC</label>
						<input type="number" id="precio_abc" name="precio_abc" class="form-control input-sm" required>
					</div>

					<div class="w-100"><br></div>

					<!-- VICARBONATO -->
					<div class="col-md-6">
						<label>Cantidad Vicarbonato</label>
						<input type="number" id="vicarbonato" name="vicarbonato" class="form-control input-sm" required>
					</div>

					<div class="col-md-6">
						<label>Precio Vicarbonato</label>
						<input type="number" id="precio_vicarbonato" name="precio_vicarbonato" class="form-control input-sm" required>
					</div>

					<div class="w-100"><br></div>

					<!-- MELASA -->
					<div class="col-md-6">
						<label>Cantidad Melasa</label>
						<input type="number" id="melasa" name="melasa" class="form-control input-sm" required>
					</div>

					<div class="col-md-6">
						<label>Precio Melasa</label>
						<input type="number" id="precio_melasa" name="precio_melasa" class="form-control input-sm" required>
					</div>

					<div class="w-100"><br></div>

					<!-- AGUA POTABLE -->
					<div class="col-md-6">
						<label>Cantidad Agua Potable</label>
						<input type="number" id="agua_potable" name="agua_potable" class="form-control input-sm" required>
					</div>

					<div class="col-md-6">
						<label>Precio Agua Potable</label>
						<input type="number" id="precio_agua" name="precio_agua" class="form-control input-sm" required>
					</div>
					<div class="w-100"><br></div>

					<!-- AGUA LUZ -->
					<div class="col-md-6">
						<label>Luz galpón</label>
						<input type="number" id="luz" name="luz" class="form-control input-sm" required>
					</div>

					<div class="col-md-6">
						<label>Precio Luz galpón</label>
						<input type="number" id="precio_luz" name="precio_luz" class="form-control input-sm" required>
					</div>

					<div class="w-100"><br></div>
					<!-- ARRIENDO -->
					<div class="col-md-6">
						<label>Arriendo galpón</label>
						<input type="number" id="arriendo" name="arriendo" class="form-control input-sm" required>
					</div>

					<div class="col-md-6">
						<label>Precio Arriendo galpón</label>
						<input type="number" id="precio_arriendo" name="precio_arriendo" class="form-control input-sm" required>
					</div>
					<div class="w-100"><br></div>

					<!-- GASTOS VARIOS -->
					<div class="col-md-6">
						<label>Cantidad Gast varios</label>
						<input type="number" id="gastos_varios" name="gastos_varios" rows="4" class="form-control"></textarea>
					</div>

					<div class="col-md-6">
						<label>Precio Gast varios</label>
						<input type="number" id="precio_gastos_varios" name="precio_gastos_varios" rows="4" class="form-control"></textarea>
					</div>

					<div class="w-100"><br></div>
					<!-- OBSERVACIONES -->
					<!-- <div class="col-md-12">
						<label>Observación cosecha</label>
						<textarea id="descripcion_material" name="descripcion_material" rows="4" class="form-control"></textarea>
					</div> -->

				</div>
			</div>

			<div class="modal-footer">
				<div class="text-center" class="close">
					<button type="button" class="btn btn-primary" id="guardarNuevoAlmacen">
						Agregar
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- MODAL PARA EDICION DE DATOS-->
<div class="modal fade" id="modalEdicionAmacen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Actualizar almacen</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="modal-body">
						<div class="row">
							<style>
								.modal-body label {
									white-space: nowrap;
									/* No permite salto de línea */
									overflow: hidden;
									/* Oculta lo que no cabe */
									text-overflow: ellipsis;
									/* Agrega "..." cuando se corta */
									display: block;
									/* Mantiene el formato estable */
								}
							</style>
							<!-- ITEM Y CODIGO -->
							<div class="col-md-6">
								<label>Item</label>
								<input type="text" id="codigou" class="form-control input-sm" readonly required>
							</div>

							<div class="col-md-6">
								<label>Código cosecha</label>
								<input type="number" id="codigo_orionsu" name="codigo_orionsu" class="form-control input-sm" readonly required>
							</div>

							<div class="w-100"><br></div>

							<!-- KG -->
							<div class="col-md-6">
								<label>Cantidad total Kg</label>
								<input type="number" id="cantidad_totalu" name="cantidad_totalu" class="form-control input-sm" required>
							</div>

							<div class="col-md-6">
								<label>Precio por Kg</label>
								<input type="number" id="precio_kilou" name="precio_kilou" class="form-control input-sm" required>
							</div>

							<div class="w-100"><br></div>

							<!-- CLORO -->
							<div class="col-md-6">
								<label>Cantidad Cloro</label>
								<input type="number" id="clorou" name="clorou" class="form-control input-sm" required>
							</div>

							<div class="col-md-6">
								<label>Precio cloro</label>
								<input type="number" id="precio_clorou" name="precio_clorou" class="form-control input-sm" required>
							</div>

							<div class="w-100"><br></div>

							<!-- VINAGRE -->
							<div class="col-md-6">
								<label>Cantidad Vinagre</label>
								<input type="number" id="vinagreu" name="vinagreu" class="form-control input-sm" required>
							</div>

							<div class="col-md-6">
								<label>Precio vinagre</label>
								<input type="number" id="precio_vinagreu" name="precio_vinagreu" class="form-control input-sm" required>
							</div>

							<div class="w-100"><br></div>

							<!-- YODO -->
							<div class="col-md-6">
								<label>Cantidad Yodo</label>
								<input type="number" id="yodou" name="yodou" class="form-control input-sm" required>
							</div>

							<div class="col-md-6">
								<label>Precio yodo</label>
								<input type="number" id="precio_yodou" name="precio_yodou" class="form-control input-sm" required>
							</div>

							<div class="w-100"><br></div>

							<!-- ACIDO ACÉTICO -->
							<div class="col-md-6">
								<label>Cantidad Ácido</label>
								<input type="number" id="hacido_haceticou" name="hacido_haceticou" class="form-control input-sm" required>
							</div>

							<div class="col-md-6">
								<label>Precio ácido</label>
								<input type="number" id="precio_hacidou" name="precio_hacidou" class="form-control input-sm" required>
							</div>

							<div class="w-100"><br></div>

							<!-- VITAMINAS -->
							<div class="col-md-6">
								<label>Cantidad vitamina</label>
								<input type="number" id="vitaminasu" name="vitaminasu" class="form-control input-sm" required>
							</div>

							<div class="col-md-6">
								<label>Precio vitamina</label>
								<input type="number" id="precio_vitaminau" name="precio_vitaminau" class="form-control input-sm" required>
							</div>

							<div class="w-100"><br></div>

							<!-- ANORES -->
							<div class="col-md-6">
								<label>Cantidad Anores</label>
								<input type="number" id="anoresu" name="anoresu" class="form-control input-sm" required>
							</div>

							<div class="col-md-6">
								<label>Precio Anores</label>
								<input type="number" id="precio_anoresu" name="precio_anoresu" class="form-control input-sm" required>
							</div>

							<div class="w-100"><br></div>

							<!-- VACUNAS -->
							<div class="col-md-6">
								<label>Cantidad Vacunas</label>
								<input type="number" id="vacunasu" name="vacunasu" class="form-control input-sm" required>
							</div>

							<div class="col-md-6">
								<label>Precio Vacunas</label>
								<input type="number" id="precio_vacunasu" name="precio_vacunasu" class="form-control input-sm" required>
							</div>

							<div class="w-100"><br></div>

							<!-- RESPIROS -->
							<div class="col-md-6">
								<label>Cantidad Respiros</label>
								<input type="number" id="respirosu" name="respirosu" class="form-control input-sm" required>
							</div>

							<div class="col-md-6">
								<label>Precio Respiros</label>
								<input type="number" id="precio_respirosu" name="precio_respirosu" class="form-control input-sm" required>
							</div>

							<div class="w-100"><br></div>

							<!-- TAMO -->
							<div class="col-md-6">
								<label>Cantidad Tamo</label>
								<input type="number" id="tamou" name="tamou" class="form-control input-sm" required>
							</div>

							<div class="col-md-6">
								<label>Precio Tamo</label>
								<input type="number" id="precio_tamou" name="precio_tamou" class="form-control input-sm" required>
							</div>

							<div class="w-100"><br></div>

							<!-- CAL -->
							<div class="col-md-6">
								<label>Cantidad Cal</label>
								<input type="number" id="calu" name="calu" class="form-control input-sm" required>
							</div>

							<div class="col-md-6">
								<label>Precio Cal</label>
								<input type="number" id="precio_calu" name="precio_calu" class="form-control input-sm" required>
							</div>

							<div class="w-100"><br></div>

							<!-- ANTIBIOTICO -->
							<div class="col-md-6">
								<label>Cantidad Antibiótico</label>
								<input type="number" id="antibioticou" name="antibioticou" class="form-control input-sm" required>
							</div>

							<div class="col-md-6">
								<label>Precio Antibiótico</label>
								<input type="number" id="precio_antibioticou" name="precio_antibioticou" class="form-control input-sm" required>
							</div>

							<div class="w-100"><br></div>

							<!-- ABC -->
							<div class="col-md-6">
								<label>Cantidad ABC</label>
								<input type="number" id="abcu" name="abcu" class="form-control input-sm" required>
							</div>

							<div class="col-md-6">
								<label>Precio ABC</label>
								<input type="number" id="precio_abcu" name="precio_abcu" class="form-control input-sm" required>
							</div>

							<div class="w-100"><br></div>

							<!-- VICARBONATO -->
							<div class="col-md-6">
								<label>Cantidad Vicarbonato</label>
								<input type="number" id="vicarbonatou" name="vicarbonatou" class="form-control input-sm" required>
							</div>

							<div class="col-md-6">
								<label>Precio Vicarbonato</label>
								<input type="number" id="precio_vicarbonatou" name="precio_vicarbonatou" class="form-control input-sm" required>
							</div>

							<div class="w-100"><br></div>

							<!-- MELASA -->
							<div class="col-md-6">
								<label>Cantidad Melasa</label>
								<input type="number" id="melasau" name="melasau" class="form-control input-sm" required>
							</div>

							<div class="col-md-6">
								<label>Precio Melasa</label>
								<input type="number" id="precio_melasau" name="precio_melasau" class="form-control input-sm" required>
							</div>

							<div class="w-100"><br></div>

							<!-- AGUA POTABLE -->
							<div class="col-md-6">
								<label>Cantidad Agua Potable</label>
								<input type="number" id="agua_potableu" name="agua_potableu" class="form-control input-sm" required>
							</div>

							<div class="col-md-6">
								<label>Precio Agua Potable</label>
								<input type="number" id="precio_aguau" name="precio_aguau" class="form-control input-sm" required>
							</div>
							<div class="w-100"><br></div>

							<!-- AGUA LUZ -->
							<div class="col-md-6">
								<label>Luz galpón</label>
								<input type="number" id="luzu" name="luzu" class="form-control input-sm" required>
							</div>

							<div class="col-md-6">
								<label>Precio Luz galpón</label>
								<input type="number" id="precio_luzu" name="precio_luzu" class="form-control input-sm" required>
							</div>

							<div class="w-100"><br></div>
							<!-- ARRIENDO -->
							<div class="col-md-6">
								<label>Arriendo galpón</label>
								<input type="number" id="arriendou" name="arriendou" class="form-control input-sm" required>
							</div>

							<div class="col-md-6">
								<label>Precio Arriendo galpón</label>
								<input type="number" id="precio_arriendou" name="precio_arriendou" class="form-control input-sm" required>
							</div>
							<div class="w-100"><br></div>

							<!-- GASTOS VARIOS -->
							<div class="col-md-6">
								<label>Cantidad Gastos Varios</label>
								<input
									type="number"
									id="gastos_variosu"
									name="gastos_variosu"
									class="form-control"
									value="1"
									readonly>
							</div>
							<div class="col-md-6">
								<label>Precio Gast varios</label>
								<input type="number" id="precio_gastos_variosu" name="precio_gastos_variosu" rows="4" class="form-control" onfocus="mostrarAvisoGastos()"
									onblur="ocultarAvisoGastos()">
								<!-- Aviso (oculto por defecto y alineado) -->
								<div
									id="avisoGastos"
									class="alert alert-warning mt-2 py-2 px-3"
									style="display:none; width:100%;">
									<small>
										⚠️ <strong>Nota:</strong> Solo se permiten valores positivos para sumar gastos.
									</small>
								</div>
								<script>
									function mostrarAvisoGastos() {
										document.getElementById('avisoGastos').style.display = 'block';
									}

									function ocultarAvisoGastos() {
										document.getElementById('avisoGastos').style.display = 'none';
									}
								</script>
							</div>

							<div class="w-100"><br></div>
							<!-- OBSERVACIONES -->
							<!-- <div class="col-md-12">
								<label>Observación cosecha</label>
								<textarea id="descripcion_materialu" name="descripcion_materialu" rows="4" class="form-control"></textarea>
							</div> -->

						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<div class="col-sm-6 text-left">
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="eliminarDatosAlmecen">
						Eliminar
					</button>
				</div>
				<div class="col-sm-6 text-right">
					<button type="button" class="btn btn-warning" data-dismiss="modal" id="actualizaDatosAlmacen">
						Actualizar
					</button>
				</div>
			</div>
		</div>
	</div>

</div>