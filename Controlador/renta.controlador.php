<?php 

class ControladorRenta{
    public function index(){
        #Metodo para visualizar los datos con un select
        $renta = ModelosRentaMiCarro::index("rentas");
        $json=array(
            "rentas"=>$renta,
        );
        echo json_encode($json, true);
        return;
    }

    public function crearRenta($datos){
        $test_nums = '/^[0-9]*$/';
        $test_date = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/';
        if($datos['LugarReco'] == '' || $datos['LugarDevo'] == '' || $datos['FechaReco'] == '' || $datos['FechaDevo'] == '' || $datos['TipoCarro'] == '' || $datos['Cliente'] == ''){
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'Verifica que los campos no pueden estar vacios',
            ];
            echo json_encode($json, true);
            return;
        } 
        if (!preg_match($test_nums, $datos['LugarReco'])) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'El lugar de Recogida no es valida',
            ];
            echo json_encode($json, true);
            return;
        }
        if (!preg_match($test_nums, $datos['LugarDevo'])) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'El lugar de Devolucion no es valida',
            ];
            echo json_encode($json, true);
            return;
        } 
        
        if(!preg_match($test_date, $datos['FechaReco'])){
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'La fecha de Recogida no es valida',
            ];
            echo json_encode($json, true);
            return;
        }
        if(!preg_match($test_date, $datos['FechaDevo'])){
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'La fecha de Devolucion no es valida',
            ];
            echo json_encode($json, true);
            return;
        }
       
        if (!preg_match($test_nums, $datos['TipoCarro'])) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'El id del tipo de carro no es valido',
            ];
            echo json_encode($json, true);
            return;
        }
        if (!preg_match($test_nums, $datos['Cliente'])) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'El id del cliente no es valido',
            ];
            echo json_encode($json, true);
            return;
        }

              #validacionde FK en la tabla direccion
              $validacion_LugarReco = False;
              $LugarReco = ModelosRentaMiCarro::validacionFKLugarReco('direccion');
              foreach ($LugarReco as $key => $value) {
                  if($value->idSucursal == $datos['LugarReco']){
                      $validacion_LugarReco= True;
                  }
              }
              if(!$validacion_LugarReco){
                  $json = [
                      'estado' => 'error',
                      'detalle' => 'No se han registrado direcciones con ese id',
                  ];
                  echo json_encode($json, true);
                  return;
              }
  
              #Validacion de LugarDevo
              $validacion_LugarDevo = False;
              $LugarDevo = ModelosRentaMiCarro::validacionFKLugarDevo('direccion');
              foreach ($LugarDevo as $key => $value) {
                  if($value->idSucursal == $datos['LugarDevo']){
                      $validacion_LugarDevo= True;
                  }
              }
              if(!$validacion_LugarDevo){
                  $json = [
                      'estado' => 'error',
                      'detalle' => 'No se han registrado direcciones con ese numero',
                  ];
                  echo json_encode($json, true);
                  return;
              }
             #Validacion de TipoCarro
              // $validacion_TipoCarro = False;
              // $TipoCarro = ModelosRentaMiCarro::validacionFKTipoCarro('tipocarros');
              // foreach ($TipoCarro as $key => $value) {
              //     if($value->idTipoCarros == $datos['TipoCarro']){
              //         $validacion_TipoCarro= True;
              //     }
              // }
              // if(!$validacion_TipoCarro){
              //     $json = [
              //         'estado' => 'error',
              //         'detalle' => 'No se han registrado clientes con ese numero',
              //     ];
              //     echo json_encode($json, true);
              //     return;
              // }
              #Validacion de Cliente
              $validacion_Cliente = False;
              $Cliente = ModelosRentaMiCarro::validacionFKCliente('clientes');
              foreach ($Cliente as $key => $value) {
                  if($value->idClientes == $datos['Cliente']){
                      $validacion_Cliente= True;
                  }
              }
              if(!$validacion_Cliente){
                  $json = [
                      'estado' => 'error',
                      'detalle' => 'No se han registrado clientes con ese numero',
                  ];
                  echo json_encode($json, true);
                  return;
              }           
        
    $create = ModelosRentaMiCarro::crearRenta("rentas", $datos);
       $json = array(
            $datos,
       );
        echo json_encode($json, true);
        return;
       
    }
    public function mostrarRenta($id){
        #aqui se hacn las rentas para las validaciones
        $renta = ModelosRentaMiCarro::mostrarRenta("rentas", $id);
        $json = array(
            $renta
        );
        echo json_encode($json, true);
        return;
    }

    public function editarRenta($id, $datos){
        $test_date = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/';
        $test_nums = '/^[0-9]*$/';

        #validamos que los campos no esten vacios
        if ($datos['LugarReco'] == '' || $datos['LugarDevo'] == '' || $datos['FechaReco'] == '' || $datos['FechaDevo'] == '' || $datos['TipoCarro'] == '' || $datos['Cliente'] == '') {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'Verifica que los campos no pueden estar vacios',
            ];
            echo json_encode($json, true);
            return;
        }
        #validamos que los campos sean el tipo de dato correcto
        if (!preg_match($test_nums, $datos['LugarReco'])) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'El Lugar De Recogida No Es Valida',
            ];
            echo json_encode($json, true);
            return;
        }
        if (!preg_match($test_nums, $datos['LugarDevo'])) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'El Lugar De Devolucion No Es Valida',
            ];
            echo json_encode($json, true);
            return;
        }
        if (!preg_match($test_date, $datos['FechaReco'])) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'La fecha de Recogida no es valida',
            ];
            echo json_encode($json, true);
            return;
        }
        if (!preg_match($test_date, $datos['FechaDevo'])) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'La fecha de Devolucion no es valida',
            ];
            echo json_encode($json, true);
            return;
        }
        if (!preg_match($test_nums, $datos['TipoCarro'])) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'El carro no es valido',
            ];
            echo json_encode($json, true);
            return;
        }
        if (!preg_match($test_nums, $datos['Cliente'])) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'El cliente no es valido',
            ];
            echo json_encode($json, true);
            return;
        }

            #validacionde FK en la tabla direccion
            $validacion_LugarReco = False;
            $LugarReco = ModelosRentaMiCarro::validacionFKLugarReco('direccion');
            foreach ($LugarReco as $key => $value) {
                if($value->idSucursal == $datos['LugarReco']){
                    $validacion_LugarReco= True;
                }
            }
            if(!$validacion_LugarReco){
                $json = [
                    'estado' => 'error',
                    'detalle' => 'No se han registrado direcciones con ese id',
                ];
                echo json_encode($json, true);
                return;
            }

            #Validacion de LugarDevo
            $validacion_LugarDevo = False;
            $LugarDevo = ModelosRentaMiCarro::validacionFKLugarDevo('direccion');
            foreach ($LugarDevo as $key => $value) {
                if($value->idSucursal == $datos['LugarDevo']){
                    $validacion_LugarDevo= True;
                }
            }
            if(!$validacion_LugarDevo){
                $json = [
                    'estado' => 'error',
                    'detalle' => 'No se han registrado direcciones con ese numero',
                ];
                echo json_encode($json, true);
                return;
            }
           #Validacion de TipoCarro
            // $validacion_TipoCarro = False;
            // $TipoCarro = ModelosRentaMiCarro::validacionFKTipoCarro('tipocarros');
            // foreach ($TipoCarro as $key => $value) {
            //     if($value->idTipoCarros == $datos['TipoCarro']){
            //         $validacion_TipoCarro= True;
            //     }
            // }
            // if(!$validacion_TipoCarro){
            //     $json = [
            //         'estado' => 'error',
            //         'detalle' => 'No se han registrado clientes con ese numero',
            //     ];
            //     echo json_encode($json, true);
            //     return;
            // }
            #Validacion de Cliente
            $validacion_Cliente = False;
            $Cliente = ModelosRentaMiCarro::validacionFKCliente('clientes');
            foreach ($Cliente as $key => $value) {
                if($value->idClientes == $datos['Cliente']){
                    $validacion_Cliente= True;
                }
            }
            if(!$validacion_Cliente){
                $json = [
                    'estado' => 'error',
                    'detalle' => 'No se han registrado clientes con ese numero',
                ];
                echo json_encode($json, true);
                return;
            }           
        #validacionde id para actualizar
        $id_rentas  =  ModelosRentaMiCarro::ValidacionIdRentas('rentas');
        $existe_id = false;
        foreach ($id_rentas as $value) {
            if ($id == $value->idRentas) {
                $existe_id = true;
                break; // Salimos del bucle una vez que encontramos una coincidencia
            }
        }
        if (!$existe_id) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'El id no existe',
            ];
            echo json_encode($json, true);
            return;
        }
        $rentas_data = ModelosRentaMiCarro::actualizarRenta("rentas", $id, $datos);
        if($rentas_data != 'ok'){
            $json = array(
                'detalle' => 'No se pudo actualizar la renta',
            );
            echo json_encode($json, true);
            return;
        }else{$json = array(
                $datos
            );
            echo json_encode($json, true);
            return;
            
        }
    }

    public function borrarRenta($id){
        $rentas_data = ModelosRentaMiCarro::borrarRenta("rentas", $id);
        if($rentas_data != 'ok'){
            $json = array(
                'detalle' => 'No se pudo borrar',
            );
            return;
        }else{
            echo "Eliminado con éxito";
            return;
            
        }
    }

}


?>