
<?php

class Conexion{
    // Configuración de la conexión a la base de datos
    static private $host = 'localhost';
    static private $dbname = 'rentme';
    static private $username = 'root';
    static private $password = 'root';
    static public function conectar(){
   
            $link = new PDO("mysql:host=" . self::$host . "; dbname=" . self::$dbname, self::$username, self::$password);
            $link->exec("set names utf8");

            return $link;
        }
}


/**
 * PDO: Representa una conexión entre PHP y un servidor de bases de datos
 * self:: para acceder a las propiedades estáticas de la clase Conexion.
*/

 ?>