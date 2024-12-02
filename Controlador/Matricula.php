<?php
// Se incluyen los archivos necesarios para la conexión a la base de datos y la lógica de la matrícula
require_once("../configuracion/conexion.php");
require_once("../modelos/Matricula.php");

// Se crea una instancia de la clase Matricula
$matricula = new Matricula();

// Se obtiene y decodifica el cuerpo de la solicitud en formato JSON
$body = json_decode(file_get_contents("php://input"), true);

// Se utiliza un switch para manejar diferentes operaciones a través del parámetro "op" de la URL
switch ($_GET["op"]) {
    // Caso para guardar una matrícula
    case 'guardar':
        // Verifica si los campos 'id_estudiante' y 'id_curso' están presentes en el cuerpo de la solicitud
        if (isset($body["id_estudiante"], $body["id_curso"])) {
            // Si los campos existen, se llama al método insertar_matricula de la clase Matricula
            $rspta = $matricula->insertar_matricula($body["id_estudiante"], $body["id_curso"]);
            // Se responde con un mensaje de éxito en formato JSON
            echo json_encode(["Correcto" => "Inserción realizada"]);
        } else {
            // Si faltan campos, se responde con un mensaje de error en formato JSON
            echo json_encode(["Error" => "Todos los campos son obligatorios"]);
        }
        break;
       
    // Caso para listar los estudiantes
    case 'listar_estudiantes':
        // Se llama al método listar_estudiantes de la clase Matricula para obtener la lista de estudiantes
        $rspta = $matricula->listar_estudiantes();
        // Se inicializa un array para almacenar los datos de los estudiantes
        $data = array();

        // Se recorren los resultados obtenidos y se almacenan en el array $data
        while ($reg = $rspta->fetch(PDO::FETCH_ASSOC)) {
            $data[] = array(
                "id" => $reg['id'],           // ID del estudiante
                "cedula" => $reg['cedula'],   // Cédula del estudiante
                "nombre" => $reg['nombre'],   // Nombre del estudiante
            );
        }

        // Se responde con los datos de los estudiantes en formato JSON
        echo json_encode($data);
        break;

    // Caso para listar los cursos
    case 'listar_cursos':
        // Se llama al método listar_cursos de la clase Matricula para obtener la lista de cursos
        $rspta = $matricula->listar_cursos();
        // Se inicializa un array para almacenar los datos de los cursos
        $data = array();

        // Se recorren los resultados obtenidos y se almacenan en el array $data
        while ($reg = $rspta->fetch(PDO::FETCH_ASSOC)) {
            $data[] = array(
                "id_curso" => $reg['id_curso'],  // ID del curso
                "nombre" => $reg['nombre'],      // Nombre del curso
            );
        }

        // Se responde con los datos de los cursos en formato JSON
        echo json_encode($data);
        break;
}
?>
