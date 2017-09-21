
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Usuario</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        $formulario = "usuario";
        include_once("menu.php");
        $pagina = (isset($_GET['pag']))?$_GET['pag']:"1";
    ?>
    <div class="container">
    <header>
        <h1>Formulario Usuario</h1>
    </header>
    <table class="table-striped">
    <tbody>
        <tr>
        <th scope="col" class="breadcrumb">Correo Usuario</th>
        <th scope="col" class="breadcrumb">Clave Usuario</th>
        <th scope="col" class="breadcrumb">Fecha de Registro Usuario</th>
        <th scope="col" class="breadcrumb">Nombre del Usuario</th>
        <th scope="col" class="breadcrumb">Id Rol Usuario</th>
        <th scope="col" class="breadcrumb">Opciones</th>    
        </tr>
<?php
        include_once("../Modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();
        
        include_once("../Modelo/rol.php");
        $objetoRol = new Rol($conexion,0,'cliente','empleados','ventas','proveedores','productos','usuario','auditoria','nombre','rol','tipoproducto','atiende','detalle','recepcion','item','pedidos','administrador','empresa','tipodepago');
        $listaRoles = $objetoRol->listar(0);
        
        include_once("../Modelo/usuario.php");
        $objetoUsuario = new Usuario($conexion,0,'correo','clave','fecha','nombre','idrol');
        $listaUsuarios = $objetoUsuario->listar($pagina);
        $permiso = $objetoUsuario->getPermiso($_SESSION['id']);  
        
if (stripos($permiso,"r")!==false){//listar
        while($unRegistro = mysqli_fetch_array($listaUsuarios)){
            echo '<tr><form id="fModificarUsuario"'.$unRegistro["IdUsuario"].' action="../Controlador/Controladorusuario.php" method="post">';
            echo '<td><input type="hidden" name="fIdUsuario"         value="'.$unRegistro['IdUsuario'].'">';
            echo '    <input type="text" name="fCorreoUsuario"   class="form-control"   value="'.$unRegistro['CorreoUsuario'].'"></td>';
            echo '<td><input type="text" name="fClaveUsuario"   class="form-control"    value="'.$unRegistro['ClaveUsuario'].'"></td>';
            echo '<td><input type="date" name="fFechaRegistroUsuario" class="form-control" value="'.$unRegistro['FechaRegistroUsuario'].'"></td>';
            echo '<td><input type="text" name="fNombreUsuario" class="form-control"   value="'.$unRegistro['NombreUsuario'].'"></td>';
            echo '<td><select name="fIdRolUsuario" class="form-control">';
            while($otroRegistro = mysqli_fetch_array($listaRoles)){
                echo "<option value='{$otroRegistro['IdRol']}'";
                if($unRegistro['IdRolUsuario']==$otroRegistro['IdRol']){
                    echo " selected ";
                }
                echo ">{$otroRegistro['NombreRol']}</option>";
            }
            mysqli_data_seek($listaRoles,0);   
            echo '</select></td>';
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
            <tr><form id="fIngresarRol" action="../Controlador/Controladorusuario.php" method="post">
                <td><input type="hidden" name="fIdUsuario" value="0">
                    <input type="text" name="fCorreoUsuario" class="form-control"></td>
                <td><input type="text" name="fClaveUsuario" class="form-control"></td>
                <td><input type="date" name="fFechaRegistroUsuario" class="form-control"></td>
                <td><input type="text" name="fNombreUsuario" class="form-control"></td>
                <td><select name="fIdRolUsuario" class="form-control">
            <?php
                    while($otroRegistro = mysqli_fetch_array($listaRoles)){
                       echo "<option value='{$otroRegistro['IdRol']}'>{$otroRegistro['NombreRol']}</option>";
                    }
            ?>
                </select></td>    
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
        $cantPaginas=$objetoUsuario->cantidadPaginas();
        if($cantPaginas>1){
            if($pagina>1){
                echo '<li><a href="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
            }
            for($i=1;$i<=$cantPaginas;$i++){
                if($i==$pagina){
                    echo '<li class="active"><a href="#">'.$i.'</a></li>';
                }else{
                    echo '<li><a href="listarUsuario.php?pag='.$i.'">'.$i.'</a></li>';
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
    mysqli_free_result($listaUsuarios);
    $objetoConexion->desconectar($conexion);
?>
</div>
</body>
</html>
