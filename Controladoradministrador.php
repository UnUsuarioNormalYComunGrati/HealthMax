<html><head></head><body>
<?php
    include_once("../Modelo/conexion.php");
    $objetoConexion = new conexion();
    $conexion = $objetoConexion->conectar();
    
    include_once("../Modelo/administrador.php");
    
    $opcion = $_POST["fEnviar"];
    $IdAdministrador           = $_POST["fIdAdministrador"];
    $NombreAdministrador      = $_POST["fNombreAdministrador"];
    $DireccionAdministrador       = $_POST["fDireccionAdministrador"];
    $TelefonoAdministrador  = $_POST["fTelefonoAdministrador"];
    $IdEmpresaAdministrador    = $_POST["fIdEmpresaAdministrador"];
    
    $NombreAdministrador = htmlspecialchars($NombreAdministrador);
    $DireccionAdministrador = htmlspecialchars ($DireccionAdministrador);
    $TelefonoAdministrador = htmlspecialchars ($TelefonoAdministrador);
    $IdEmpresaAdministrador = htmlspecialchars ($IdEmpresaAdministrador);
    
    $objetoAdministrador = new Administrador($conexion, $IdAdministrador, $NombreAdministrador, $DireccionAdministrador, $TelefonoAdministrador, $IdEmpresaAdministrador);
    
    switch($opcion){
        case 'Ingresar':
            $objetoAdministrador->insertar();
            $mensaje = "Insertado";
        break;
        case 'Modificar':
            $objetoAdministrador->modificar();
            $mensaje = "Modificado";
        break;
        case 'Eliminar':
            $objetoAdministrador->eliminar();
            $mensaje = "Eliminado";
        break;
    }
    
 $objetoConexion->desconectar($conexion);
 header("location:../Vista/formularioadministrador.php?msj=$mensaje");
?>
</body>
</html>