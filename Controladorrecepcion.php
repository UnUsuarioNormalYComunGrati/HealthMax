<html><head></head><body>
<?php
    include_once("../Modelo/conexion.php");
    $objetoConexion = new conexion();
    $conexion = $objetoConexion->conectar();
    
    include_once("../Modelo/recepcion.php");
    
    $opcion = $_POST["fEnviar"];
    $IdRecepcion           = $_POST["fIdRecepcion"];
    $FechaRecepcion      = $_POST["fFechaRecepcion"];
    $CantidadRecibida       = $_POST["fCantidadRecibida"];
    $IdItemRecepcion  = $_POST["fIdItemRecepcion"];
    
    $FechaRecepcion = htmlspecialchars($FechaRecepcion);
    $CantidadRecibida = htmlspecialchars ($CantidadRecibida);
    $IdItemRecepcion = htmlspecialchars ($IdItemRecepcion);
    
    $objetoRecepcion = new Recepcion($conexion, $IdRecepcion, $FechaRecepcion, $CantidadRecibida, $IdItemRecepcion);
    
    switch($opcion){
        case 'Ingresar':
            $objetoRecepcion->insertar();
            $mensaje = "Insertado";
        break;
        case 'Modificar':
            $objetoRecepcion->modificar();
            $mensaje = "Modificado";
        break;
        case 'Eliminar':
            $objetoRecepcion->eliminar();
            $mensaje = "Eliminado";
        break;
    }
    
 $objetoConexion->desconectar($conexion);
 header("location:../Vista/formulariorecepcion.php?msj=$mensaje");
?>
</body>
</html>