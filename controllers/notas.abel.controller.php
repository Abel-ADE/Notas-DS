<?php
declare(strict_types=1);

$data = [];

if (!empty($_POST)) {
    $data['input_json'] = trim(filter_var($_POST['input_json'], FILTER_SANITIZE_SPECIAL_CHARS));
    $data['errors'] = checkForm($_POST);

    if (empty($data['errors'])) {
        //Procesamos
        $data['tabla'] = getTabla($_POST);
        $data['listados'] = getListados($_POST);
    }
}

function getListados(array $data_json): array
{
    $result = [];
    $json = json_decode($data_json['input_json'], true);

    $suspensos = [];
    $no_promocionan = [];
    $nombres_alumnos = [];

    foreach ($json as $asignatura => $alumnos) {
        foreach ($alumnos as $nombre_alumno => $notas_alumno) {
            $media_alumno = array_sum($notas_alumno) / count($notas_alumno);

            // Manejo de suspensos
            if ($media_alumno < 5) {
                if (in_array($nombre_alumno, $suspensos)) {
                    if (!in_array($nombre_alumno, $no_promocionan)) {
                        $no_promocionan[] = $nombre_alumno;
                    }
                } else {
                    $suspensos[] = $nombre_alumno;
                }
            }

            // Manejo de alumnos
            if (!in_array($nombre_alumno, $nombres_alumnos)) {
                $nombres_alumnos[] = $nombre_alumno;
            }
        }
    }

    $aprobados = array_diff($nombres_alumnos, $suspensos);
    $promocionan = array_diff($nombres_alumnos, $no_promocionan);


    // Puedes retornar los resultados si es necesario
    $result['suspensos'] = $suspensos;
    $result['no_promocionan'] = $no_promocionan;
    $result['aprobados'] = $aprobados;
    $result['promocionan'] = $promocionan;

    return $result;
}


function getTabla(array $data_json): array
{
    $result = [];
    //$suspensos_materias = [];

    $json = json_decode($data_json['input_json'], true);

    foreach ($json as $asignatura => $alumnos) {

        $result[$asignatura] = [
            'media' => 0,
            'aprobados' => 0,
            'suspensos' => 0,
            'máximo' => [],
            'mínimo' => []
        ];

        $media = 0;
        $aprobados = 0;
        $suspensos = 0;
        $nota_minima = 10;
        $nota_maxima = 0;
        //$suspensos_materias[$asignatura] = [];


        foreach ($alumnos as $nombre_alumno => $notas_alumno) {
                $media_alumno = array_sum($notas_alumno)/count($notas_alumno);
                $media += $media_alumno;


                if ($media_alumno >= 5){
                    $aprobados++;
                }else{
                    $suspensos++;
                    //$suspensos_materias[$asignatura] += [$nombre_alumno => $media_alumno];
                }

                if (max($notas_alumno) > $nota_maxima){
                    $nota_maxima = max($notas_alumno);
                    $result[$asignatura]['máximo'] = [$nombre_alumno => $nota_maxima];
                }

                if (min($notas_alumno) < $nota_minima){
                    $nota_minima = min($notas_alumno);
                    $result[$asignatura]['mínimo'] = [$nombre_alumno => $nota_minima];
                }
        }
        $media /= count($alumnos);

        $result[$asignatura]['media'] = $media;
        $result[$asignatura]['aprobados'] = $aprobados;
        $result[$asignatura]['suspensos'] = $suspensos;
    }

    //$result['suspensos_materias'] = $suspensos_materias;
    return $result;
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
        }else {

            $json = json_decode($data_json['input_json'], true);

            //valido el json inicial si es válido y no está vacio
            if (is_null($json)) {
                $errors['input_json'][] = 'El campo debe ser un json válido.';
            } else if (empty($json)) {
                $errors['input_json'][] = 'El json no puede estar vacio.';
            } else {

                foreach ($json as $asignatura => $alumnos) {
                    //Valido el texto de la asignatura
                    if (is_numeric($asignatura) || !is_string($asignatura)) {
                        $errors['input_json'][] = 'El campo asignatura debe ser un texto.';
                    }

                    //Valido el objeto alumnos de cada asignatura
                    if (!is_array($alumnos)) {
                        $errors['input_json'][] = 'La lista de alumnos debe ser un json.';
                    } else if (empty($alumnos)) {
                        $errors['input_json'][] = 'La lista de alumnos no puede estar vacia.';
                    } else {
                        foreach ($alumnos as $alumno => $notas) {
                            //Valido cada alumno
                            if (is_numeric($alumno)) {
                                $errors['input_json'][] = 'El nombre del alumno debe ser un texto.';
                            } elseif (empty($alumno)) {
                                $errors['input_json'][] = 'El nombre del alumno no puede estar vacio.';
                            }

                            //Valido las notas de cada alumno
                            if (empty($notas)) {
                                $errors['input_json'][] = 'Las notas de cada alumno no pueden estar vacias';
                            } else if (!is_array($notas)) {
                                $errors['input_json'][] = 'Las notas de cada alumno debe ser un array.';
                            } else {
                                foreach ($notas as $nota) {
                                    //Valido que cada nota sea un número
                                    if (!is_numeric($nota)) {
                                        $errors['input_json'][] = 'Cada nota debe ser un número.';
                                    }
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