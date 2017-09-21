<html><head></head><body>
<?php
    include_once("../Modelo/conexion.php");
    $objetoConexion = new conexion();
    $conexion = $objetoConexion->conectar();
    
    include_once("../Modelo/proveedor.php");
    
    $opcion = $_POST["fEnviar"];
    $IdProveedor           = $_POST["fIdProveedor"];
    $NombreProveedor      = $_POST["fNombreProveedor"];
    $TelefonoProveedor       = $_POST["fTelefonoProveedor"];
    
    $NombreProveedor = htmlspecialchars($NombreProveedor);
    $TelefonoProveedor = htmlspecialchars ($TelefonoProveedor);
    
    $objetoProveedor = new Proveedor($conexion, $IdProveedor, $NombreProveedor, $TelefonoProveedor);
    
    switch($opcion){
        case 'Ingresar':
            $objetoProveedor->insertar();
            $mensaje = "Insertado";
        break;
        case 'Modificar':
            $objetoProveedor->modificar();
            $mensaje = "Modificado";
        break;
        case 'Eliminar':
            $objetoProveedor->eliminar();
            $mensaje = "Eliminado";
        break;
    }
    
 $objetoConexion->desconectar($conexion);
 header("location:../Vista/formularioproveedor.php?msj=$mensaje");
?>
</body>
</html>