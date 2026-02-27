<?php
$codigo = $_GET['codigo'] ?? null;

if (!$codigo) {
    exit("Código no válido");
}

$filas = 100;
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
                                <td><?= $i ?></td>

                                <td>
                                    <input type="number" step="0.01"
                                        class="form-control bruto">
                                </td>

                                <td>
                                    <input type="number" step="0.01"
                                        class="form-control canasta">
                                </td>

                                <td>
                                    <input type="text"
                                        readonly
                                        class="form-control bg-light font-weight-bold text-success neto">
                                </td>
                            </tr>
                        <?php } ?>
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

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let codigoAlmacen = "<?= $codigo ?>";

// Cuando el modal se abre
$('#modalCalculo').on('shown.bs.modal', function() {
    cargarDatos();
});

// Evento automático al escribir
document.addEventListener("input", function(e) {
    if (e.target.classList.contains("bruto") ||
        e.target.classList.contains("canasta")) {
        calcularTodo();
    }
});

function calcularTodo() {

    let totalGeneral = 0;

    document.querySelectorAll("#modalCalculo tbody tr").forEach(function(row) {

        let bruto = parseFloat(row.querySelector(".bruto").value) || 0;
        let canasta = parseFloat(row.querySelector(".canasta").value) || 0;

        let neto = bruto - canasta;
        if (neto < 0) neto = 0;

        row.querySelector(".neto").value = neto.toFixed(1);
        totalGeneral += neto;
    });

    document.getElementById("totalGeneral").innerText = totalGeneral.toFixed(1);
}

// GUARDAR EN BASE DE DATOS
function guardarManual() {

    let datos = [];

    document.querySelectorAll("#modalCalculo tbody tr").forEach(function(row) {

        let bruto = row.querySelector(".bruto").value;
        let canasta = row.querySelector(".canasta").value;

        if (bruto || canasta) {
            datos.push({ bruto, canasta });
        }
    });

    fetch("/galpo_pollo_dev/administrador/guardar_peso.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "codigo=" + codigoAlmacen +
              "&datos=" + encodeURIComponent(JSON.stringify(datos))
    })
    .then(response => response.text())
    .then(data => {

        if (data.trim() === "ok") {
            Swal.fire({
                icon: 'success',
                title: '¡Guardado en Base de Datos!',
                confirmButtonColor: '#28a745'
            });
        } else {
            Swal.fire("Error al guardar");
        }

    });
}

// ELIMINAR
function borrarDatos() {

    Swal.fire({
        title: '¿Eliminar todos los datos?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Sí, eliminar'
    }).then((result) => {

        if (result.isConfirmed) {

            fetch("/galpo_pollo_dev/administrador/eliminar_peso.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "codigo=" + codigoAlmacen
            })
            .then(response => response.text())
            .then(data => {

                if (data.trim() === "ok") {

                    document.querySelectorAll("#modalCalculo .bruto, #modalCalculo .canasta, #modalCalculo .neto")
                        .forEach(input => input.value = "");

                    document.getElementById("totalGeneral").innerText = "0.00";

                    Swal.fire("Eliminado correctamente");
                }

            });

        }

    });
}

// CARGAR DATOS
function cargarDatos() {

    fetch("/galpo_pollo_dev/administrador/cargar_peso.php?codigo=" + codigoAlmacen)
    .then(response => response.json())
    .then(datos => {

        if (!datos.length) return;

        document.querySelectorAll("#modalCalculo tbody tr").forEach(function(row, index) {

            if (datos[index]) {
                row.querySelector(".bruto").value = datos[index].bruto;
                row.querySelector(".canasta").value = datos[index].canasta;
            }

        });

        calcularTodo();
    });
}
</script>