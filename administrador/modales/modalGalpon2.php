<!-- MODAL PARA INSERTAR REGISTROS -->
<div class="modal fade" id="modalNuevoGalpon2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Agregar Casecha</h4>
			</div>
			<div class="modal-body">
				<label>Codigo de la Cosecha</label>
				<input type="number" id="codigo_orions" name="codigo_orions" class="form-control input-sm" readonly required>
				<div class="text-center" id="errorcodigo_orions2"></div>
				<br />
				<label>Fecha Inicio</label>
				<input type="date" id="fecha_inicio" class="form-control input-sm" required>
				<div class="text-center" id="errorfecha_inicio2"></div>
				<br />
				<label>Cantidad Pollos</label>
				<input type="number" id="cantidad_pollo" name="cantidad_pollo" class="form-control input-sm" placeholder="Cantidad pollos" required>
				<div class="text-center" id="errorcantidad_pollo2"></div>
				<br />
				<label><strong>Precio Semilla (por unidad)</strong></label>
				<input type="number" id="precio_pollo" name="precio_pollo" class="form-control input-sm" placeholder="Precio semilla (por unidad)" required>
				<div class="text-center" id="errorprecio_pollo2"></div>
				<br />
				<label>Tipo Alimento</label>
				<input type="text" id="tipo_alimento" name="tipo_alimento" class="form-control input-sm" placeholder="Tipo alimento " required>
				<div class="text-center" id="errortipo_alimento2"></div>
				<br />
				<label>Cantidad Alimento Inicio</label>
				<input type="number" id="alimento_inicio" name="alimento_inicio" class="form-control input-sm" placeholder="Alimento inicio " required>
				<div class="text-center" id="erroralimento_inicio2"></div>
				<br />
				<label>Precio Alimento Inicio (por costal)</label>
				<input type="number" id="precio_inicio" name="precio_inicio" class="form-control input-sm" placeholder="Alimento Preinicio" required>
				<div class="text-center" id="errorprecio_inicio2"></div>
				<br />
				<label>Cantidad Alimento Crecimiento</label>
				<input type="number" id="alimento_preinicio" name="alimento_preinicio" class="form-control input-sm" placeholder="Alimento inicio " required>
				<div class="text-center" id="erroralimento_preinicio2"></div>
				<br />
				<label>Precio Alimento Crecimiento (por costal) </label>
				<input type="number" id="precio_preinicio" name="precio_preinicio" class="form-control input-sm" placeholder="Alimento Preinicio" required>
				<div class="text-center" id="errorprecio_preinicio2"></div>
				<br />
				<label>Cantidad Alimento Engorde</label>
				<input type="number" id="cantidad" name="cantidad" class="form-control input-sm" placeholder="Cantidad alimento" required>
				<div class="text-center" id="errorcantidad2"></div>
				<br />
				<label><strong>Precio Alimento (por costal)</strong></label>
				<input type="number" id="precio_alimento" name="precio_alimento" class="form-control input-sm" placeholder="Precio alimento (por costal)" required>
				<div class="text-center" id="errorprecio_alimento2"></div>
				<br />
				<label>Color</label>
				<input type="text" id="color" name="color" class="form-control input-sm" placeholder="Color" required>
				<div class="text-center" id="errorcolor2"></div>
				<br />
				<label>Mortanda Cosecha</label>
				<input type="number" id="fayido" name="fayido" class="form-control input-sm" placeholder="Mortanda cosecha" required>
				<div class="text-center" id="errorfayido2"></div>
				<br />
				<label>Fecha Fin</label>
				<input type="date" id="fecha_fin" class="form-control input-sm" required>
				<div class="text-center" id="errorfecha_fin2"></div>
				<br />
				<label>Observaciones</label>
				<textarea id="descripcion" name="descripcion" rows="4" cols="34" placeholder="Observaciones"></textarea>
				<div class="text-center" id="errordescripcion2"></div>
				<br />

			</div>
			<div class="modal-footer">
				<div class="text-center">
					<button type="button" class="btn btn-primary" class="close" id="guardarNuevoGalpon2">
						Agregar cosecha
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- MODAL PARA EDICION DE DATOS-->
<div class="modal fade" id="modalEdicionGalpon2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Actualizar informacion</h4>
			</div>
			<div class="modal-body">
				<label>Item</label>
				<input type="text" id="codigou" name="codigou" class="form-control input-sm" readonly required>
				<br />
				<label>Codigo de la Cosecha</label>
				<input type="number" id="codigo_orionsu" name="codigo_orionsu" class="form-control input-sm" readonly required>
				<br />
				<label>Fecha Inicio</label>
				<input type="date" id="fecha_iniciou" name="fecha_iniciou" class="form-control input-sm" required="">
				<br />
				<label>Cantidad Pollos</label>
				<input type="number" id="cantidad_pollou" name="cantidad_pollou" class="form-control input-sm" required="">
				<br />
				<label><strong>Precio Semilla (por unidad)</strong></label>
				<input type="number" id="precio_pollou" name="precio_pollou" class="form-control input-sm" required>
				<br />
				<label>Tipo Alimento</label>
				<textarea id="tipo_alimentou" name="tipo_alimentou" rows="4" cols="34"></textarea>
				<br />
				<label>Cantidad Alimento Inicio</label>
				<input type="number" id="alimento_iniciou" name="alimento_iniciou" class="form-control input-sm" placeholder="Alimento inicio " required>
				<br />
				<label>Precio Alimento Inicio (por costal)</label>
				<input type="number" id="precio_iniciou" name="precio_iniciou" class="form-control input-sm" placeholder="Alimento Preinicio" required>
				<br />
				<label>Cantidad Alimento Crecimiento</label>
				<input type="number" id="alimento_preiniciou" name="alimento_preiniciou" class="form-control input-sm" placeholder="Alimento inicio " required>
				<br />
				<label>Precio Alimento Crecimiento (por costal)</label>
				<input type="number" id="precio_preiniciou" name="precio_preiniciou" class="form-control input-sm" placeholder="Alimento Preinicio" required>
				<br />
				<label>Cantidad alimento Engorde</label>
				<input type="number" id="cantidadu" name="cantidadu" class="form-control input-sm" required="">
				<br />
				<label><strong>Precio alimento (por costal)</strong></label>
				<input type="number" id="precio_alimentou" name="precio_alimentou" class="form-control input-sm" required>
				<br />
				<label>Color</label>
				<input type="text" id="coloru" name="coloru" class="form-control input-sm" required="">
				<br />
				<label>Mortanda Cosecha</label>
				<input type="number" id="fayidou" name="fayidou" class="form-control input-sm" required="">
				<br />
				<label>Fecha Fin</label>
				<input type="date" id="fecha_finu" name="fecha_finu" class="form-control input-sm" required="">
				<br />
				<label>Observaciones</label>
				<textarea id="descripcionu" name="descripcionu" rows="4" cols="34"></textarea>
				<br />
			</div>
			<div class="modal-footer">
				<div class="col-sm-6 text-left">
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="eliminarDatosGalpon2">
						Eliminar
					</button>
				</div>
				<div class="col-sm-6 text-right">
					<button type="button" class="btn btn-warning" data-dismiss="modal" id="actualizaDatosGalpon2">
						Actualizar
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		$('#modalNuevoGalpon2').on('shown.bs.modal', function() {
			let codigo = Math.floor(1000000000 + Math.random() * 9000000000);
			document.getElementById('codigo_orions').value = codigo;
		});
	});
</script>