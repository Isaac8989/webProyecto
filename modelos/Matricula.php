<?php

// Definición de la clase Matricula que hereda de la clase Conectar
class Matricula extends Conectar {

    // Método para listar estudiantes
    public function listar_estudiantes() {
        try {
            // Establece la conexión a la base de datos utilizando el método conectar_bd heredado de Conectar
            $conexion = parent::conectar_bd();
            // Establece la codificación de caracteres para la conexión a la base de datos
            parent::establecer_codificacion();
        
            // SQL para obtener los campos id, cedula y nombre de la tabla estudiante
            $sql = "SELECT id, cedula, nombre FROM estudiante";
            // Prepara la consulta para su ejecución
            $query = $conexion->prepare($sql);
            // Ejecuta la consulta
            $query->execute();
        
            // Devuelve el objeto de la consulta ejecutada
            return $query; 
        } catch (Exception $e) {
            // Si ocurre un error, devuelve null
            return null;
        }
    }

    // Método para listar cursos
    public function listar_cursos() {
        try {
            // Establece la conexión a la base de datos utilizando el método conectar_bd heredado de Conectar
            $conexion = parent::conectar_bd();
            // Establece la codificación de caracteres para la conexión a la base de datos
            parent::establecer_codificacion();
    
            // SQL para obtener los campos id_curso y nombre de la tabla curso
            $sql = "SELECT id_curso, nombre FROM curso";
            // Prepara la consulta para su ejecución
            $query = $conexion->prepare($sql);
            // Ejecuta la consulta
            $query->execute();
        
            // Devuelve el objeto de la consulta ejecutada
            return $query;
        } catch (Exception $e) {
            // Si ocurre un error, devuelve null
            return null;
        }
    }

    // Método para insertar una matrícula
    public function insertar_matricula($id_estudiante, $id_curso) {
        try {
            // Establece la conexión a la base de datos utilizando el método conectar_bd heredado de Conectar
            $conexion = parent::conectar_bd();
            // Establece la codificación de caracteres para la conexión a la base de datos
            parent::establecer_codificacion();

            // SQL para insertar un registro en la tabla matricula
            // Los valores id_estudiante e id_curso serán insertados en las columnas correspondientes
            $sql = "INSERT INTO matricula (id, id_curso) VALUES (?, ?)";
            // Prepara la consulta para su ejecución
            $query = $conexion->prepare($sql);
            // Vincula los parámetros de la consulta con los valores proporcionados
            $query->bindValue(1, $id_estudiante);
            $query->bindValue(2, $id_curso);
            // Ejecuta la consulta
            $query->execute();

            // Devuelve el número de filas afectadas por la ejecución (indicando si la inserción fue exitosa)
            return $query->rowCount();
        } catch (Exception $e) {
            // Si ocurre un error, devuelve false
            return false;
        }
    }
}
?>
