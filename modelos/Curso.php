<?php

// Definición de la clase Curso que hereda de la clase Conectar
class Curso extends Conectar {

    // Método para listar todos los cursos
    public function listar() {
        // Establece la conexión a la base de datos utilizando el método conectar_bd heredado de Conectar
        $conexion = parent::conectar_bd();
        // Establece la codificación de caracteres para la conexión a la base de datos
        parent::establecer_codificacion();
        
        // SQL para seleccionar todos los registros de la tabla curso
        $consulta_sql = "SELECT * FROM curso";
        // Prepara la consulta para su ejecución
        $consulta = $conexion->prepare($consulta_sql);
        // Ejecuta la consulta
        $consulta->execute();
        
        // Devuelve el objeto de la consulta ejecutada
        return $consulta;
    }

    // Método para mostrar los detalles de un curso por su id
    public function mostrar($id_curso) {
        // Establece la conexión a la base de datos utilizando el método conectar_bd heredado de Conectar
        $conexion = parent::conectar_bd();
        // Establece la codificación de caracteres para la conexión a la base de datos
        parent::establecer_codificacion();
        
        // SQL para seleccionar el curso con el id proporcionado
        $consulta_sql = "SELECT * FROM curso WHERE id_curso = ?";
        // Prepara la consulta para su ejecución
        $consulta = $conexion->prepare($consulta_sql);
        // Vincula el parámetro id_curso a la consulta
        $consulta->bindValue(1, $id_curso, PDO::PARAM_INT);
        // Ejecuta la consulta
        $consulta->execute();
        
        // Devuelve el primer registro encontrado en formato asociativo
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    // Método para insertar un nuevo curso
    public function insertar($nombre, $descripcion) {
        // Establece la conexión a la base de datos utilizando el método conectar_bd heredado de Conectar
        $conexion = parent::conectar_bd();
        // Establece la codificación de caracteres para la conexión a la base de datos
        parent::establecer_codificacion();
        
        // SQL para insertar un nuevo curso con el nombre y la descripción proporcionados
        $sentencia_sql = "INSERT INTO curso (nombre, descripcion) VALUES (?, ?)";
        // Prepara la consulta para su ejecución
        $sentencia = $conexion->prepare($sentencia_sql);
        // Vincula los parámetros nombre y descripción a la consulta
        $sentencia->bindValue(1, $nombre);
        $sentencia->bindValue(2, $descripcion);
        // Ejecuta la consulta e inserta el nuevo curso
        return $sentencia->execute();
    }

    // Método para editar un curso existente
    public function editar($id_curso, $nombre, $descripcion) {
        // Establece la conexión a la base de datos utilizando el método conectar_bd heredado de Conectar
        $conexion = parent::conectar_bd();
        // Establece la codificación de caracteres para la conexión a la base de datos
        parent::establecer_codificacion();
        
        // SQL para actualizar el curso con el id_curso especificado
        $sentencia_sql = "UPDATE curso SET nombre = ?, descripcion = ? WHERE id_curso = ?";
        // Prepara la consulta para su ejecución
        $sentencia = $conexion->prepare($sentencia_sql);
        // Vincula los parámetros nombre, descripción y id_curso a la consulta
        $sentencia->bindValue(1, $nombre);
        $sentencia->bindValue(2, $descripcion);
        $sentencia->bindValue(3, $id_curso);
        // Ejecuta la consulta y actualiza el curso
        return $sentencia->execute();
    }

    // Método para eliminar un curso por su id
    public function eliminar($id_curso) {
        // Establece la conexión a la base de datos utilizando el método conectar_bd heredado de Conectar
        $conexion = parent::conectar_bd();
        // Establece la codificación de caracteres para la conexión a la base de datos
        parent::establecer_codificacion();
        
        // SQL para eliminar el curso con el id_curso especificado
        $sentencia_sql = "DELETE FROM curso WHERE id_curso = ?";
        // Prepara la consulta para su ejecución
        $sentencia = $conexion->prepare($sentencia_sql);
        // Vincula el parámetro id_curso a la consulta
        $sentencia->bindValue(1, $id_curso);
        // Ejecuta la consulta y elimina el curso
        return $sentencia->execute();
    }
}
?>

