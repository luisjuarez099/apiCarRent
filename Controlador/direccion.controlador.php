<?php

class ControladorDireccion
{

    public function mostrarDireccion($id)
    {
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

    public function registarDireccion($datos)
    {
        
        #creamos las validaciones para el registro
        
        $test_strings = '/^[a-zA-Z\s]*$/';
        $test_nums = '/^[0-9]*$/';


        #validamos que los datos no esten vacios 
        if($datos['Calle'] == '' || $datos['NumExt'] == '' || $datos['Colonia'] == '' || $datos['Municipio'] == '' || $datos['cp'] == ''){
            $json = [
                'estado' => 'error',
                'detalle' => 'No se permiten campos vacios',
            ];
            echo json_encode($json, true);
            return;
        }

        if(!preg_match($test_strings, $datos['Calle'])){
            $json = [
                'estado' => 'error',
                'detalle' => 'El campo Calle no es valido',
            ];
            echo json_encode($json, true);
            return;
        }

        if(!preg_match($test_nums, $datos['NumExt'])){
            $json = [
                'estado' => 'error',
                'detalle' => 'El campo NumExt no es valido',
            ];
            echo json_encode($json, true);
            return;
        }

        if(!preg_match($test_nums, $datos['cp'])){
            $json = [
                'estado' => 'error',
                'detalle' => 'El cp no es valido',
            ];
            echo json_encode($json, true);
            return;
        }
        

        #validacion de datos para Colonias
        $validacion_Colonia = False;
        $colonia = ModeloDireccion::validacionDeColonia('colonia');
        foreach ($colonia as $key => $value) {
            if($value->idColonia == $datos['Colonia']){
                $validacion_Colonia = True;
            }
        }
        if(!$validacion_Colonia){
            $json = [
                'estado' => 'error',
                'detalle' => 'No se han registrado colonias con ese numero',
            ];
            echo json_encode($json, true);
            return;
        }


        $validacion_Municipio = False;
        $municipio = ModeloDireccion::validacionDeMunicipio('municipios');
        foreach ($municipio as $key => $value) {
            if($value->idMunicipios == $datos['Municipio']){
                $validacion_Municipio = True;
            }
        }
        if(!$validacion_Municipio){
            $json = [
                'estado' => 'error',
                'detalle' => 'No se han registrado municipios con ese numero',
            ];
            echo json_encode($json, true);
            return;
        }

        $validacion_cp = False;
        $cp = ModeloDireccion::validacionDeCP('cp');
        foreach ($cp as $key => $value) {
            if($value->idcp == $datos['cp']){
                $validacion_cp = True;
            }
        }
        if(!$validacion_cp){
            $json = [
                'estado' => 'error',
                'detalle' => 'No se han registrado cp con ese numero',
            ];
            echo json_encode($json, true);
            return;
        }

        #Se hace la insercion al final despues de cada filtro
        $dire = ModeloDireccion::registrarDireccion('direccion', $datos);
        $json = [
            'estado' => 'ok',
            'datos' => $datos,
            'detalle' => 'Se ha registrado la direccion',
        ];
        echo json_encode($json, true);
        return;
    }


    public function editarDireccion($id, $datos)
    {   
        $test_strings = '/^[a-zA-Z\s]*$/';
        $test_nums = '/^[0-9]*$/';


        #validamos que los datos no esten vacios 
        if($datos['Calle'] == '' || $datos['NumExt'] == '' || $datos['Colonia'] == '' || $datos['Municipio'] == '' || $datos['cp'] == ''){
            $json = [
                'estado' => 'error',
                'detalle' => 'No se permiten campos vacios',
            ];
            echo json_encode($json, true);
            return;
        }

        if(!preg_match($test_strings, $datos['Calle'])){
            $json = [
                'estado' => 'error',
                'detalle' => 'El campo Calle no es valido',
            ];
            echo json_encode($json, true);
            return;
        }

        if(!preg_match($test_nums, $datos['NumExt'])){
            $json = [
                'estado' => 'error',
                'detalle' => 'El campo NumExt no es valido',
            ];
            echo json_encode($json, true);
            return;
        }

        if(!preg_match($test_nums, $datos['cp'])){
            $json = [
                'estado' => 'error',
                'detalle' => 'El cp no es valido',
            ];
            echo json_encode($json, true);
            return;
        }
        

        #validacion de datos para Colonias
        $validacion_Colonia = False;
        $colonia = ModeloDireccion::validacionDeColonia('colonia');
        foreach ($colonia as $key => $value) {
            if($value->idColonia == $datos['Colonia']){
                $validacion_Colonia = True;
            }
        }
        if(!$validacion_Colonia){
            $json = [
                'estado' => 'error',
                'detalle' => 'No se han registrado colonias con ese numero',
            ];
            echo json_encode($json, true);
            return;
        }


        $validacion_Municipio = False;
        $municipio = ModeloDireccion::validacionDeMunicipio('municipios');
        foreach ($municipio as $key => $value) {
            if($value->idMunicipios == $datos['Municipio']){
                $validacion_Municipio = True;
            }
        }
        if(!$validacion_Municipio){
            $json = [
                'estado' => 'error',
                'detalle' => 'No se han registrado municipios con ese numero',
            ];
            echo json_encode($json, true);
            return;
        }

        $validacion_cp = False;
        $cp = ModeloDireccion::validacionDeCP('cp');
        foreach ($cp as $key => $value) {
            if($value->idcp == $datos['cp']){
                $validacion_cp = True;
            }
        }
        if(!$validacion_cp){
            $json = [
                'estado' => 'error',
                'detalle' => 'No se han registrado cp con ese numero',
            ];
            echo json_encode($json, true);
            return;
        }

        #validacion de la id de la direccion para actualizar
        $validar_id = False;
        $idDireccion = ModeloDireccion::validarIdDireccion('direccion');
        foreach ($idDireccion as $key => $value) {
            if($value->idSucursal == $id){
                $validar_id = True;
            }
        }
        if(!$validar_id){
            $json = [
                'estado' => 'error',
                'detalle' => 'No se ha encontrado la id direccion para actualizar',
            ];
        }

        $direccion = ModeloDireccion::actulizarDireccion('direccion', $id, $datos);
        $json = array(
             $datos,
        );
        echo json_encode($json, true);
        return;
    }
}
