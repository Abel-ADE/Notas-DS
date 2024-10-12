<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cálculos de notas</h1>

</div>
<!-- Content Row -->

<div class="row">

    <!--Alerts con resultados-->
    <div class="col-12">
        <?php
        if (isset($data['listados'])){
        ?>
        <div class="card shadow mb-4">
            <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Listados</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">

                <!-- Primera fila -->
                <div class="d-flex flex-wrap">
                    <!-- Aprobados -->
                    <div class="col-12 col-lg-6 text-center">
                        <h4>Aprobados:</h4>
                        <div class="alert alert-success">
                            <?php
                            foreach($data['listados']['aprobados'] as $alumno){
                                ?>
                                <p><?php echo $alumno; ?></p>
                                <?php } ?>
                        </div>
                    </div>
                    <!-- Suspensos -->
                    <div class="col-12 col-lg-6 text-center">
                        <h4>Suspensos:</h4>
                        <div class="alert alert-warning">
                            <?php
                            foreach($data['listados']['suspensos'] as $alumno){
                                ?>
                                <p><?php echo $alumno; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <!-- Segunda fila -->
                <div class="d-flex flex-wrap">
                    <!-- Promocionan -->
                    <div class="col-12 col-lg-6 text-center">
                        <h4>Promocionan:</h4>
                        <div class="alert alert-info">
                            <?php
                            foreach($data['listados']['promocionan'] as $alumno){
                                ?>
                                <p><?php echo $alumno; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- No promocionan -->
                    <div class="col-12 col-lg-6 text-center">
                        <h4>No promocionan:</h4>
                        <div class="alert alert-danger">
                            <?php
                            foreach($data['listados']['no_promocionan'] as $alumno){
                                ?>
                                <p><?php echo $alumno; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php } ?>
    </div>

    <!--Resultados Tabla-->
    <div class="col-12">
        <?php
        if (isset($data['tabla'])){
        ?>
        <div class="card shadow mb-4">
            <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Resultados</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">

                <table class="table table-striped table-responsive-lg">
                    <thead>
                    <tr>
                        <th> Módulo</th>
                        <th> Media</th>
                        <th> Aprobados</th>
                        <th> Suspensos</th>
                        <th>Máximo</th>
                        <th>Mínimo</th>
                    </tr>
                    </thead>
                    <tbody> <?php foreach ($data['tabla'] as $asignatura => $datos) { ?>
                        <tr>
                            <td><?php echo ucfirst($asignatura) ?></td>
                            <td><?php echo (is_numeric($datos['media'])) ? number_format($datos['media'], 2, ',') : $datos['media']; ?></td>
                            <td><?php echo $datos['aprobados'] ?></td>
                            <td><?php echo $datos['suspensos'] ?></td>
                            <td><?php if (is_array($datos['máximo'])) {
                                    foreach ($datos['máximo'] as $alumno => $nota) {
                                        echo $alumno.': '.$nota;
                                    }
                                } ?> </td>
                            <td><?php if (is_array($datos['mínimo'])) {
                                    foreach ($datos['mínimo'] as $alumno => $nota) {
                                        echo $alumno.': '.$nota;
                                    }
                                } ?> </td>
                        </tr> <?php } ?> </tbody>
                </table>
            </div>
        </div>
            <?php
        }
        ?>
    </div>

    <!--Formulario-->
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Datos asignaturas</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">

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
