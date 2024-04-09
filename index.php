<?php 
#rutas
require_once "Controlador/rutas.controlador.php";

#controlador
require_once "Controlador/carros.controlador.php";
require_once "Controlador/clientes.controlador.php";
require_once "Controlador/renta.controlador.php";
require_once "Controlador/direccion.controlador.php";
#modelo
require_once "Modelo/carros.modelo.php";
require_once "Modelo/clientes.modelo.php";
require_once "Modelo/renta.modelo.php";
require_once "Modelo/direccion.modelo.php";


$rutass = new RutaIndex();
$rutass->index();
?>