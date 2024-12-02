<?php 

// Requiere los archivos necesarios para la conexión a la base de datos y el modelo del curso.
require_once("../configuracion/conexion.php"); // Archivo para la configuración de la conexión a la base de datos.
require_once("../modelos/Curso.php"); // Archivo que contiene la lógica del modelo 'Curso'.

// Crea una instancia de la clase 'Curso' para interactuar con las funciones del modelo.
$curso = new Curso();

// Obtiene los datos enviados por el formulario (usando el método POST) o los deja vacíos si no existen.
$id_curso = isset($_POST["id_curso"]) ? $_POST["id_curso"] : ""; // Identificador del curso.
$nombre_curso = isset($_POST["nombre_curso"]) ? $_POST["nombre_curso"] : ""; // Nombre del curso.
$descripcion_curso = isset($_POST["descripcion_curso"]) ? $_POST["descripcion_curso"] : ""; // Descripción del curso.

// Define la acción a realizar según el parámetro 'op' enviado por el método GET.
switch ($_GET["op"]) {
    case 'guardar':
        // Inserta un nuevo curso en la base de datos.
        $rspta = $curso->insertar($nombre_curso, $descripcion_curso);
        // Devuelve un mensaje indicando si la operación fue exitosa o no.
        echo $rspta ? "Curso agregado correctamente" : "No se pudo agregar el curso";
        break;

    case 'editar':
        // Actualiza un curso existente en la base de datos.
        $rspta = $curso->editar($id_curso, $nombre_curso, $descripcion_curso);
        // Devuelve un mensaje indicando si la operación fue exitosa o no.
        echo $rspta ? "Curso actualizado correctamente" : "No se pudo actualizar el curso";
        break;

    case 'eliminar':
        // Elimina un curso de la base de datos.
        $rspta = $curso->eliminar($id_curso);
        // Devuelve un mensaje indicando si la operación fue exitosa o no.
        echo $rspta ? "Curso eliminado correctamente" : "No se pudo eliminar el curso";
        break;

    case 'mostrar':
        // Obtiene la información de un curso específico.
        $rspta = $curso->mostrar($id_curso);
        // Devuelve los datos en formato JSON o un mensaje de error si no se encontraron datos.
        if ($rspta) {
            echo json_encode($rspta);
        } else {
            echo json_encode(["error" => "No se encontraron datos"]);
        }
        break;

    case 'listar':
        // Lista todos los cursos almacenados en la base de datos.
        $rspta = $curso->listar();
        $data = Array(); // Arreglo para almacenar los datos obtenidos.

        // Recorre cada registro y lo agrega al arreglo $data.
        while ($reg = $rspta->fetch(PDO::FETCH_ASSOC)) {
            $data[] = array(
                "0" => $reg['id_curso'], // ID del curso.
                "1" => $reg['nombre'], // Nombre del curso.
                "2" => $reg['descripcion'], // Descripción del curso.
                // Botón para mostrar los detalles del curso, con un evento onclick para invocar la función 'mostrar'.
                "3" => '<button onclick="mostrar(\'' . $reg['id_curso'] . '\')">Ver</button>',
            );
        }

        // Prepara el formato esperado por DataTables.
        $results = array(
            "sEcho" => 1, // Parámetro utilizado por DataTables.
            "iTotalRecords" => count($data), // Total de registros en la base de datos.
            "iTotalDisplayRecords" => count($data), // Total de registros a mostrar.
            "aaData" => $data, // Datos a mostrar en la tabla.
        );

        // Devuelve los resultados en formato JSON.
        echo json_encode($results);
        break;
}
?>
