<?php
    session_start();
    if (isset($_SESSION['id'])){
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Ventas</title>
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
     <?php
        $formulario = "ventas";
        include_once("menu.php");
        $pagina = (isset($_GET['pag']))?$_GET['pag']:"1";
    ?>
    <div class="container">
    <header>
        <h1>Formulario Ventas</h1>
    </header>
    <table class="table-striped">
    <tbody>
        <tr>
        <th scope="col" class="breadcrumb">Fecha Ventas</th>
        <th scope="col" class="breadcrumb">Cliente Ventas</th>
        <th scope="col" class="breadcrumb">Ventas Atiende</th>
        <th scope="col" class="breadcrumb">Opciones</th>    
        </tr>
<?php
        include_once("../Modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();
        
        include_once("../Modelo/clientes.php");
        $objetoClientes = new Clientes($conexion,0,'nombreclientes','telefonoclientes','cedulaclientes');
        $listaClientess = $objetoClientes->listar(0);
        
        include_once("../Modelo/tipodepago.php");
        $objetoTipodePago = new TipodePago($conexion,0,'nombreproveedor','telefonoproveedor');
        $listaTipodePagos = $objetoTipodePago->listar(0);
        
        include_once("../Modelo/ventas.php");
        $objetoVentas = new Ventas($conexion,0,'fechaventas','idclienteventas','idtipodepagoventas');
        $listaVentass = $objetoVentas->listar($pagina);
         $permiso = $objetoVentas->getPermiso($_SESSION['id']);  
        
if (stripos($permiso,"r")!==false){//listar
        while($unRegistro = mysqli_fetch_array($listaVentass)){
            echo '<tr><form id="fModificarVentas"'.$unRegistro["IdVentas"].' action="../Controlador/Controladorventas.php" method="post">';
            echo '<td><input type="hidden" name="fIdVentas"         value="'.$unRegistro['IdVentas'].'">';
            echo '    <input type="date" name="fFechaVentas" class="form-control"    value="'.$unRegistro['FechaVentas'].'"></td>';
            echo '<td><div class="input-field"><select name="fIdClienteVentas" class="form-control">';
            while($otroRegistro = mysqli_fetch_array($listaClientess)){
                echo "<option value='{$otroRegistro['IdClientes']}'";
                if($unRegistro['IdClienteVentas']==$otroRegistro['IdClientes']){
                    echo " selected ";
                }
                echo ">{$otroRegistro['NombreClientes']}</option>";
            }
            mysqli_data_seek($listaClientess,0);
            echo '</select></div></td>';
            echo '<td><div class="input-field"><select name="fIdTipodePagoVentas" class="form-control">';
            while($otroRegistro = mysqli_fetch_array($listaTipodePagos)){
                echo "<option value='{$otroRegistro['IdTipodePago']}'";
                if($unRegistro['IdTipodePagoVentas']==$otroRegistro['IdTipodePago']){
                    echo " selected ";
                }
                echo ">{$otroRegistro['DescripcionTipodePago']}</option>";
            }
            mysqli_data_seek($listaTipodePagos,0);
            echo '</select></div></td>';
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
            <tr><form id="fIngresarVentas" action="../Controlador/Controladorventas.php" method="post">
                <td><input type="hidden" name="fIdVentas" value="0">
                    <input type="date" name="fFechaVentas" class="form-control"></td>
                <td><select name="fIdClienteVentas" class="form-control">
            <?php
                    while($otroRegistro = mysqli_fetch_array($listaClientess)){
                       echo "<option value='{$otroRegistro['IdClientes']}'>{$otroRegistro['NombreClientes']}</option>";
                    }
            ?> 
                </select></td>
                <td><select name="fIdTipodePagoVentas" class="form-control">
            <?php
                    while($otroRegistro = mysqli_fetch_array($listaTipodePagos)){
                       echo "<option value='{$otroRegistro['IdTipodePago']}'>{$otroRegistro['DescripcionTipodePago']}</option>";
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
        $cantPaginas=$objetoVentas->cantidadPaginas();
        if($cantPaginas>1){
            if($pagina>1){
                echo '<li><a href="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
            }
            for($i=1;$i<=$cantPaginas;$i++){
                if($i==$pagina){
                    echo '<li class="active"><a href="#">'.$i.'</a></li>';
                }else{
                    echo '<li><a href="listarVentas.php?pag='.$i.'">'.$i.'</a></li>';
                }
            }
            if ($pagina<$cantPaginas){
                echo '<li><a href="#" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
            }
        }
    ?>
</ul></nav>
<?php
    mysqli_free_result($listaTipodePagos);
    mysqli_free_result($listaClientess);
    mysqli_free_result($listaVentass);
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