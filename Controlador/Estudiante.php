<?php
// Incluye la conexión a la base de datos y el modelo del estudiante
require_once("../configuracion/conexion.php");
require_once("../modelos/Estudiante.php");

// Instancia de la clase Estudiante para gestionar operaciones relacionadas con la entidad "Estudiante"
$estudiante = new Estudiante();

// Obtiene los valores enviados por el formulario a través del método POST, o los inicializa como cadenas vacías si no están definidos
$id_estudiante = isset($_POST["id_estudiante"]) ? $_POST["id_estudiante"] : "";
$cedula = isset($_POST["cedula_estudiante"]) ? $_POST["cedula_estudiante"] : "";
$nombre = isset($_POST["nombre_estudiante"]) ? $_POST["nombre_estudiante"] : "";
$apellido = isset($_POST["apellido_estudiante"]) ? $_POST["apellido_estudiante"] : "";

// Utiliza el parámetro 'op' recibido por el método GET para determinar qué operación ejecutar
switch ($_GET["op"]) {
    case 'guardar': 
        // Inserta un nuevo registro de estudiante
        $rspta = $estudiante->insertar($cedula, $nombre, $apellido);
        // Devuelve un mensaje indicando si la operación fue exitosa o no
        echo $rspta ? "Estudiante agregado correctamente" : "No se pudo agregar el estudiante";
        break;

    case 'editar': 
        // Actualiza los datos de un estudiante existente
        $rspta = $estudiante->editar($id_estudiante, $cedula, $nombre, $apellido);
        // Devuelve un mensaje indicando si la operación fue exitosa o no
        echo $rspta ? "Estudiante actualizado correctamente" : "No se pudo actualizar el estudiante";
        break;

    case 'eliminar': 
        // Elimina un estudiante basado en su ID
        $rspta = $estudiante->eliminar($id_estudiante);
        // Devuelve un mensaje indicando si la operación fue exitosa o no
        echo $rspta ? "Estudiante eliminado correctamente" : "No se pudo eliminar el estudiante";
        break;

    case 'mostrar': 
        // Obtiene los datos de un estudiante basado en su ID
        $rspta = $estudiante->mostrar($id_estudiante);
        if ($rspta) {
            // Convierte los datos del estudiante a formato JSON si existen
            echo json_encode($rspta);
        } else {
            // Devuelve un mensaje de error si no se encuentran datos
            echo json_encode(["error" => "No se encontraron datos"]);
        }
        break;

    case 'listar': 
        // Obtiene la lista de todos los estudiantes en la base de datos
        $rspta = $estudiante->listar();
        $data = Array(); // Inicializa un arreglo para almacenar los datos

        // Recorre los resultados de la consulta y los agrega al arreglo
        while ($reg = $rspta->fetch(PDO::FETCH_ASSOC)) {
            $data[] = array(
                "0" => $reg['id'], // ID del estudiante
                "1" => $reg['cedula'], // Cédula del estudiante
                "2" => $reg['nombre'], // Nombre del estudiante
                "3" => $reg['apellido'], // Apellido del estudiante
                "4" => '<button onclick="mostrar(\'' . $reg['id'] . '\')">Ver</button>', // Botón para mostrar información del estudiante
            );
        }

        // Crea un objeto JSON con la información requerida por DataTables
        $results = array(
            "sEcho" => 1, // Identificador para DataTables
            "iTotalRecords" => count($data), // Total de registros en la tabla
            "iTotalDisplayRecords" => count($data), // Total de registros a mostrar
            "aaData" => $data, // Datos formateados
        );

        // Devuelve el resultado en formato JSON
        echo json_encode($results);
        break;
}
?>
