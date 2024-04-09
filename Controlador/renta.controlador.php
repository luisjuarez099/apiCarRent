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
}


?>