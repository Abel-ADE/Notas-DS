<?php
declare(strict_types=1);

$data = [];

if (!empty($_POST)) {
    $data['input_json'] = trim(filter_var($_POST['input_json'], FILTER_SANITIZE_SPECIAL_CHARS));
    $data['errors'] = checkForm($_POST);
}

function checkForm(array $data_json): array {
    $errors = [];

    if(empty($data_json['input_json'])) {
        $errors['input_json'] = 'El campo es obligatorio.';
    }

    return $errors;
}




include 'views/templates/header.php';
include 'views/notas.abel.view.php';
include 'views/templates/footer.php';