<!-- MODAL PARA INSERTAR REGISTROS -->
<div class="modal fade" id="modalNuevoDocumento" tabindex="-1" role="dialog" aria-labelledby="modalNuevoLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalNuevoLabel">Agregar un control de alimento</h4>
            </div>
            <div class="modal-body">
                <form id="formNuevoControlAlimento">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="codigo_orions">Código Orions</label>
                            <input type="text" id="codigo_orions" name="codigo_orions" class="form-control input-sm" maxlength="10" required />
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="fecha_control_aliment">Fecha Control Alimento</label>
                            <input type="date" id="fecha_control_aliment" name="fecha_control_aliment" class="form-control input-sm" onclick="this.showPicker()" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="entradas">Entradas</label>
                            <input type="number" step="0.01" id="entradas" name="entradas" class="form-control input-sm" value="0.00" />
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="salidas">Salidas</label>
                            <input type="number" step="0.01" id="salidas" name="salidas" class="form-control input-sm" value="0.00" />
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="programacion">Programación</label>
                            <input type="number" step="0.01" id="programacion" name="programacion" class="form-control input-sm" value="0.00" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="consumo_tabla">Consumo Tabla</label>
                            <input type="number" step="0.01" id="consumo_tabla" name="consumo_tabla" class="form-control input-sm" value="0.00" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="consumo_real">Consumo Real</label>
                            <input type="number" step="0.01" id="consumo_real" name="consumo_real" class="form-control input-sm" value="0.00" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="acumulado_tabla">Acumulado Tabla</label>
                            <input type="number" step="0.01" id="acumulado_tabla" name="acumulado_tabla" class="form-control input-sm" value="0.00" />
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="acumulado_real">Acumulado Real</label>
                            <input type="number" step="0.01" id="acumulado_real" name="acumulado_real" class="form-control input-sm" value="0.00" />
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="saldo_real">Saldo Real</label>
                            <input type="number" step="0.01" id="saldo_real" name="saldo_real" class="form-control input-sm" value="0.00" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="observaciones">Observaciones</label>
                            <textarea id="observaciones" name="observaciones" class="form-control input-sm" rows="3"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="guardarNuevoControlAlimento">
                    Agregar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PARA EDICIÓN DE DATOS -->
<div class="modal fade" id="modalEdicionControlAlimento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Actualizar Control de Alimento</h4>
            </div>
            <div class="modal-body">
                <form id="formEdicionControlAlimento">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="codigou">Código (ID)</label>
                            <input type="text" id="codigou" name="codigou" class="form-control input-sm" readonly required />
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="codigo_orionsu">Código Orions</label>
                            <input type="text" id="codigo_orionsu" name="codigo_orionsu" class="form-control input-sm" maxlength="10" readonly required />
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="fecha_control_alimentu">Fecha Control Alimento</label>
                            <input type="date" id="fecha_control_alimentu" name="fecha_control_alimentu" class="form-control input-sm" required="" onclick="this.showPicker()" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="entradasu">Entradas</label>
                            <input type="number" step="0.01" id="entradasu" name="entradasu" class="form-control input-sm" />
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="salidasu">Salidas</label>
                            <input type="number" step="0.01" id="salidasu" name="salidasu" class="form-control input-sm" />
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="programacionu">Programación</label>
                            <input type="number" step="0.01" id="programacionu" name="programacionu" class="form-control input-sm" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="consumo_tablau">Consumo Tabla</label>
                            <input type="number" step="0.01" id="consumo_tablau" name="consumo_tablau" class="form-control input-sm" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="consumo_realu">Consumo Real</label>
                            <input type="number" step="0.01" id="consumo_realu" name="consumo_realu" class="form-control input-sm" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="acumulado_tablau">Acumulado Tabla</label>
                            <input type="number" step="0.01" id="acumulado_tablau" name="acumulado_tablau" class="form-control input-sm" />
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="acumulado_realu">Acumulado Real</label>
                            <input type="number" step="0.01" id="acumulado_realu" name="acumulado_realu" class="form-control input-sm" />
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="saldo_realu">Saldo Real</label>
                            <input type="number" step="0.01" id="saldo_realu" name="saldo_realu" class="form-control input-sm" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="observacionesu">Observaciones</label>
                            <textarea id="observacionesu" name="observacionesu" class="form-control input-sm" rows="3"></textarea>
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

                        <button type="button" class="btn btn-warning" data-dismiss="modal" id="actualizaDatosControlAlimento">
                            Actualizar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>