<?php
$codigo = $_GET['codigo'] ?? null;

if (!$codigo) {
    exit("Código no válido");
}

$filas = 30;
?>

<div class="modal fade" id="modalCalculo" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Calculadora Peso Neto</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

                <table class="table table-bordered text-center table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Peso Bruto (Kg)</th>
                            <th>Peso Canastas (Kg)</th>
                            <th>Peso Neto Final (Kg)</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php for ($i = 1; $i <= $filas; $i++) { ?>
                            <tr>
                                <td><?php echo $i; ?></td>

                                <td>
                                    <input type="number" step="0.01"
                                        class="form-control bruto"
                                        data-fila="<?php echo $i; ?>">
                                </td>

                                <td>
                                    <input type="number" step="0.01"
                                        class="form-control canasta"
                                        data-fila="<?php echo $i; ?>">
                                </td>

                                <td>
                                    <input type="text"
                                        readonly
                                        class="form-control bg-light font-weight-bold text-success neto"
                                        id="neto<?php echo $i; ?>">
                                </td>
                            </tr>
                        <?php } ?>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    </tbody>
                </table>

                <hr>

                <div class="row">
                    <div class="col-md-6 text-left">
                        <button class="btn btn-danger btn-sm" onclick="borrarDatos()">
                            Borrar Todos los Datos
                        </button>
                        <button class="btn btn-success btn-sm" onclick="guardarManual()">
                            Guardar Datos
                        </button>
                    </div>

                    <div class="col-md-6 text-right">
                        <h4>
                            Total General Neto:
                            <span class="text-primary" id="totalGeneral">0.00</span> Kg
                        </h4>
                    </div>
                </div>
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Calculadora Peso Neto</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    let codigoAlmacen = "<?php echo $codigo; ?>";
    let storageKey = "calculo_peso_" + codigoAlmacen;

    // Cuando el modal se abre
    $('#modalCalculo').on('shown.bs.modal', function() {
        cargarDatos();
    });

    // Delegación de eventos (por si el modal se carga dinámicamente)
    document.addEventListener("input", function(e) {
        if (e.target.classList.contains("bruto") ||
            e.target.classList.contains("canasta")) {
            calcularTodo();
            guardarDatos();
        }
    });

    function calcularTodo() {

        let totalGeneral = 0;

        document.querySelectorAll("#modalCalculo tbody tr").forEach(function(row) {

            let bruto = parseFloat(row.querySelector(".bruto").value) || 0;
            let canasta = parseFloat(row.querySelector(".canasta").value) || 0;

            let neto = bruto - canasta;

            if (neto < 0) {
                neto = 0;
            }

            row.querySelector(".neto").value = neto.toFixed(1);
            totalGeneral += neto;

        });

        document.getElementById("totalGeneral").innerText = totalGeneral.toFixed(1);
    }

    function guardarDatos() {

        let datos = [];

        document.querySelectorAll("#modalCalculo tbody tr").forEach(function(row) {

            datos.push({
                bruto: row.querySelector(".bruto").value,
                canasta: row.querySelector(".canasta").value
            });

        });

        localStorage.setItem(storageKey, JSON.stringify(datos));
    }


    // BOTÓN GUARDAR MANUAL
    function guardarManual() {

        guardarDatos();

        Swal.fire({
            icon: 'success',
            title: '¡Datos Guardados!',
            text: 'El cálculo fue guardado correctamente.',
            confirmButtonColor: '#28a745',
            timer: 2000,
            showConfirmButton: false
        });

    }


    // BORRAR CON ALERT BONITO
    function borrarDatos() {

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Se borrarán todos los datos ingresados",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, borrar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {

            if (result.isConfirmed) {

                localStorage.removeItem(storageKey);

                document.querySelectorAll("#modalCalculo .bruto, #modalCalculo .canasta, #modalCalculo .neto")
                    .forEach(function(input) {
                        input.value = "";
                    });

                document.getElementById("totalGeneral").innerText = "0.00";

                Swal.fire({
                    icon: 'success',
                    title: '¡Eliminado!',
                    text: 'Todos los datos fueron borrados.',
                    confirmButtonColor: '#28a745',
                    timer: 2000,
                    showConfirmButton: false
                });
            }

        });
    }

    function cargarDatos() {

        let datosGuardados = localStorage.getItem(storageKey);

        if (!datosGuardados) return;

        let datos = JSON.parse(datosGuardados);

        document.querySelectorAll("#modalCalculo tbody tr").forEach(function(row, index) {

            if (datos[index]) {
                row.querySelector(".bruto").value = datos[index].bruto;
                row.querySelector(".canasta").value = datos[index].canasta;
            }

        });

        calcularTodo();
    }

    function borrarDatos() {

        if (confirm("¿Seguro que deseas borrar todos los datos?")) {

            localStorage.removeItem(storageKey);

            document.querySelectorAll("#modalCalculo .bruto, #modalCalculo .canasta, #modalCalculo .neto")
                .forEach(function(input) {
                    input.value = "";
                });

            document.getElementById("totalGeneral").innerText = "0.00";
        }
    }
</script>