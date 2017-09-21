<html><head></head><body>
<?php
    include_once("../Modelo/conexion.php");
    $objetoConexion = new conexion();
    $conexion = $objetoConexion->conectar();
    
    include_once("../Modelo/tipodepago.php");
    
    $opcion = $_POST["fEnviar"];
    $IdTipodePago           = $_POST["fIdTipodePago"];
    $DescripcionTipodePago      = $_POST["fDescripcionTipodePago"];
    
    $DescripcionTipodePago = htmlspecialchars($DescripcionTipodePago);
    
    $objetoTipodePago = new TipodePago($conexion, $IdTipodePago, $DescripcionTipodePago);
    
    switch($opcion){
        case 'Ingresar':
            $objetoTipodePago->insertar();
            $mensaje = "Insertado";
        break;
        case 'Modificar':
            $objetoTipodePago->modificar();
            $mensaje = "Modificado";
        break;
        case 'Eliminar':
            $objetoTipodePago->eliminar();
            $mensaje = "Eliminado";
        break;
    }
    
 $objetoConexion->desconectar($conexion);
 header("location:../Vista/formulariotipodepago.php?msj=$mensaje");
?>
</body>