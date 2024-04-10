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
        $renta = ModelosRentaMiCarro::mostrarRenta("rentas", $id);
        $json = array(
            $renta
        );
        echo json_encode($json, true);
        return;
    }

    public function editarRenta($id, $datos){

        $test_date = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/';
        if($datos['FechaReco'] == '' || $datos['FechaDevo'] == ''){
            $json = array(
                'detalle' => 'Los campos de fecha no pueden estar vacios',
            );
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