<html><head></head><body>
<?php
    include_once("../Modelo/conexion.php");
    $objetoConexion = new conexion();
    $conexion = $objetoConexion->conectar();
    
    include_once("../Modelo/item.php");
    
    $opcion = $_POST["fEnviar"];
    $IdItem           = $_POST["fIdItem"];
    $CantidadItem      = $_POST["fCantidadItem"];
    $IdProductoItem       = $_POST["fIdProductoItem"];
    $IdPedidosItem  = $_POST["fIdPedidosItem"];
    
    $CantidadItem = htmlspecialchars($CantidadItem);
    $IdProductoItem = htmlspecialchars ($IdProductoItem);
    $IdPedidosItem = htmlspecialchars ($IdPedidosItem);
    
    $objetoItem = new Item($conexion, $IdItem, $CantidadItem, $IdProductoItem, $IdPedidosItem);
    
    switch($opcion){
        case 'Ingresar':
            $objetoItem->insertar();
            $mensaje = "Insertado";
        break;
        case 'Modificar':
            $objetoItem->modificar();
            $mensaje = "Modificado";
        break;
        case 'Eliminar':
            $objetoItem->eliminar();
            $mensaje = "Eliminado";
        break;
    }
    
 $objetoConexion->desconectar($conexion);
 header("location:../Vista/formularioitem.php?msj=$mensaje");
?>
</body>
</html>