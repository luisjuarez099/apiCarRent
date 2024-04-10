<?php

require_once "conexion.php";

class ModelosRentaMiCarro{

    #esta es la funcion get para mandar a llamar a la tabla de renta de la BD
    static public function index($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);#devuelve todos los cursos
    }
    
    #esta es la funcion post para insertar datos en la tabla de renta de la BD
    /**
     * Le pasamos los argumentos de $tabla para conocer
     * la tabla a la que vamos a insertar los datos
     * y los datos que vamos a insertar
    */
    static public function crearRenta($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (LugarReco, LugarDevo, FechaReco, FechaDevo, TipoCarro, Cliente) VALUES (:LugarReco, :LugarDevo, :FechaReco, :FechaDevo, :TipoCarro, :Cliente)");
        $stmt->bindParam(":LugarReco", $datos['LugarReco'], PDO::PARAM_STR);
        $stmt->bindParam(":LugarDevo", $datos['LugarDevo'], PDO::PARAM_STR);
        $stmt->bindParam(":FechaReco", $datos['FechaReco'], PDO::PARAM_STR);
        $stmt->bindParam(":FechaDevo", $datos['FechaDevo'], PDO::PARAM_STR);
        $stmt->bindParam(":TipoCarro", $datos['TipoCarro'], PDO::PARAM_STR);
        $stmt->bindParam(":Cliente", $datos['Cliente'], PDO::PARAM_STR);
        if($stmt->execute()){
            return "ok";    
        }else{  
            print_r(Conexion::conectar()->errorInfo());
        }
    
       } 
    static public function mostrarRenta($tabla, $id){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idRentas = :id");
        #pasamos el parametro id
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);#devuelve todos las rentas
    }

    static public function actualizarRenta($tabla, $id, $datos){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET LugarReco=:LugarReco, LugarDevo=:LugarDevo, FechaReco=:FechaReco, FechaDevo=:FechaDevo, TipoCarro=:TipoCarro, Cliente=:Cliente WHERE idRentas=$id;");
        $stmt->bindParam(':LugarReco', $datos['LugarReco'], PDO::PARAM_STR);
        $stmt->bindParam(':LugarDevo', $datos['LugarDevo'], PDO::PARAM_STR);
        $stmt->bindParam(':FechaReco', $datos['FechaReco'], PDO::PARAM_STR);
        $stmt->bindParam(':FechaDevo', $datos['FechaDevo'], PDO::PARAM_STR);
        $stmt->bindParam(':TipoCarro', $datos['TipoCarro'], PDO::PARAM_STR);
        $stmt->bindParam(':Cliente', $datos['Cliente'], PDO::PARAM_STR);
        if($stmt->execute()){
            return 'ok';
        }else{
            return 'error';
        }
    }
    
    static public function borrarRenta($tabla, $id){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idRentas = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if($stmt->execute()){
            return 'ok';
        }else{
            return 'error';
        }
    }
    
}

/*** 
 * bindParam() vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
 *  :nombre es un marcador de posición que representa un valor que se va a sustituir en la sentencia SQL cuando se ejecute la sentencia. de bindParam()
 */


?>