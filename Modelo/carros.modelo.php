<?php

require_once "conexion.php";

class ModelosRenta{
    static public function index($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);#devuelve todos los cursos
    }
    
}