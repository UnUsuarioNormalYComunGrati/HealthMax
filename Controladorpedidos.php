<html><head></head><body>
<?php
    include_once("../Modelo/conexion.php");
    $objetoConexion = new conexion();
    $conexion = $objetoConexion->conectar();
    
    include_once("../Modelo/pedidos.php");
    
    $opcion = $_POST["fEnviar"];
    $IdPedidos           = $_POST["fIdPedidos"];
    $FechaPedidos      = $_POST["fFechaPedidos"];
    $PersonaAtiende       = $_POST["fPersonaAtiende"];
    
    $FechaPedidos = htmlspecialchars($FechaPedidos);
    $PersonaAtiende = htmlspecialchars ($PersonaAtiende);
    
    $objetoPedidos = new Pedidos($conexion, $IdPedidos, $FechaPedidos, $PersonaAtiende);
    
    switch($opcion){
        case 'Ingresar':
            $objetoPedidos->insertar();
            $mensaje = "Insertado";
        break;
        case 'Modificar':
            $objetoPedidos->modificar();
            $mensaje = "Modificado";
        break;
        case 'Eliminar':
            $objetoPedidos->eliminar();
            $mensaje = "Eliminado";
        break;
    }
    
 $objetoConexion->desconectar($conexion);
 header("location:../Vista/formulariopedidos.php?msj=$mensaje");
?>
</body>
</html>