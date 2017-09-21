<?php
    session_start();
    if (isset($_SESSION['id'])){
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Rol</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
     <?php
        $formulario = "rol";
        include_once("menu.php");
        $pagina = (isset($_GET['pag']))?$_GET['pag']:"1";
    ?>
    <div class="container">
    <header>
        <h1>Formulario Rol</h1>
    </header>
    <table class="table-striped">
    <tbody>
        <tr>
        <th scope="col" class="breadcrumb">Clientes</th>
        <th scope="col" class="breadcrumb">Empleados</th>    
        <th scope="col" class="breadcrumb">Ventas</th>
        <th scope="col" class="breadcrumb">Proveedores</th>
        <th scope="col" class="breadcrumb">Productos</th>
        <th scope="col" class="breadcrumb">Usuario</th>
        <th scope="col" class="breadcrumb">Auditoria</th>
        <th scope="col" class="breadcrumb">Nombre</th>
        <th scope="col" class="breadcrumb">Rol</th>
        <th scope="col" class="breadcrumb">Tipo de Producto</th>
        <th scope="col" class="breadcrumb">Atiende</th>
        <th scope="col" class="breadcrumb">Detalle</th>
        <th scope="col" class="breadcrumb">Recepcion</th>
        <th scope="col" class="breadcrumb">Item</th>
        <th scope="col" class="breadcrumb">Pedidos</th>
        <th scope="col" class="breadcrumb">Administrador</th>
        <th scope="col" class="breadcrumb">Empresa</th>
        <th scope="col" class="breadcrumb">Tipo de Pago</th>    
        <th scope="col" class="breadcrumb">Opciones</th>    
        </tr>
<?php
        include_once("../Modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();
        
        include_once("../Modelo/rol.php");
        $objetoRol = new Rol($conexion,0,'clientes','empleados','ventas','proveedores','productos','usuario','auditoria','nombre','rol','tipodeproducto','atiende','detalle','recepcion','item','pedidos','administrador','empresa','tipodepago');
        $listaRoles = $objetoRol->listar($pagina);
        $permiso = $objetoRol->getPermiso($_SESSION['id']);  
        
if (stripos($permiso,"r")!==false){//listar
        while($unRegistro = mysqli_fetch_array($listaRoles)){
            echo '<tr><form id="fModificarRol"'.$unRegistro["IdRol"].' action="../Controlador/Controladorrol.php" method="post">';
            echo '<td><input type="hidden" name="fIdRol"         value="'.$unRegistro['IdRol'].'">';
            echo '    <input type="text" name="fClientesRol"  class="form-control"    value="'.$unRegistro['ClientesRol'].'"></td>';
            echo '<td><input type="text" name="fEmpleadosRol"  class="form-control"     value="'.$unRegistro['EmpleadosRol'].'"></td>';
            echo '<td><input type="text" name="fVentasRol"   class="form-control"    value="'.$unRegistro['VentasRol'].'"></td>';
            echo '<td><input type="text" name="fProveedoresRol" class="form-control" value="'.$unRegistro['ProveedoresRol'].'"></td>';
            echo '<td><input type="text" name="fProductosRol"  class="form-control"  value="'.$unRegistro['ProductosRol'].'"></td>';
            echo '<td><input type="text" name="fUsuarioRol"  class="form-control"    value="'.$unRegistro['UsuarioRol'].'"></td>';
            echo '<td><input type="text" name="fAuditoriaRol"  class="form-control"  value="'.$unRegistro['AuditoriaRol'].'"></td>';
            echo '<td><input type="text" name="fNombreRol"   class="form-control"    value="'.$unRegistro['NombreRol'].'"></td>';
            echo '<td><input type="text" name="fRolrol"    class="form-control"      value="'.$unRegistro['Rolrol'].'"></td>';
            echo '<td><input type="text" name="fTipodeProducto"  class="form-control"  value="'.$unRegistro['TipodeProducto'].'"></td>';
            echo '<td><input type="text" name="fAtiende"    class="form-control"     value="'.$unRegistro['Atiende'].'"></td>';
            echo '<td><input type="text" name="fDetalleRol"   class="form-control"   value="'.$unRegistro['DetalleRol'].'"></td>';
            echo '<td><input type="text" name="fRecepcionRol"  class="form-control"  value="'.$unRegistro['RecepcionRol'].'"></td>';
            echo '<td><input type="text" name="fItemRol"    class="form-control"     value="'.$unRegistro['ItemRol'].'"></td>';
            echo '<td><input type="text" name="fPedidosRol"   class="form-control"   value="'.$unRegistro['PedidosRol'].'"></td>';
            echo '<td><input type="text" name="fAdministradorRol" class="form-control" value="'.$unRegistro['AdministradorRol'].'"></td>';
            echo '<td><input type="text" name="fEmpresaRol"  class="form-control"    value="'.$unRegistro['EmpresaRol'].'"></td>';
            echo '<td><input type="text" name="fTipodePagoRol" class="form-control" value="'.$unRegistro['TipodePagoRol'].'"></td>';
            echo '<td>';
            if (stripos($permiso,"u")!==false){//modificar
                echo '<button type="submit" class="btn btn-primary" name="fEnviar" value="Modificar"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modificar</button>';
            }
            if (stripos($permiso,"d")!==false){//eliminar
                echo '<button type="submit" class="btn btn-secondary" name="fEnviar" value="Eliminar"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Eliminar</button>';
            }
            echo '</td>';
            echo '</form></tr>';
        }
}//lista
    ?>
        <?php
        if (stripos($permiso,"c")!==false){//crear
        ?>
            <tr><form id="fIngresarRol" action="../Controlador/Controladorrol.php" method="post">
                <td><input type="hidden" name="fIdRol" value="0">
                    <input type="text" name="fClientesRol" class="form-control"></td>
                <td><input type="text" name="fEmpleadosRol" class="form-control"></td>
                <td><input type="text" name="fVentasRol" class="form-control"></td>
                <td><input type="text" name="fProveedoresRol" class="form-control"></td>
                <td><input type="text" name="fProductosRol" class="form-control"></td>
                <td><input type="text" name="fUsuarioRol" class="form-control"></td>
                <td><input type="text" name="fAuditoriaRol" class="form-control"></td>
                <td><input type="text" name="fNombreRol" class="form-control"></td>
                <td><input type="text" name="fRolrol" class="form-control"></td>
                <td><input type="text" name="fTipodeProducto" class="form-control"></td>
                <td><input type="text" name="fAtiende" class="form-control"></td>
                <td><input type="text" name="fDetalleRol" class="form-control"></td>
                <td><input type="text" name="fRecepcionRol" class="form-control"></td>
                <td><input type="text" name="fItemRol" class="form-control"></td>
                <td><input type="text" name="fPedidosRol" class="form-control"></td>
                <td><input type="text" name="fAdministradorRol" class="form-control"></td>
                <td><input type="text" name="fEmpresaRol" class="form-control"></td>
                <td><input type="text" name="fTipodePagoRol" class="form-control"></td>
                <td><button type="submit" class="btn btn-success" name="fEnviar" value="Ingresar"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ingresar</button>
                    <button type="reset" class="btn btn-info" name="fEnviar" value="Limpiar"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> Limpiar</button></td>
                </form></tr>
        <?php
        }//fin crear
        ?>
        </tbody>
    </table>
    <nav><ul class="pagination">
    <?php
        $cantPaginas=$objetoRol->cantidadPaginas();
        if($cantPaginas>1){
            if($pagina>1){
                echo '<li><a href="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
            }
            for($i=1;$i<=$cantPaginas;$i++){
                if($i==$pagina){
                    echo '<li class="active"><a href="#">'.$i.'</a></li>';
                }else{
                    echo '<li><a href="listarRol.php?pag='.$i.'">'.$i.'</a></li>';
                }
            }
            if ($pagina<$cantPaginas){
                echo '<li><a href="#" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
            }
        }
    ?>
</ul></nav>
<?php
    mysqli_free_result($listaRoles);
    $objetoConexion->desconectar($conexion);
?>
</div>
</body>
</html>
<?php
    }else{
        header("location:../index.html");
    }
?>