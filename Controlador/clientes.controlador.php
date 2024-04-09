<?php

class MisClientes
{
    public function index()
    {
        #hacemos llamar al modelo
        $misClientes = ModelosClientes::index('clientes');

        $json =array(
            'detalle' => $misClientes,
        );
        
        echo json_encode($json, true);
        return;
    }

    public function crearCliente($datos)
    {
        $clientes = ModelosClientes::createClientes('clientes', $datos);

        if($clientes == 'ok'){
            $json = array(
                'detalle' => 'Los datos se han enviado de forma correcta',
            );
            echo json_encode($json, true);
            return;
        }else{
            $json = array(

                'detalle' => 'Los datos no se han enviado de forma correcta',
            );
           
            echo json_encode($json, true);
            return;
        }
       
    }

    public function mostrarCliente($id)
    {
        $clientes = ModelosClientes::miCliente('clientes', $id);
        $json=array(
            $clientes
        );
        echo json_encode($json, true);
        return;
    }

    public function editarClientes($id, $datos)
    {
        $cliente = ModelosClientes::actulizarCliente('clientes', $id, $datos);
        $json = array(
            $datos,
        );
        echo json_encode($json, true);
        return;
    }

}

?>
