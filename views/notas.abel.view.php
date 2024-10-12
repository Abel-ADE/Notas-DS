<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cálculos de notas</h1>

</div>
<!-- Content Row -->

<div class="row">

    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Datos asignaturas</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>
                            Asignatura
                        </th>
                        <th>
                            Media
                        </th>
                        <th>
                            Suspensos
                        </th>
                        <th>
                            Aprobados
                        </th>
                        <th>Nota más alta</th>
                        <th>Nota mínima</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($data['tabla'] as $asignatura => $datos) {
                        ?>
                        <tr>
                            <td><?php echo $asignatura ?></td>
                            <td><?php echo (is_numeric($datos['media'])) ? number_format($datos['media'], 2, ',') : $datos['media']; ?></td>
                            <td><?php echo $datos['suspensos'] ?></td>
                            <td><?php echo $datos['aprobados'] ?></td>
                            <td><?php
                                if (is_array($datos['máximo'])) {
                                    foreach ($datos['máximo'] as $alumno => $nota){
                                        echo $nota;
                                    }
                                }
                                ?></td>
                            <td><?php
                                if (is_array($datos['mínimo'])) {
                                    foreach ($datos['mínimo'] as $alumno => $nota){
                                        echo $nota;
                                    }
                                }
                                ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <form method="post" action="./?sec=notas.abel">
                    <div class="mb-3">
                        <label for="input_json">Datos a analizar:</label>
                        <textarea class="form-control" name="input_json" id="input_json" rows="10"
                                  placeholder="Inserte el json a analizar"><?php echo isset($data['input_json']) ? $data['input_json'] : ''; ?></textarea>
                        <p class="text-danger small"><?php echo isset($data['errors']['input_json']) ? implode('<br/>', $data['errors']['input_json']) : ''; ?></p>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Enviar" name="enviar" class="btn btn-primary"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
