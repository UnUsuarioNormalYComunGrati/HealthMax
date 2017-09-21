<html><head></head><body>
<?php
    include_once("../Modelo/conexion.php");
    $objetoConexion = new conexion();
    $conexion = $objetoConexion->conectar();
    
    include_once("../Modelo/tipodeproducto.php");
    
    $opcion = $_POST["fEnviar"];
    $IdTipodeProducto           = $_POST["fIdTipodeProducto"];
    $DescripcionTipodeproducto      = $_POST["fDescripcionTipodeproducto"];
    
    $DescripcionTipodeproducto = htmlspecialchars($DescripcionTipodeproducto);
    
    $objetoTipodeProducto = new TipodeProducto($conexion, $IdTipodeProducto, $DescripcionTipodeproducto);
    
    switch($opcion){
        case 'Ingresar':
            $objetoTipodeProducto->insertar();
            $mensaje = "Insertado";
        break;
        case 'Modificar':
            $objetoTipodeProducto->modificar();
            $mensaje = "Modificado";
        break;
        case 'Eliminar':
            $objetoTipodeProducto->eliminar();
            $mensaje = "Eliminado";
        break;
    }
    
 $objetoConexion->desconectar($conexion);
 header("location:../Vista/formulariotipodeproducto.php?msj=$mensaje");
?>
</body>