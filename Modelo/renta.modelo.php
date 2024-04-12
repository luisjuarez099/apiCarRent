<?php

require_once "conexion.php";

class ModelosRentaMiCarro{

    #esta es la funcion get para mandar a llamar a la tabla de renta de la BD
    static public function index($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT recoDire.Calle AS CalleReco, recoDire.NumExt as NumExtReco, recoColo.coloNombre as ColoniaReco, recoMuni.nombre as MunicipioReco, recoEstado.nombre as EstadoReco, recoCP.CP,
        devoDire.Calle AS CalleDevo, devoDire.NumExt as NumExtDevo, devoColo.coloNombre as Coloniadevo, devoMuni.nombre as MunicipioDevo, devoEstado.nombre as EstadoDevo, devoCP.CP,
        rentas.FechaReco,
        rentas.FechaDevo,
        tipocarros.CategoriaTipo as 'Tipo de carro',
        clientes.Nombre, clientes.ApellidoP, clientes.ApellidoM, clientes.AnioNacimiento, clientes.CURP, clientes.Telefono,
        clienteDire.Calle AS CalleCliente, clienteDire.NumExt as NumExtCliente, clienteColo.coloNombre as ColoniaCliente, clienteMuni.nombre as MunicipioCliente, clienteEstado.nombre as EstadoClientes, clienteCP.CP
        FROM $tabla
            INNER JOIN direccion  recoDire ON rentas.LugarReco = recoDire.idSucursal
            INNER JOIN Colonia    recoColo ON recoDire.Colonia = recoColo.idColonia
            INNER JOIN municipios recoMuni ON rentas.LugarReco = recoMuni.idMunicipios
            INNER JOIN estado recoEstado   ON recoMuni.estado = recoEstado.idEstado
            INNER JOIN cp recoCP 		   ON rentas.LugarReco = recoCP.idcp 
            /*--------------------------------------------------*/
            INNER JOIN direccion devoDire  ON rentas.LugarDevo = devoDire.idSucursal
            INNER JOIN Colonia    devoColo ON devoDire.Colonia = devoColo.idColonia
            INNER JOIN municipios devoMuni ON rentas.Lugardevo = devoMuni.idMunicipios
            INNER JOIN estado devoEstado   ON devoMuni.estado = devoEstado.idEstado
            INNER JOIN cp devoCP 		   ON rentas.LugarDevo = devoCP.idcp
            /**/
            INNER JOIN tipocarros		   ON rentas.TipoCarro = tipocarros.idTipoCarros
            /**/
            INNER JOIN clientes			   ON rentas.Cliente = clientes.idClientes
            /**/
            INNER JOIN direccion clienteDire  ON rentas.Cliente 	  = clienteDire.idSucursal
            INNER JOIN Colonia    clienteColo ON clienteDire.Colonia  = clienteColo.idColonia
            INNER JOIN municipios clienteMuni ON rentas.Cliente  = clienteMuni.idMunicipios
            INNER JOIN estado clienteEstado   ON clienteMuni.estado   = clienteEstado.idEstado
            INNER JOIN cp clienteCP 		   ON rentas.Cliente = clienteCP.idcp");
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


    static public function validacionFKLugarReco($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT idSucursal FROM $tabla;");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }
    static public function validacionFKLugarDevo($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT idSucursal FROM $tabla;");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }
    static public function validacionFKTipoCarro($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT idTipoCarros FROM $tabla;");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }
    static public function validacionFKCliente($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT idClientes FROM $tabla;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }
    static public function ValidacionIdRentas($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT idRentas FROM $tabla;");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }
    
}

/*** 
 * bindParam() vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
 *  :nombre es un marcador de posición que representa un valor que se va a sustituir en la sentencia SQL cuando se ejecute la sentencia. de bindParam()
 */


?>