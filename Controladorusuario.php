<html><head></head><body>
<?php
    include_once("../Modelo/conexion.php");
    $objetoConexion = new conexion();
    $conexion = $objetoConexion->conectar();
    
    include_once("../Modelo/usuario.php");
    
    $opcion = $_POST["fEnviar"];
    $IdUsuario           = $_POST["fIdUsuario"];
    $CorreoUsuario      = $_POST["fCorreoUsuario"];
    $ClaveUsuario       = $_POST["fClaveUsuario"];
    $FechaRegistroUsuario  = $_POST["fFechaRegistroUsuario"];
    $NombreUsuario    = $_POST["fNombreUsuario"];
    $IdRolUsuario      = $_POST["fIdRolUsuario"];
    
    $CorreoUsuario = htmlspecialchars($CorreoUsuario);
    $ClaveUsuario = htmlspecialchars ($ClaveUsuario);
    $FechaRegistroUsuario = htmlspecialchars ($FechaRegistroUsuario);
    $NombreUsuario = htmlspecialchars ($NombreUsuario);
    $IdRolUsuario = htmlspecialchars ($IdRolUsuario);
    
    $objetoUsuario = new Usuario($conexion, $IdUsuario, $CorreoUsuario, $ClaveUsuario, $FechaRegistroUsuario, $NombreUsuario, $IdRolUsuario);
    
    switch($opcion){
        case 'Ingresar':
            $objetoUsuario->insertar();
            $mensaje = "Insertado";
        break;
        case 'Modificar':
            $objetoUsuario->modificar();
            $mensaje = "Modificado";
        break;
        case 'Eliminar':
            $objetoUsuario->eliminar();
            $mensaje = "Eliminado";
        break;
    }
    
 $objetoConexion->desconectar($conexion);
 header("location:../Vista/formulariousuario.php?msj=$mensaje");
?>
</body>
</html>