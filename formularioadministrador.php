<?php
    session_start();
    if (isset($_SESSION['id'])){
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Administrador</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<body>
    <?php
        $formulario = "administrador";
        include_once("menu.php");
        $pagina = (isset($_GET['pag']))?$_GET['pag']:"1";
    ?>
    <div class="container">
    <header>
        <h1>Formulario Administrador</h1>
    </header>
    <table class="table-striped">
    <tbody>
        <tr>
        <th scope="col" class="breadcrumb">Nombre Administrador</th>
        <th scope="col" class="breadcrumb">Direccion Administrador</th>
        <th scope="col" class="breadcrumb">Telefono Administrador</th>
        <th scope="col" class="breadcrumb">Empresa Administrador</th>
        <th scope="col" class="breadcrumb">Opciones</th>    
        </tr>
<?php
        include_once("../Modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();
        
        include_once("../Modelo/empresa.php");
        $objetoEmpresa = new Empresa($conexion,0,'nombreempresa','tipoempresa','direccionempresa','telefonoempresa');
        $listaEmpresas = $objetoEmpresa->listar(0);
        
        include_once("../Modelo/administrador.php");
        $objetoAdministrador = new Administrador($conexion,0,'nombreadministrador','direccionadministrador','telefonoadministrador','idempresaadministrador');
        $listaAdministradores = $objetoAdministrador->listar($pagina);
        $permiso = $objetoAdministrador->getPermiso($_SESSION['id']);  
        
if (stripos($permiso,"r")!==false){//listar
        while($unRegistro = mysqli_fetch_array($listaAdministradores)){
            echo '<tr><form id="fModificarAdministrador"'.$unRegistro["IdAdministrador"].' action="../Controlador/Controladoradministrador.php" method="post">';
            echo '<td><input type="hidden" name="fIdAdministrador"         value="'.$unRegistro['IdAdministrador'].'">';
            echo '    <input type="text" class="form-control" name="fNombreAdministrador"      value="'.$unRegistro['NombreAdministrador'].'"></td>';
            echo '<td><input type="text" class="form-control" name="fDireccionAdministrador"       value="'.$unRegistro['DireccionAdministrador'].'"></td>';
            echo '<td><input type="text" class="form-control" name="fTelefonoAdministrador"  value="'.$unRegistro['TelefonoAdministrador'].'"></td>';
            echo '<td><select name="fIdEmpresaAdministrador" class="form-control">';
            while($otroRegistro = mysqli_fetch_array($listaEmpresas)){
                echo "<option value='{$otroRegistro['IdEmpresa']}'";
                if($unRegistro['IdEmpresaAdministrador']==$otroRegistro['IdEmpresa']){
                    echo " selected ";
                }
                echo ">{$otroRegistro['NombreEmpresa']}</option>";
            }
            mysqli_data_seek($listaEmpresas,0);
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
            <tr><form id="fIngresarAdministrador" action="../Controlador/Controladoradministrador.php" method="post">
                <td><input type="hidden" name="fIdAdministrador" value="0">
                    <input type="text" class="form-control" name="fNombreAdministrador"></td>
                <td><input type="text" class="form-control" name="fDireccionAdministrador"></td>
                <td><input type="text" class="form-control" name="fTelefonoAdministrador"></td>
                <td><select class="form-control" name="fIdEmpresaAdministrador">
            <?php
                    while($otroRegistro = mysqli_fetch_array($listaEmpresas)){
                       echo "<option value='{$otroRegistro['IdEmpresa']}'>{$otroRegistro['NombreEmpresa']}</option>";
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
        $cantPaginas=$objetoAdministrador->cantidadPaginas();
        if($cantPaginas>1){
            if($pagina>1){
                echo '<li><a href="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
            }
            for($i=1;$i<=$cantPaginas;$i++){
                if($i==$pagina){
                    echo '<li class="active"><a href="#">'.$i.'</a></li>';
                }else{
                    echo '<li><a href="formularioAdministrador.php?pag='.$i.'">'.$i.'</a></li>';
                }
            }
            if ($pagina<$cantPaginas){
                echo '<li><a href="#" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
            }
        }
    ?>
</ul></nav>
<?php
    mysqli_free_result($listaEmpresas);
    mysqli_free_result($listaAdministradores);
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