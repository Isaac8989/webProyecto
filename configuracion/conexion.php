<?php

// Definición de la clase Conectar
class Conectar {
    // Propiedad protegida que almacenará la conexión a la base de datos
    protected $conexion_bd;

    // Método protegido para conectar a la base de datos
    protected function conectar_bd() {
        try {
            // Intenta crear una nueva conexión PDO
            // Parámetros: 
            // 1. La cadena de conexión: "mysql:host=localhost;dbname=matriculaestudiante"
            //    - `localhost`: es el servidor de la base de datos (puede cambiar dependiendo del servidor).
            //    - `dbname=matriculaestudiante`: el nombre de la base de datos a la que se conectará.
            // 2. Usuario: "root" (usuario por defecto en muchas instalaciones locales de MySQL).
            // 3. Contraseña: "" (sin contraseña para el usuario root en instalaciones locales por defecto).
            $conexion = $this->conexion_bd = new PDO("mysql:host=localhost;dbname=matriculaestudiante", "root", "");

            // Si la conexión es exitosa, se devuelve el objeto de conexión PDO.
            return $conexion;
        } catch (Exception $e) {
            // Si ocurre un error durante la conexión, se captura la excepción y se muestra un mensaje de error
            // con detalles sobre el error.
            print "Error en la base de datos: " . $e->getMessage() . "<br/>";
            // Se termina la ejecución del script con `die()` para evitar que continúe ejecutándose después de un error.
            die();
        }
    }

    // Método público para establecer la codificación de caracteres en la base de datos
    public function establecer_codificacion() {
        // Se ejecuta una consulta SQL para asegurarse de que la codificación de la base de datos esté en UTF-8
        // Esto es importante para garantizar que los caracteres especiales, como acentos y eñes, se manejen correctamente.
        return $this->conexion_bd->query("SET NAMES 'utf8'");
    }
}

?>
