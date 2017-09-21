<html><head></head><body>
<?php
    include_once("../Modelo/conexion.php");
    $objetoConexion = new conexion();
    $conexion = $objetoConexion->conectar();
    
    include_once("../Modelo/rol.php");
    
    $opcion = $_POST["fEnviar"];
    $IdRol           = $_POST["fIdRol"];
    $ClientesRol      = $_POST["fClientesRol"];
    $EmpleadosRol      = $_POST["fEmpleadosRol"];
    $VentasRol       = $_POST["fVentasRol"];
    $ProveedoresRol  = $_POST["fProveedoresRol"];
    $ProductosRol    = $_POST["fProductosRol"];
    $UsuarioRol      = $_POST["fUsuarioRol"];
    $AuditoriaRol    = $_POST["fAuditoriaRol"];
    $NombreRol = $_POST["fNombreRol"];
    $Rolrol = $_POST["fRolrol"];
    $TipodeProducto = $_POST["fTipodeProducto"];
    $Atiende = $_POST["fAtiende"];
    $DetalleRol = $_POST["fDetalleRol"];
    $RecepcionRol = $_POST["fRecepcionRol"];
    $ItemRol = $_POST["fItemRol"];
    $PedidosRol = $_POST["fPedidosRol"];
    $AdministradorRol = $_POST["fAdministradorRol"];
    $EmpresaRol = $_POST["fEmpresaRol"];
    $TipodePagoRol = $_POST["fTipodePagoRol"];
    
    $ClientesRol = htmlspecialchars($ClientesRol);
    $EmpleadosRol = htmlspecialchars($EmpleadosRol);
    $VentasRol = htmlspecialchars ($VentasRol);
    $ProveedoresRol = htmlspecialchars ($ProveedoresRol);
    $ProductosRol = htmlspecialchars ($ProductosRol);
    $UsuarioRol = htmlspecialchars ($UsuarioRol);
    $AuditoriaRol = htmlspecialchars ($AuditoriaRol);
    $NombreRol = htmlspecialchars ($NombreRol);
    $Rolrol = htmlspecialchars ($Rolrol);
    $TipodeProducto = htmlspecialchars ($TipodeProducto);
    $Atiende = htmlspecialchars ($Atiende);
    $DetalleRol = htmlspecialchars ($DetalleRol);
    $RecepcionRol = htmlspecialchars ($RecepcionRol);
    $ItemRol = htmlspecialchars ($ItemRol);
    $PedidosRol = htmlspecialchars ($PedidosRol);
    $AdministradorRol = htmlspecialchars ($AdministradorRol);
    $EmpresaRol = htmlspecialchars ($EmpresaRol);
    $TipodePagoRol = htmlspecialchars ($TipodePagoRol);
    
    $objetoRol = new Rol($conexion, $IdRol, $ClientesRol, $EmpleadosRol, $VentasRol, $ProveedoresRol, $ProductosRol, $UsuarioRol, $AuditoriaRol, $NombreRol, $Rolrol, $TipodeProducto, $Atiende, $DetalleRol, $RecepcionRol, $ItemRol, $PedidosRol, $AdministradorRol, $EmpresaRol, $TipodePagoRol);
    
    switch($opcion){
        case 'Ingresar':
            $objetoRol->insertar();
            $mensaje = "Insertado";
        break;
        case 'Modificar':
            $objetoRol->modificar();
            $mensaje = "Modificado";
        break;
        case 'Eliminar':
            $objetoRol->eliminar();
            $mensaje = "Eliminado";
        break;
    }
    
 $objetoConexion->desconectar($conexion);
 header("location:../Vista/formulariorol.php?msj=$mensaje");
?>
</body>
</html>