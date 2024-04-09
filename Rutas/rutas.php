<?php

$rutas_param = explode('/', $_SERVER['REQUEST_URI']);
// echo '<pre>'; print_r($rutas_param); echo '</pre>'; // Corregido: uso de echo en todas las partes

$dd = isset(array_filter($rutas_param)[2]) ? array_filter($rutas_param)[2] : null; // Corregido: Verificación de existencia del índice
$dd_id = isset(array_filter($rutas_param)[3]) ? array_filter($rutas_param)[3] : null; // Corregido: Verificación de existencia del índice

if (count(array_filter($rutas_param)) == 1) {
    $json = [
        'detalles' => $rutas_param,
    ];
    echo json_encode($json, true);
    return;
} else {
    if ($dd == 'carros') {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
            $carros = new MisCarros(); // Asumiendo que MisCarros es una clase válida
            $carros->index();
        }
    } elseif ($dd == 'clientes') {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
            $cliente = new MisClientes(); // Asumiendo que MisClientes es una clase válida
            $cliente->index();
        }
    }
    #*********************************************Rentas*********************************************
    elseif ($dd == 'rentas') {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
            $renta = new ControladorRenta(); // Asumiendo que ControladorRenta es una clase válida
            $renta->index();
        }
    } elseif ($dd == 'crearRenta') {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $datos = [
                'LugarReco' => $_POST['LugarReco'],
                'LugarDevo' => $_POST['LugarDevo'],
                'FechaReco' => $_POST['FechaReco'],
                'FechaDevo' => $_POST['FechaDevo'],
                'TipoCarro' => $_POST['TipoCarro'],
                'Cliente' => $_POST['Cliente'],
            ];
            $rentas = new ControladorRenta(); // Asumiendo que ControladorRenta es una clase válida
            $rentas->crearRenta($datos);
        }
    } elseif ($dd == 'editarRenta' && is_numeric($dd_id)) {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
            $renta = new ControladorRenta(); // Asumiendo que ControladorRenta es una clase válida
            $renta->mostrarRenta($dd_id);
        } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'PUT') {
            $datos = []; #le mandamos los datos como un arreglo
            parse_str(file_get_contents('php://input'), $datos); #capturamos los datos pasandole un array con todos los datos
            $renta = new ControladorRenta(); // Asumiendo que ControladorRenta es una clase válida
            $renta->editarRenta($dd_id, $datos);
        }
    } elseif ($dd == 'eliminarRenta' && is_numeric($dd_id)) {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $renta = new ControladorRenta(); // Asumiendo que ControladorRenta es una clase válida
            $renta->borrarRenta($dd_id);
        }
    }
    #*********************************************Clientes*********************************************
    elseif ($dd == 'crearClientes') {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $datos = [
                'Nombre' => $_POST['Nombre'],
                'ApellidoP' => $_POST['ApellidoP'],
                'ApellidoM' => $_POST['ApellidoM'],
                'AnioNacimiento' => $_POST['AnioNacimiento'],
                'CURP' => $_POST['CURP'],
                'Telefono' => $_POST['Telefono'],
                'Direccion' => $_POST['Direccion'],
            ];
            $cliente = new MisClientes(); // Asumiendo que MisClientes es una clase válida
            $cliente->crearCliente($datos);
        }
    } elseif ($dd == 'editarCliente' && is_numeric($dd_id)) {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
            $clientes = new MisClientes(); // Asumiendo que Controladorclientes es una clase válida
            $clientes->mostrarCliente($dd_id);
        } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'PUT') {
            $datos = []; #le mandamos los datos como un arreglo
            parse_str(file_get_contents('php://input'), $datos); #capturamos los datos pasandole un array con todos los datos
            $clientes = new MisClientes(); // Asumiendo que Controladorclientes es una clase válida
            $clientes->editarClientes($dd_id, $datos);
        }
    }

    #*********************************************Direcciones*********************************************
    elseif ($dd == 'editarDireccion' && is_numeric($dd_id)) {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
            $dir = new ControladorDireccion(); // Asumiendo que ControladorDireccion es una clase válida
            $dir->mostrarDireccion($dd_id);
        } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'PUT') {
            #capturamos los datos
            $datos = [];
            parse_str(file_get_contents('php://input'), $datos); #capturamos los datos pasandole un array con todos los datos
            // echo "<pre>"; print_r($datos); echo "</pre>";
            $dir = new ControladorDireccion(); // Asumiendo que ControladorDireccion es una clase válida
            $dir->editarDireccion($dd_id, $datos);
        }
    } elseif ($dd == 'crearDireccion') {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $datos = [
                'Calle' => $_POST['Calle'],
                'NumExt' => $_POST['NumExt'],
                'Colonia' => $_POST['Colonia'],
                'Municipio' => $_POST['Municipio'],
                'cp' => $_POST['cp'],
            ];
            $direccion = new ControladorDireccion(); // Asumiendo que ControladorDireccion es una clase válida
            $direccion->registarDireccion($datos);
        }
    }
}
?>
