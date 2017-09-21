<html><head></head><body>
<?php
    include_once("../Modelo/conexion.php");
    $objetoConexion = new conexion();
    $conexion = $objetoConexion->conectar();
    
    include_once("../Modelo/clientes.php");
    
    $opcion = $_POST["fEnviar"];
    $IdClientes           = $_POST["fIdClientes"];
    $NombreClientes      = $_POST["fNombreClientes"];
    $TelefonoClientes       = $_POST["fTelefonoClientes"];
    $CedulaClientes  = $_POST["fCedulaClientes"];
    
    $NombreClientes = htmlspecialchars($NombreClientes);
    $TelefonoClientes = htmlspecialchars ($TelefonoClientes);
    $CedulaClientes = htmlspecialchars ($CedulaClientes);
    
    $objetoClientes = new Clientes($conexion, $IdClientes, $NombreClientes, $TelefonoClientes, $CedulaClientes);
    
    switch($opcion){
        case 'Ingresar':
            $objetoClientes->insertar();
            $mensaje = "Insertado";
        break;
        case 'Modificar':
            $objetoClientes->modificar();
            $mensaje = "Modificado";
        break;
        case 'Eliminar':
            $objetoClientes->eliminar();
            $mensaje = "Eliminado";
        break;
    }
    
 $objetoConexion->desconectar($conexion);
 header("location:../Vista/formularioclientes.php?msj=$mensaje");
?>
</body>
</html>