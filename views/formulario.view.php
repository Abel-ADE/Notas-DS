<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Formulario ejemplo</h1>

</div>

<!-- Content Row -->

<div class="row">
    <div class="col-12">
        <div class="alert alert-success">
            Mensaje de éxito
        </div>
    </div>
    <div class="col-12">
        <div class="alert alert-danger">
            Mensaje de error
        </div>
    </div>
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Formulario de ejemplo</h6>                                    
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <!--<form action="./?sec=formulario" method="post">                   -->
                <form method="post" action="">                    
                    <div class="mb-3">
                        <label for="email">Enderezo electrónico</label>
                        <input class="form-control" id="email" type="email" name="email" placeholder="name@example.com">
                        <p class="text-danger small">Error de prueba</p>
                    </div>
                    <div class="mb-3">
                        <label for="nombre">Enderezo electrónico</label>
                        <input class="form-control" id="nombre" type="text" name="nombre" placeholder="Mi nombre completo">
                        <p class="text-danger small">Error de prueba</p>
                    </div>
                    <div class="mb-3">
                        <label for="test_select">Select de prueba</label>
                        <select class="form-control" id="test_select" name="test_select">
                            <option value="1">Valor: 1</option>
                            <option value="2">Valor: 2</option>
                            <option value="3">Valor: 3</option>
                            <option value="4">Valor: 4</option>
                            <option value="5">Valor: 5</option>
                        </select>
                        <p class="text-danger small">Error de prueba</p>
                    </div>
                    <div class="mb-3">
                        <label for="select_multiple">Exemplo multiple select</label>
                        <select class="form-control" id="select_multiple" multiple="" name="select_multiple[]">
                            <option value="1">Valor: 1</option>
                            <option value="2">Valor: 2</option>
                            <option value="3">Valor: 3</option>
                            <option value="4">Valor: 4</option>
                            <option value="5">Valor: 5</option>
                        </select>
                        <p class="text-danger small">Error de prueba</p>
                    </div>
                    <div class="mb-3">
                        <label for="ejemplo_select">Ejemplo de checkbox</label>  
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <input class="form-check-input" id="flexCheckDefault" type="checkbox" value="a" name="opcions[]">
                                        <label class="form-check-label" for="flexCheckDefault">Default checkbox</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <input class="form-check-input" id="flexCheckChecked" type="checkbox" value="b" checked" name="opcions[]">
                                        <label class="form-check-label" for="flexCheckChecked">Checked checkbox</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <input class="form-check-input" id="flexCheckDisabled" type="checkbox" value="c" disabled name="opcions[]">
                                        <label class="form-check-label" for="flexCheckDisabled">Disabled checkbox</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p class="text-danger small">Error de prueba</p>
                                </div>
                            </div>
                        </div>
                    <div class="mb-3">
                        <label for="textarea">Exemplo textarea</label>
                        <textarea class="form-control" id="textarea" name="textarea" rows="3"></textarea>
                        <p class="text-danger small">Error de prueba</p>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Enviar" name="enviar" class="btn btn-primary"/>
                    </div>
                </form>
            </div>
        </div>
    </div>                        
</div>

