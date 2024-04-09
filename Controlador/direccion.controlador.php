<?php

class ControladorDireccion
{
    public function registarDireccion($datos)
    {
        $dire = ModeloDireccion::registrarDireccion('direccion', $datos);
        $json = [
            'estado' => 'ok',
            'datos' => $datos,
            'detalle' => 'Se ha registrado la direccion',
        ];
        echo json_encode($json, true);
        return;
    }

    public function mostrarDireccion($id){
        $ubicacion = ModeloDireccion::misDirecciones('direccion', $id);
        if (!$ubicacion) {
            $json = [
                'status' => 404,
                'detalle' => 'No se encontraron ubicaciones',
            ];
            echo json_encode($json, true);
            return;
        } else {
            $json = [
                'status' => 200,
                'detalle' => $ubicacion,
            ];
            echo json_encode($json, true);
            return;
        }
    }
    
    public function editarDireccion($id, $datos){
        $direccion = ModeloDireccion::actulizarDireccion('direccion', $id, $datos);
        $json = array(
             $datos,
        );
        echo json_encode($json, true);
        return;
    }
}
