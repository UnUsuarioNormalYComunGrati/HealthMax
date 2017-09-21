<html><head></head><body>
<?php
    include_once("../Modelo/conexion.php");
    $objetoConexion = new conexion();
    $conexion = $objetoConexion->conectar();
    
    include_once("../Modelo/empresa.php");
    
    $opcion = $_POST["fEnviar"];
    $IdEmpresa           = $_POST["fIdEmpresa"];
    $NombreEmpresa      = $_POST["fNombreEmpresa"];
    $TipoEmpresa       = $_POST["fTipoEmpresa"];
    $DireccionEmpresa  = $_POST["fDireccionEmpresa"];
    $TelefonoEmpresa    = $_POST["fTelefonoEmpresa"];
    
    $NombreEmpresa = htmlspecialchars($NombreEmpresa);
    $TipoEmpresa = htmlspecialchars ($TipoEmpresa);
    $DireccionEmpresa = htmlspecialchars ($DireccionEmpresa);
    $TelefonoEmpresa = htmlspecialchars ($TelefonoEmpresa);
    
    $objetoEmpresa = new Empresa($conexion, $IdEmpresa, $NombreEmpresa, $TipoEmpresa, $DireccionEmpresa, $TelefonoEmpresa);
    
    switch($opcion){
        case 'Ingresar':
            $objetoEmpresa->insertar();
            $mensaje = "Insertado";
        break;
        case 'Modificar':
            $objetoEmpresa->modificar();
            $mensaje = "Modificado";
        break;
        case 'Eliminar':
            $objetoEmpresa->eliminar();
            $mensaje = "Eliminado";
        break;
    }
    
 $objetoConexion->desconectar($conexion);
 header("location:../Vista/formularioempresa.php?msj=$mensaje");
?>
</body>
</html>