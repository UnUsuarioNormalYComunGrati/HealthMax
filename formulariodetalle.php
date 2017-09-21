<?php
    session_start();
    if (isset($_SESSION['id'])){
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Detalle</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        $formulario = "detalle";
        include_once("menu.php");
        $pagina = (isset($_GET['pag']))?$_GET['pag']:"1";
    ?>
     <div class="container">
    <header>
        <h1>Formulario Detalle</h1>
    </header>
    <table class="table-striped">
    <tbody>
        <tr>
        <th scope="col" class="breadcrumb">Cantidad Detalle</th>
        <th scope="col" class="breadcrumb">Detalle de Ventas</th>
        <th scope="col" class="breadcrumb">Detalle de Producto</th>
        <th scope="col" class="breadcrumb">Opciones</th>    
        </tr>
<?php
        include_once("../Modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();
        
        include_once("../Modelo/producto.php");
        $objetoProducto = new Producto($conexion,0,'nombreproducto','precioproducto','preciofabricaproducto','precioventa','fechavencimiento','idtipoproductoproducto','idproveedorproducto');
        $listaProductos = $objetoProducto->listar(0);
        
         include_once("../Modelo/ventas.php");
        $objetoVentas = new Ventas($conexion,0,'fechaventas','idclienteventas','idtipodepagoventas');
        $listaVentass = $objetoVentas->listar(0);
        
        include_once("../Modelo/detalle.php");
        $objetoDetalle = new Detalle($conexion,0,'cantidaddetalle','idventasdetalle','idproductodetalle');
        $listaDetalles = $objetoDetalle->listar(0);
        $listaDetalles = $objetoDetalle->listar($pagina);
        $permiso = $objetoDetalle->getPermiso($_SESSION['id']);  
        
if (stripos($permiso,"r")!==false){//listar
        while($unRegistro = mysqli_fetch_array($listaDetalles)){
            echo '<tr><form id="fModificarDetalle"'.$unRegistro["IdDetalle"].' action="../Controlador/Controladordetalle.php" method="post">';
            echo '<td><input type="hidden" name="fIdDetalle"         value="'.$unRegistro['IdDetalle'].'">';
            echo '    <input type="text" name="fCantidadDetalle" class="form-control"      value="'.$unRegistro['CantidadDetalle'].'"></td>';
            echo '<td><select name="fIdVentasDetalle" class="form-control">';
            while($otroRegistro = mysqli_fetch_array($listaVentass)){
                echo "<option value='{$otroRegistro['IdVentas']}'";
                if($unRegistro['IdVentasDetalle']==$otroRegistro['IdVentas']){
                    echo " selected ";
                }
                echo ">{$otroRegistro['FechaVentas']}</option>";
            }
            mysqli_data_seek($listaVentass,0);
            echo '</select></td>';
            echo '<td><select name="fIdProductoDetalle" class="form-control">';
            while($otroRegistro = mysqli_fetch_array($listaProductos)){
                echo "<option value='{$otroRegistro['IdProducto']}'";
                if($unRegistro['IdProductoDetalle']==$otroRegistro['IdProducto']){
                    echo " selected ";
                }
                echo ">{$otroRegistro['NombreProducto']}</option>";
            }
            mysqli_data_seek($listaProductos,0);
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
            <tr><form id="fIngresarDetalle" action="../Controlador/Controladordetalle.php" method="post">
                <td><input type="hidden" name="fIdDetalle" value="0">
                    <input type="text" class="form-control" name="fCantidadDetalle"></td>
                <td><select name="fIdVentasDetalle" class="form-control">
            <?php
                    while($otroRegistro = mysqli_fetch_array($listaVentass)){
                       echo "<option value='{$otroRegistro['IdVentas']}'>{$otroRegistro['FechaVentas']}</option>";
                    }
            ?>    
                </select></td>
                <td><select name="fIdProductoDetalle" class="form-control">
            <?php
                    while($otroRegistro = mysqli_fetch_array($listaProductos)){
                       echo "<option value='{$otroRegistro['IdProducto']}'>{$otroRegistro['NombreProducto']}</option>";
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
        $cantPaginas=$objetoDetalle->cantidadPaginas();
        if($cantPaginas>1){
            if($pagina>1){
                echo '<li><a href="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
            }
            for($i=1;$i<=$cantPaginas;$i++){
                if($i==$pagina){
                    echo '<li class="active"><a href="#">'.$i.'</a></li>';
                }else{
                    echo '<li><a href="listarDetalle.php?pag='.$i.'">'.$i.'</a></li>';
                }
            }
            if ($pagina<$cantPaginas){
                echo '<li><a href="#" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
            }
        }
    ?>
</ul></nav>
<?php
    mysqli_free_result($listaVentass);
    mysqli_free_result($listaProductos);
    mysqli_free_result($listaDetalles);
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