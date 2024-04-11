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
            $existe_lugarReco = false;
            $validacionFK = ModelosRentaMiCarro::validacionFKLugarReco('rentas');
            // print_r($validacionFK);
            // print_r($datos['LugarReco']);
            // echo $datos['Direccion'];
            foreach ($validacionFK as $value) {
                if ($datos['LugarReco'] == $value->LugarReco) {
                    $existe_lugarReco = true;
                    break; // Salimos del bucle una vez que encontramos una coincidencia
                }
            }
            
            if (!$existe_lugarReco) {
                $json = [
                    'detalle' => 'Error',
                    'mensaje' => 'No existe el lugar de recogida',
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