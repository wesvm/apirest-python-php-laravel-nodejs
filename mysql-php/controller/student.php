<?php
    require_once("../config/connection.php");
    require_once("../models/Student.php");

    $student = new Student();

    $body = json_decode(file_get_contents("php://input"), true);

    switch ($_GET['op']) {
        case 'getAll':
            $response = $student->getStudent();
            echo json_encode($response);
            break;

        case 'getById':
            $response = $student->getStudentByCod($body['id_estudiante']);
            echo json_encode($response);
            break;
        
        case 'setEst':
            $response = $student->setStudent($body['nombres'], $body['apellidos'], $body['telefono']);
            echo json_encode("set");
            break;
        
        case 'updEstbyId':
            $response = $student->updStudentByCod($body['nombres'], $body['apellidos'], $body['telefono'], $body['id_estudiante']);
            echo json_encode("upd");
            break;
        
        case 'delEstbyId':
            $response = $student->delStudentByCod($body['id_estudiante']);
            echo json_encode("del");
            break;
        
        default:
            echo "ERROR";
            break;
    }

?>