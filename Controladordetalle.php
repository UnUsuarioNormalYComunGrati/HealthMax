<html><head></head><body>
<?php
    include_once("../Modelo/conexion.php");
    $objetoConexion = new conexion();
    $conexion = $objetoConexion->conectar();
    
    include_once("../Modelo/detalle.php");
    
    $opcion = $_POST["fEnviar"];
    $IdDetalle           = $_POST["fIdDetalle"];
    $CantidadDetalle      = $_POST["fCantidadDetalle"];
    $IdVentasDetalle       = $_POST["fIdVentasDetalle"];
    $IdProductoDetalle  = $_POST["fIdProductoDetalle"];
    
    $CantidadDetalle = htmlspecialchars($CantidadDetalle);
    $IdVentasDetalle = htmlspecialchars ($IdVentasDetalle);
    $IdProductoDetalle = htmlspecialchars ($IdProductoDetalle);
    
    $objetoDetalle = new Detalle($conexion, $IdDetalle, $CantidadDetalle, $IdVentasDetalle, $IdProductoDetalle);
    
    switch($opcion){
        case 'Ingresar':
            $objetoDetalle->insertar();
            $mensaje = "Insertado";
        break;
        case 'Modificar':
            $objetoDetalle->modificar();
            $mensaje = "Modificado";
        break;
        case 'Eliminar':
            $objetoDetalle->eliminar();
            $mensaje = "Eliminado";
        break;
    }
    
 $objetoConexion->desconectar($conexion);
 header("location:../Vista/formulariodetalle.php?msj=$mensaje");
?>
</body>
</html>