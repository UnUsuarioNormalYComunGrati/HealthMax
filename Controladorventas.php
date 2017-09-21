
<?php
    include_once("../Modelo/conexion.php");
    $objetoConexion = new conexion();
    $conexion = $objetoConexion->conectar();
    
    include_once("../Modelo/ventas.php");
    
    var_dump($_POST);

    $opcion             = $_POST["fEnviar"];
    $IdVentas           = $_POST["fIdVentas"];
    $FechaVentas        = $_POST["fFechaVentas"];
    $IdClienteVentas    = $_POST["fIdClienteVentas"];
    $IdTipodePagoVentas = $_POST["fIdTipodePagoVentas"];
    
    $FechaVentas = htmlspecialchars($FechaVentas);
    $IdClienteVentas = htmlspecialchars ($IdClienteVentas);
    $IdTipodePagoVentas = htmlspecialchars ($IdTipodePagoVentas);
    
    $objetoVentas = new Ventas($conexion, $IdVentas, $FechaVentas, $IdClienteVentas, $IdTipodePagoVentas);
    
    switch($opcion){
        case 'Ingresar':
            $objetoVentas->insertar();
            $mensaje = "Insertado";
        break;
        case 'Modificar':
            $objetoVentas->modificar();
            $mensaje = "Modificado";
        break;
        case 'Eliminar':
            $objetoVentas->eliminar();
            $mensaje = "Eliminado";
        break;
    }
    
 $objetoConexion->desconectar($conexion);
 header("location:../Vista/formularioventas.php?msj=$mensaje");
?>