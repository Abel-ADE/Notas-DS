<?php
declare(strict_types=1);

$data = [];

if (!empty($_POST)) {
    $data['input_json'] = trim(filter_var($_POST['input_json'], FILTER_SANITIZE_SPECIAL_CHARS));
    $data['errors'] = checkForm($_POST);
}

function checkForm(array $data_json): array
{
    $errors = [];

    //Valido que el usuario introduce algo en el textarea y no sea un número
    if (empty($data_json['input_json'])) {
        $errors['input_json'][] = 'El campo es obligatorio.';
    } else {
        if (is_numeric($data_json['input_json'])) {
            $errors['input_json'][] = 'El campo debe ser un texto.';
        }

        $json = json_decode($data_json['input_json'], true);

        //valido el json inicial si es válido y no está vacio
        if (is_null($json)) {
            $errors['input_json'][] = 'El campo debe ser un json válido.';
        }else if(empty($json)){
            $errors['input_json'][] = 'El json no puede estar vacio.';
        }else {

            foreach ($json as $asignatura => $alumnos) {
                //Valido el texto de la asignatura
                if(is_numeric($asignatura) || !is_string($asignatura)){
                    $errors['input_json'][] = 'El campo asignatura debe ser un texto.';
                }

                //Valido el objeto alumnos de cada asignatura
                if (!is_array($alumnos)){
                    $errors['input_json'][] = 'La lista de alumnos debe ser un json.';
                }else if (empty($alumnos)){
                    $errors['input_json'][] = 'La lista de alumnos no puede estar vacia.';
                }else{
                    foreach ($alumnos as $alumno => $notas) {
                        //Valido cada alumno
                        if(is_numeric($alumno)){
                            $errors['input_json'][] = 'El nombre del alumno debe ser un texto.';
                        }elseif (empty($alumno)){
                            $errors['input_json'][] = 'El nombre del alumno no puede estar vacio.';
                        }

                        //Valido las notas de cada alumno
                        if (empty($notas)){
                            $errors['input_json'][] = 'Las notas de cada alumno no pueden estar vacias';
                        }else if (!is_array($notas)){
                            $errors['input_json'][] = 'Las notas de cada alumno debe ser un array.';
                        }else{
                            foreach ($notas as $nota) {
                                //Valido que cada nota sea un número
                                if(!is_numeric($nota)){
                                    $errors['input_json'][] = 'Cada nota debe ser un número.';
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    return $errors;
}


include 'views/templates/header.php';
include 'views/notas.abel.view.php';
include 'views/templates/footer.php';