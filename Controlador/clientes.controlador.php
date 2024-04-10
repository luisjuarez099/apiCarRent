<?php

class MisClientes
{
    public function index()
    {
        #hacemos llamar al modelo
        $misClientes = ModelosClientes::index('clientes');

        $json = [
            'detalle' => $misClientes,
        ];

        echo json_encode($json, true);
        return;
    }

    public function crearCliente($datos)
    {
        $test_strings = '/^[a-zA-Z\s]*$/';
        $test_date = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/';
        $test_telefono = '/^[0-9]{10}$/';
        $test_curp = '/^[A-Z]{4}[0-9]{6}[A-Z]{6}[0-9]{2}$/';

        #validamos que los campos no esten vacios
        if ($datos['Nombre'] == '' || $datos['ApellidoP'] == '' || $datos['ApellidoM'] == '' || $datos['AnioNacimiento'] == '' || $datos['CURP'] == '' || $datos['Telefono'] == '' || $datos['Telefono'] == '') {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'Verifica que los campos no pueden estar vacios',
            ];
            echo json_encode($json, true);
            return;
        }

        #validamos que los campos sean el tipo de dato correcto
        if (!preg_match($test_strings, $datos['Nombre'])) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'El nombre solo puede contener letras y espacios',
            ];
            echo json_encode($json, true);
            return;
        }
        if (!preg_match($test_strings, $datos['ApellidoP'])) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'El Apelldio Paterno no es valido',
            ];
            echo json_encode($json, true);
            return;
        }
        if (!preg_match($test_strings, $datos['ApellidoM'])) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'El Apellido Materno no es valido',
            ];
            echo json_encode($json, true);
            return;
        }
        if (!preg_match($test_date, $datos['AnioNacimiento'])) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'La fecha de nacimiento no es valida',
            ];
            echo json_encode($json, true);
            return;
        }
        if (!preg_match($test_telefono, $datos['Telefono'])) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'El telefono no es valido',
            ];
            echo json_encode($json, true);
            return;
        }
        if (!preg_match($test_curp, $datos['CURP'])) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'La CURP no es valida',
            ];
            echo json_encode($json, true);
            return;
        }

#-----------------------------------------Validacion de la FK en la tabla direccion
            $existe_direccion = false;
            $validacionFK = ModelosClientes::validacionFKDireccion('direccion');
            // echo $datos['Direccion'];
            foreach ($validacionFK as $value) {
                if ($datos['Direccion'] == $value->idSucursal) {
                    $existe_direccion = true;
                    break; // Salimos del bucle una vez que encontramos una coincidencia
                }
            }
            if (!$existe_direccion) {
                $json = [
                    'detalle' => 'Error',
                    'mensaje' => 'La direccion no existe',
                ];
                echo json_encode($json, true);
                return;
            }

            #enviamos los datos al modelo para que se encargue de la insercion

            $clientes = ModelosClientes::createClientes('clientes', $datos);

            if ($clientes == 'ok') {
                $json = [
                    'detalle' => 'Los datos se han enviado de forma correcta',
                ];
                echo json_encode($json, true);
                return;
            } else {
                $json = [
                    'detalle' => 'Los datos no se han enviado de forma correcta',
                ];

                echo json_encode($json, true);
                return;
            }
    }

    public function mostrarCliente($id)
    {
        $clientes = ModelosClientes::miCliente('clientes', $id);
        if(empty($clientes)){
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'El id no existe',
            ];
            echo json_encode($json, true);
            return;
        }
        $json = [$clientes];
        echo json_encode($json, true);
        return;
    }

    public function editarClientes($id, $datos)
    {
        
        $test_strings = '/^[a-zA-Z\s]*$/';
        $test_date = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/';
        $test_telefono = '/^[0-9]{10}$/';
        $test_curp = '/^[A-Z]{4}[0-9]{6}[A-Z]{6}[0-9]{2}$/';

        #validamos que los campos no esten vacios
        if ($datos['Nombre'] == '' || $datos['ApellidoP'] == '' || $datos['ApellidoM'] == '' || $datos['AnioNacimiento'] == '' || $datos['CURP'] == '' || $datos['Telefono'] == '' || $datos['Telefono'] == '') {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'Verifica que los campos no pueden estar vacios',
            ];
            echo json_encode($json, true);
            return;
        }

        #validamos que los campos sean el tipo de dato correcto
        if (!preg_match($test_strings, $datos['Nombre'])) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'El nombre solo puede contener letras y espacios',
            ];
            echo json_encode($json, true);
            return;
        }
        if (!preg_match($test_strings, $datos['ApellidoP'])) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'El Apelldio Paterno no es valido',
            ];
            echo json_encode($json, true);
            return;
        }
        if (!preg_match($test_strings, $datos['ApellidoM'])) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'El Apellido Materno no es valido',
            ];
            echo json_encode($json, true);
            return;
        }
        if (!preg_match($test_date, $datos['AnioNacimiento'])) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'La fecha de nacimiento no es valida',
            ];
            echo json_encode($json, true);
            return;
        }
        if (!preg_match($test_telefono, $datos['Telefono'])) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'El telefono no es valido',
            ];
            echo json_encode($json, true);
            return;
        }
        if (!preg_match($test_curp, $datos['CURP'])) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'La CURP no es valida',
            ];
            echo json_encode($json, true);
            return;
        }

        #validacionde FK en la tabla direccion
        $existe_direccion = false;
        $validacionFK = ModelosClientes::validacionFKDireccion('direccion');
        // echo $datos['Direccion'];
        foreach ($validacionFK as $value) {
            if ($datos['Direccion'] == $value->idSucursal) {
                $existe_direccion = true;
                break; // Salimos del bucle una vez que encontramos una coincidencia
            }
        }
        if(is_string($datos['Direccion'])){
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'La direccion no es valida',
            ];
            echo json_encode($json, true);
            return;
        }
        if (!$existe_direccion) {
            $json = [
                'detalle' => 'Error',
                'mensaje' => 'La direccion no existe',
            ];
            echo json_encode($json, true);
            return;
        }
        #validacionde id para actualizar
        $id_cliente  =  ModelosClientes::validacionIdCliente('clientes');
        $existe_id = false;
        foreach ($id_cliente as $value) {
            if ($id == $value->idClientes) {
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
        $cliente = ModelosClientes::actulizarCliente('clientes', $id, $datos);
        $json = [$datos];
        echo json_encode($json, true);
        return;
    }


}

?>
