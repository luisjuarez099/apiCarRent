# Manual De Uso para rentme API

#### Este programa es una API para el consumo de una renta de carro.

## Carros
**Ruta**: http://localhost/apiCarRent/carros
**Metodo**: Get
**Parametros**: carros

![](https://lh7-us.googleusercontent.com/xDMULdaF7fFK8RtIcL0ByJMI51bhIS4r8EjGNpoj4UsKvpYQc4vAEUWnb3vwcOFvQMA3MIePyhQbDq-ipUFUu8PJmfXQULe2eQAS4z-XFzTlvBtC8jMf7IVfPH6rLZ6VEa5us0P0xRWda1DlThOdYlw)

## Clientes
**Ruta**: http://localhost/apiCarRent/clientes
**Metodo**: GET
**Parametros**: clientes

![](https://lh7-us.googleusercontent.com/1pMCqesxhGilLyECKibrlUfrDpEp7zC2X4tToI5Fa5OfFId6mmVQaNPkGwFCkeVwZFyAFiGkjqDuTp9rL8F2tximbcF1WA1yn43HX0bhxuVmQf4vfda0dinVVdzwEjS3lTsjxK0wY_0EogMf261BkUA)

## Rentas
**Ruta**:http://localhost/apiCarRent/rentas
**Metodo**: GET
**Parametro**: rentas

![](https://lh7-us.googleusercontent.com/R-rHlMGQZUM_ulVfXcvOG2y_C9xGI9yWCwH6iFHru40HwGR0Fhk4aQcIg2v6r33q7xaYqbtVuSGLsEMAVzi1Dlz8AKg639GQV9OJf6MyhoIkDnSJ0t1nXdnHprDLo_-bMpIbEzcKec6KPJyjRMGCuDI)

## Crear Renta
**Ruta**: http://localhost/apiCarRent/crearRenta
**Metodo**: POST
**Valores**: 
 - LugarReco (Int 11)
 - LugarDevo (Int 11)
 - FechaReco (Date) YYYY-MM-DD
 - FechaDevo (Date) YYYY-MM-DD
 - TipoCarro (Int 11) 
 - Cliente (Int 11)
![](https://lh7-us.googleusercontent.com/9bO-4lMlN6diXhPfDZzonAbraiR25M38PoPmm-Vm6PhlwPpqPhFwNBEiIahuwGdXbA_WHgauabcZERHjOvmFuIw0hhk1IHXsdD2r4ynRrQR4wcK3AoPAN8qzUG7wiMbsFmc8fwcj_80VkUz2Zi0gir0)
## Editar Renta
**Ruta**: http://localhost/apiCarRent/editarDireccion/id
**Parametros**: El *id* debera de ser un *numero* de la renta a actualizar
**Metodo**: POST
**Valores**: 
 - LugarReco (Int 11)
 - LugarDevo (Int 11)
 - FechaReco (Date YYYY-MM-DD) 
 - FechaDevo (Date YYYY-MM-DD) 
 - TipoCarro (Int 11) 
 - Cliente (Int 11)![](https://lh7-us.googleusercontent.com/VjE4deBPR0DSUktvk48NT6MCF29MGp7Mezx-_ULJmNjJlqyrma7G4NHilz4TmfHSBDjJd0xO2oChll8MH2RQvz5OVI7I_Wx9Ri7fr8hHrdOh1DCUUhbJ06xNpFFe16rwvLPQ_nToUqtckToIEotE9zs)
 ## Eliminar Renta
**Ruta**: http://localhost/apiCarRent/eliminarRenta/id
**Parametros**: El *id* debera de ser un *numero* de la renta a actualizar
**Metodo**: DELETE
![](https://lh7-us.googleusercontent.com/gUdvZC9LAlWlTnk6aAexKNqeUnh_dPRQ-vjDjBZ2z5CX-EXkn3xF1_MROA7vYUMMiiuTYIot_IF-h_v-Q6X02CgQQPpkc0NN2RFybAZ6f7w8XkDKKzRFY1Phf1ToKFstVQFyUpmlz_Qlfy6Ycf2ldQ8)

## Crear Clientes 
**Ruta**: http://localhost/apiCarRent/crearClientes
**Parametros**:
**Metodo**: POST
**Valores**
- Nombre (Varchar 45)
- ApellidoP (Varchar 45)
- ApellidoM (Varchar 45)
- AnioNacimiento (Date YYYY-MM-DD)
- CURP  (Varchar 18)
- Telefono (Varchar 13)
- Direccion (Int 11)
![](https://lh7-us.googleusercontent.com/C3KEs0bK8QnltcdQYzhomwI4p4GubeAfj_F2F0SfP9C1cKi8Xb2zw5sXXJ8VBfmPFQvMMGNdKhHbwSYqOVGjw-ofpVpZ3HXQyJLZqxHO2cH7WDmu0dS7Q_P4Ky4Kqvkmee6dvFQIaM0pT1dUdBi_Ae8)

## Editar Clientes
**Ruta**: http://localhost/apiCarRent/editarClientes/1
**Parametros**: El *id* debera de ser un *numero* de la renta a actualizar
**Metodo**: PUT
**Valores**
 - Nombre (Varchar 45)
 - ApellidoP (Varchar 45)
 - ApellidoM (Varchar 45)
 - AnioNacimiento (Date YYYY-MM-DD)
 - CURP  (Varchar 18)
 - Telefono (Varchar 13)
 - Direccion (Int 11)
![](https://lh7-us.googleusercontent.com/-s0n2oqA9GvHwb4Moog21Ix8ehv4Y34aDLEt0q7ib93wXPB07sAlTxL6qYD_rFlr9gncMTQPHg0LnyUpB4DT8TaciGm6rBXvankJxDmrO35Kr-VAWkyRsGxcLfMEx5EQHdtFNXIOy1OEOlUXzxW2iwk)
## Crear Direccion
**Ruta**: http://localhost/apiCarRent/crearDireccion
**Metodo**: POST
**Valores**
 - Calle (Varchar 45)
 - NumExt (Varchar 5)
 - Colonia (Int 11)
 - Municipio (Int 11)
 - cp (Int 11) ![](https://lh7-us.googleusercontent.com/qhmI7zPdKf7y1fSFBYwwHW5nFW5MSynmY8IoFsvrFfs4tGOt9Oz7PudWXExyipxopk_Q_ylPsuIZGFWzIFJ5hOS4VOEES6QLcR7BYIh5KepQ68HdrAw6Mwz-I5nhhBTLy_BcZ3Mr_dcqkst4WSCsIl8)
 
## Editar Direccion
**Ruta**: http://localhost/apiCarRent/editarDireccion/3
**Método**: PUT
**Valores**:
 - LugarReco: Intenger(11) 
 - LugarDevo:Integer(11) 
 - FechaReco: (Date YYYY-MM-DD)
 - FechaDevo: (Date YYYY-MM-DD) 
 - TipoCarro: Integer(11) 
 - Cliente: Integer(11)
![](https://lh7-us.googleusercontent.com/dLu2m0z47_YQWVx0YfTPoPPUTvF6rBKGz-B-gkgTaLD7urGuQGO4KL3xsnsvayqalMb7GRdwd0CyRHaZ90PY_9C1GrwDYhSLHutDOr4vgwHLNXjj53rfcu9U-ullqZAdurtt9zecEVyZhFxdfxoRGQE)
