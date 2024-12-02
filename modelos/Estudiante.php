<?php

// Clase Estudiante que extiende de Conectar
class Estudiante extends Conectar {

    // Método para listar todos los registros de la tabla "estudiante"
    public function listar() {
        $conexion = parent::conectar_bd(); // Conexión a la base de datos
        parent::establecer_codificacion(); // Configuración de codificación UTF-8
        $consulta_sql = "SELECT * FROM estudiante"; // Consulta SQL
        $consulta = $conexion->prepare($consulta_sql); // Preparación de la consulta
        $consulta->execute(); // Ejecución de la consulta
        return $consulta; // Retorno del resultado
    }

    // Método para mostrar un registro específico de la tabla "estudiante"
    public function mostrar($id_estudiante) {
        $conexion = parent::conectar_bd(); // Conexión a la base de datos
        parent::establecer_codificacion(); // Configuración de codificación UTF-8
        $consulta_sql = "SELECT * FROM estudiante WHERE id = ?"; // Consulta SQL con un parámetro
        $consulta = $conexion->prepare($consulta_sql); // Preparación de la consulta
        $consulta->bindValue(1, $id_estudiante, PDO::PARAM_INT); // Asignación del valor del parámetro
        $consulta->execute(); // Ejecución de la consulta
        return $consulta->fetch(PDO::FETCH_ASSOC); // Retorno del registro como un arreglo asociativo
    }

    // Método para insertar un nuevo registro en la tabla "estudiante"
    public function insertar($cedula, $nombre, $apellido) {
        $conexion = parent::conectar_bd(); // Conexión a la base de datos
        parent::establecer_codificacion(); // Configuración de codificación UTF-8
        $sentencia_sql = "INSERT INTO estudiante (cedula, nombre, apellido) VALUES (?, ?, ?)"; // Consulta SQL con parámetros
        $sentencia = $conexion->prepare($sentencia_sql); // Preparación de la consulta
        $sentencia->bindValue(1, $cedula); // Asignación del primer parámetro
        $sentencia->bindValue(2, $nombre); // Asignación del segundo parámetro
        $sentencia->bindValue(3, $apellido); // Asignación del tercer parámetro
        return $sentencia->execute(); // Ejecución de la consulta y retorno del resultado
    }

    // Método para editar un registro existente en la tabla "estudiante"
    public function editar($id_estudiante, $cedula, $nombre, $apellido) {
        $conexion = parent::conectar_bd(); // Conexión a la base de datos
        parent::establecer_codificacion(); // Configuración de codificación UTF-8
        $sentencia_sql = "UPDATE estudiante SET cedula = ?, nombre = ?, apellido = ? WHERE id = ?"; // Consulta SQL con parámetros
        $sentencia = $conexion->prepare($sentencia_sql); // Preparación de la consulta
        $sentencia->bindValue(1, $cedula); // Asignación del primer parámetro
        $sentencia->bindValue(2, $nombre); // Asignación del segundo parámetro
        $sentencia->bindValue(3, $apellido); // Asignación del tercer parámetro
        $sentencia->bindValue(4, $id_estudiante); // Asignación del cuarto parámetro
        return $sentencia->execute(); // Ejecución de la consulta y retorno del resultado
    }

    // Método para eliminar un registro de la tabla "estudiante"
    public function eliminar($id_estudiante) {
        $conexion = parent::conectar_bd(); // Conexión a la base de datos
        parent::establecer_codificacion(); // Configuración de codificación UTF-8
        $sentencia_sql = "DELETE FROM estudiante WHERE id = ?"; // Consulta SQL con un parámetro
        $sentencia = $conexion->prepare($sentencia_sql); // Preparación de la consulta
        $sentencia->bindValue(1, $id_estudiante); // Asignación del valor del parámetro
        return $sentencia->execute(); // Ejecución de la consulta y retorno del resultado
    }
}
?>
