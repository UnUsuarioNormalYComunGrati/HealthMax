<html><head></head><body>
<?php
    include_once("../Modelo/conexion.php");
    $objetoConexion = new conexion();
    $conexion = $objetoConexion->conectar();
    
    include_once("../Modelo/empleados.php");
    
    $opcion = $_POST["fEnviar"];
    $IdEmpleados           = $_POST["fIdEmpleados"];
    $NombreEmpleados      = $_POST["fNombreEmpleados"];
    $TurnoEmpleados       = $_POST["fTurnoEmpleados"];
    $DireccionEmpleados  = $_POST["fDireccionEmpleados"];
    $TelefonoEmpleados    = $_POST["fTelefonoEmpleados"];
    $IdAdministradorEmpleados      = $_POST["fIdAdministradorEmpleados"];
    
    $NombreEmpleados = htmlspecialchars($NombreEmpleados);
    $TurnoEmpleados = htmlspecialchars ($TurnoEmpleados);
    $DireccionEmpleados = htmlspecialchars ($DireccionEmpleados);
    $TelefonoEmpleados = htmlspecialchars ($TelefonoEmpleados);
    $IdAdministradorEmpleados = htmlspecialchars ($IdAdministradorEmpleados);
    
    $objetoEmpleados = new Empleados($conexion, $IdEmpleados, $NombreEmpleados, $TurnoEmpleados, $DireccionEmpleados, $TelefonoEmpleados, $IdAdministradorEmpleados);
    
    switch($opcion){
        case 'Ingresar':
            $objetoEmpleados->insertar();
            $mensaje = "Insertado";
        break;
        case 'Modificar':
            $objetoEmpleados->modificar();
            $mensaje = "Modificado";
        break;
        case 'Eliminar':
            $objetoEmpleados->eliminar();
            $mensaje = "Eliminado";
        break;
    }
    
 $objetoConexion->desconectar($conexion);
 header("location:../Vista/formularioempleados.php?msj=$mensaje");
?>
</body>
</html>