<html><head></head><body>
<?php
    include_once("../Modelo/conexion.php");
    $objetoConexion = new conexion();
    $conexion = $objetoConexion->conectar();
    
    include_once("../Modelo/atiende.php");
    
    $opcion = $_POST["fEnviar"];
    $IdAtiende           = $_POST["fIdAtiende"];
    $IdEmpleadosAtiende      = $_POST["fIdEmpleadosAtiende"];
    $IdVentasAtiende       = $_POST["fIdVentasAtiende"];
    
    $IdEmpleadosAtiende = htmlspecialchars($IdEmpleadosAtiende);
    $IdVentasAtiende = htmlspecialchars($IdVentasAtiende);
    
    $objetoAtiende = new Atiende($conexion, $IdAtiende, $IdEmpleadosAtiende, $IdVentasAtiende);
    
    switch($opcion){
        case 'Ingresar':
            $objetoAtiende->insertar();
            $mensaje = "Insertado";
        break;
        case 'Modificar':
            $objetoAtiende->modificar();
            $mensaje = "Modificado";
        break;
        case 'Eliminar':
            $objetoAtiende->eliminar();
            $mensaje = "Eliminado";
        break;
    }
    
 $objetoConexion->desconectar($conexion);
 header("location:../Vista/formularioatiende.php?msj=$mensaje");
?>
</body>