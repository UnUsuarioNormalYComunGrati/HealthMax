<html><head></head><body>
<?php
    include_once("../Modelo/conexion.php");
    $objetoConexion = new conexion();
    $conexion = $objetoConexion->conectar();
    
    include_once("../Modelo/producto.php");
    
    $opcion = $_POST["fEnviar"];
    $IdProducto           = $_POST["fIdProducto"];
    $NombreProducto      = $_POST["fNombreProducto"];
    $PrecioProducto       = $_POST["fPrecioProducto"];
    $PrecioFabricaProducto  = $_POST["fPrecioFabricaProducto"];
    $PrecioVenta    = $_POST["fPrecioVenta"];
    $FechaVencimiento      = $_POST["fFechaVencimiento"];
    $IdTipoProductoProducto    = $_POST["fIdTipoProductoProducto"];
    $IdProveedorProducto = $_POST["fIdProveedorProducto"];
    
    $NombreProducto = htmlspecialchars($NombreProducto);
    $PrecioProducto = htmlspecialchars ($PrecioProducto);
    $PrecioabricaProducto = htmlspecialchars ($PrecioFabricaProducto);
    $PrecioVenta = htmlspecialchars ($PrecioVenta);
    $FechaVencimiento = htmlspecialchars ($FechaVencimiento);
    $IdTipoProductoProducto = htmlspecialchars ($IdTipoProductoProducto);
    $IdProveedorProducto = htmlspecialchars ($IdProveedorProducto);
    
    $objetoProducto = new Producto($conexion, $IdProducto, $NombreProducto, $PrecioProducto, $PrecioFabricaProducto, $PrecioVenta, $FechaVencimiento, $IdTipoProductoProducto, $IdProveedorProducto);
    
    switch($opcion){
        case 'Ingresar':
            $objetoProducto->insertar();
            $mensaje = "Insertado";
        break;
        case 'Modificar':
            $objetoProducto->modificar();
            $mensaje = "Modificado";
        break;
        case 'Eliminar':
            $objetoProducto->eliminar();
            $mensaje = "Eliminado";
        break;
    }
    
 $objetoConexion->desconectar($conexion);
 header("location:../Vista/formularioproducto.php?msj=$mensaje");
?>
</body>
</html>