<?php

require_once 'conexion.php';

class ModelosClientes
{
    static public function index($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS); #devuelve todos los cursos
    }

    static public function createClientes($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (Nombre, ApellidoP, ApellidoM, AnioNacimiento, CURP, Telefono, Direccion) VALUES (:Nombre, :ApellidoP, :ApellidoM, :AnioNacimiento, :CURP, :Telefono, :Direccion)");
        $stmt->bindParam(":Nombre", $datos['Nombre'], PDO::PARAM_STR);
        $stmt->bindParam(":ApellidoP", $datos['ApellidoP'], PDO::PARAM_STR);
        $stmt->bindParam(":ApellidoM", $datos['ApellidoM'], PDO::PARAM_STR);
        $stmt->bindParam(":AnioNacimiento", $datos['AnioNacimiento'], PDO::PARAM_STR);
        $stmt->bindParam(":CURP", $datos['CURP'], PDO::PARAM_STR);
        $stmt->bindParam(":Telefono", $datos['Telefono'], PDO::PARAM_STR);
        $stmt->bindParam(":Direccion", $datos['Direccion'], PDO::PARAM_STR);
        if($stmt->execute()){
            return "ok";    
        }else{  
            print_r(Conexion::conectar()->errorInfo());
        }

    }

    static public function miCliente($tabla, $id){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idClientes = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
     
    }

    static public function actulizarCliente($tabla, $id, $datos){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET Nombre=:Nombre, ApellidoP=:ApellidoP, ApellidoM=:ApellidoM, AnioNacimiento=:AnioNacimiento, CURP=:CURP, Telefono=:Telefono, Direccion=:Direccion WHERE idClientes=$id;");
        $stmt->bindParam(":Nombre", $datos['Nombre'], PDO::PARAM_STR);
        $stmt->bindParam(":ApellidoP", $datos['ApellidoP'], PDO::PARAM_STR);
        $stmt->bindParam(":ApellidoM", $datos['ApellidoM'], PDO::PARAM_STR);
        $stmt->bindParam(":AnioNacimiento", $datos['AnioNacimiento'], PDO::PARAM_STR);
        $stmt->bindParam(":CURP", $datos['CURP'], PDO::PARAM_STR);
        $stmt->bindParam(":Telefono", $datos['Telefono'], PDO::PARAM_STR);
        $stmt->bindParam(":Direccion", $datos['Direccion'], PDO::PARAM_STR);
        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }
    }

   
}
