<?php

require_once "conexion.php";

class ModelosRenta{
    static public function index($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT carros.Matricula, modelos.Modelo, modelos.Anio, marca.Nombre as marca, carros.tarifa,
        carros.Caract, carros.VIN, tipocarros.CategoriaTipo,
        carros.tipoTransmicion
        FROM $tabla
        INNER JOIN modelos ON carros.Modelo = modelos.idModelos
        INNER JOIN marca   ON modelos.marca= marca.idMarca
        INNER JOIN tipocarros ON carros.categoria= tipocarros.idTipoCarros;
        ");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);#devuelve todos los cursos
    }
    
}