<?php

require_once 'conexion.php';

class ModeloDireccion{
     
    static public function misDirecciones($tabla, $id){
        $stmt = Conexion::conectar()->prepare("SELECT Dire.Calle AS CalleReco, Dire.NumExt as NumExt, Colo.coloNombre as Colonia, Muni.nombre as Municipio, Estado.nombre as Estado, CP.CP
        FROM rentme.rentas
        INNER JOIN direccion  Dire ON rentas.LugarReco = Dire.idSucursal
        INNER JOIN Colonia    Colo ON Dire.Colonia = Colo.idColonia
        INNER JOIN municipios Muni ON rentas.LugarReco = Muni.idMunicipios
        INNER JOIN estado Estado   ON Muni.estado = Estado.idEstado
        INNER JOIN cp CP 		   ON rentas.LugarReco = CP.idcp 
        WHERE idSucursal = :id");
        #pasamos el parametro id
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);#devuelve todos los cursos


    }

    static public function actulizarDireccion($tabla, $id, $datos){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET Calle=:Calle, NumExt=:NumExt, Colonia=:Colonia,Municipio=:Municipio, cp=:cp WHERE idSucursal=$id;");
        $stmt->bindParam(':Calle', $datos['Calle'], PDO::PARAM_STR);
        $stmt->bindParam(':NumExt', $datos['NumExt'], PDO::PARAM_STR);
        $stmt->bindParam(':Colonia', $datos['Colonia'], PDO::PARAM_STR);
        $stmt->bindParam(':Municipio', $datos['Municipio'], PDO::PARAM_STR);
        $stmt->bindParam(':cp', $datos['cp'], PDO::PARAM_STR);
        if($stmt->execute()){
            return 'ok';
        }else{
            return 'error';
        }
    }

    static public function registrarDireccion($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (Calle, NumExt, Colonia, Municipio, cp) VALUES (:Calle, :NumExt, :Colonia, :Municipio, :cp)");
        $stmt->bindParam(':Calle', $datos['Calle'], PDO::PARAM_STR);
        $stmt->bindParam(':NumExt', $datos['NumExt'], PDO::PARAM_STR);
        $stmt->bindParam(':Colonia', $datos['Colonia'], PDO::PARAM_STR);
        $stmt->bindParam(':Municipio', $datos['Municipio'], PDO::PARAM_STR);
        $stmt->bindParam(':cp', $datos['cp'], PDO::PARAM_STR);
        if($stmt->execute()){
            return 'ok';
        }else{
            return 'error';
        }
       
    }

    static public function validacionDeColonia($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT idColonia FROM $tabla");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }
 
    static public function validacionDeMunicipio($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT idMunicipios FROM $tabla");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    static public function validacionDeCP($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT idcp FROM $tabla");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);

    }

    static public function validarIdDireccion($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT idSucursal FROM $tabla");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);

    }
   
}