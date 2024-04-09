<?php


class MisCarros{
    public function index(){
        #hacemos llamar al modelo 
        $misCarros = ModelosRenta::index("carros");
        
        $json=array(
            "detalle"=>$misCarros,
        );
        echo json_encode($json, true);
        return;
    }
}


?>