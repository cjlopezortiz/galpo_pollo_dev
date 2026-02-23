<?php
require '../modelo/datos-documento.php';
$mis_documentos = new misDocumentos();
?>
<!-- Modal registro de un usuario -->
<div class="modal fade" id="modalNuevoUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <div class="modal-title">
          <h4>Registrar nuevo usuario
          </h4>
        </div>
      </div>
      <form id="formRegistrarUsuario" method="POST">

        <div class="modal-body">

          <div class="form-row">
            <div class="form-group">
              <label>Tipo documento</label>
              <select type="text" name="tipo_documento" id="tipo_documento" class="form-control"> required>
                <option selected>Select Tipo documento</option>
                <?php
                $documento = $mis_documentos->viewDocumentos();
                foreach ($documento as $value) { ?>
                  <option value="<?php echo $value['sigla'] ?>"><?php echo $value['sigla'] ?></option>
                <?php
                }
                ?>
              </select>

              <div class="text-center" id="errortipo_documento"></div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="numero_documento">Identificación</label>
              <input type="number" name="numero_documento" class="form-control" id="numero_documento" placeholder=" Identificación" required>

              <div class="text-center" id="errornumero_documento"></div>
            </div>

            <div class="form-group">
              <label for="nombre">Nombres y apellidos</label>
              <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombres y apellidos" required>

              <div class="text-center" id="errornombre"></div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="usuario">Usuario</label>
              <input type="text" name="usuario" class="form-control" id="usuario"
                placeholder="usuario" autocomplete="username" required>

              <div class="text-center" id="errorusuario"></div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="contrasena">Contraseña</label>
              <input type="password"
                name="contrasena"
                class="form-control"
                id="contrasena"
                placeholder="contrasena"
                autocomplete="new-password"
                required>

              <div class="text-center" id="errorcontrasena"></div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="email">Correo</label>
              <input type="email" name="email" class="form-control" id="email" placeholder="email" required>

              <div class="text-center" id="erroremail"></div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="telefono">Teléfono</label>
              <input type="number" name="telefono" class="form-control" id="telefono" placeholder="telefono" required>

              <div class="text-center" id="errortelefono"></div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="estado">Estado</label>
              <select name="estado" id="estado" class="form-control" required>
                <option value="1">ACTIVO</option>
              </select>
              <div class="text-center" id="errorestado"></div>

            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="rol_id">Rol</label>
              <select name="rol_id" id="rol_id" class="form-control" required>
                <option value="1">Administrador</option>
              </select>

              <div class="text-center" id="errorrol"></div>
            </div>
          </div>
        </div>


        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" class="close" id="agregarNuevoUsuario">
            Agregar
          </button>
        </div>

      </form>

    </div>
  </div>
</div>

<!-- Modal ACTUALIZAR información de un usuario -->
<div class="modal fade" id="modalEdicionUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <div class="modal-title">
          <h4>Actualizar usuario
            <small></small>
          </h4>
        </div>
      </div>
      <form id="formEditarUsuario" method="POST">

        <div class="modal-body">
          <input type="hidden" id="codigou" name="codigo">
          <div class="form-row">
            <div class="form-group">
              <label>Tipo documento</label>
              <select type="text" name="tipo_documentou" id="tipo_documentou" class="form-control" required>
                <option selected></option>
                <?php
                $documento = $mis_documentos->viewDocumentos();
                foreach ($documento as $value) { ?>
                  <option value="<?php echo $value['sigla'] ?>"><?php echo $value['sigla'] ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="numero_documentou">Identificación</label>
              <input type="text" name="numero_documento" class="form-control" id="numero_documentou" required>
            </div>

            <div class="form-group">
              <label for="nombreu">Nombre</label>
              <input type="text" name="nombre" class="form-control" id="nombreu" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="usuariou">Usuario</label>
              <input type="text" name="usuario" class="form-control" id="usuariou"
                placeholder="usuario" autocomplete="username" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="contrasenau">Contraseña</label>
              <input type="password"
                name="contrasena"
                class="form-control"
                id="contrasenau"
                placeholder="contrasena"
                autocomplete="new-password"
                required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="emailu">Correo</label>
              <input type="text" name="email" class="form-control" id="emailu" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="telefonou">Teléfono</label>
              <input type="number" name="telefono" class="form-control" id="telefonou" required>
            </div>
          </div>

          <div class="form-row">
            <label for="estadou">Estado</label>
            <select name="estado" id="estadou" class="form-control" required>
              <option value="" selected></option>
              <option value="1">ACTIVO</option>
              <option value="2">INACTIVO</option>
            </select>
          </div>
          <div class="form-row">
            <label for="rol_idu">Rol</label>
            <select name="rol_idu" id="rol_idu" class="form-control" required>
              <option value="1">Administrador</option>
            </select>
          </div>
        </div>

      </form>


      <div class="modal-footer">
        <div class="col-sm-6 text-left">
          <button type="button" class="btn btn-danger" data-dismiss="modal" id="eliminarDatosUsuario">
            Eliminar
          </button>
        </div>
        <div class="col-sm-6 text-right">
          <button type="button" class="btn btn-warning" data-dismiss="modal" id="actualizaDatosUsuario">
            Actualizar
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>