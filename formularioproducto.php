<?php
    session_start();
    if (isset($_SESSION['id'])){
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Producto</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
     <?php
        $formulario = "producto";
        include_once("menu.php");
        $pagina = (isset($_GET['pag']))?$_GET['pag']:"1";
    ?>
    <div class="container">
    <header>
        <h1>Formulario Producto</h1>
    </header>
    <table class="table-striped">
    <tbody>
        <tr>
        <th scope="col" class="breadcrumb">Nombre Producto</th>
        <th scope="col" class="breadcrumb">Precio Producto</th>
        <th scope="col" class="breadcrumb">Precio de Fabrica</th>
        <th scope="col" class="breadcrumb">Precio de Venta</th>
        <th scope="col" class="breadcrumb">Fecha de Vencimiento</th>
        <th scope="col" class="breadcrumb">Tipo Producto</th>
        <th scope="col" class="breadcrumb">Proveedor</th>
        <th scope="col" class="breadcrumb">Opciones</th>    
        </tr>
<?php
        include_once("../Modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();
        
        include_once("../Modelo/tipodeproducto.php");
        $objetoTipodeProducto = new TipodeProducto($conexion,0,'nombreproveedor','telefonoproveedor');
        $listaTipodeProductos = $objetoTipodeProducto->listar(0);
        
        include_once("../Modelo/proveedor.php");
        $objetoProveedor = new Proveedor($conexion,0,'nombreproveedor','telefonoproveedor');
        $listaProveedores = $objetoProveedor->listar(0);
        
        include_once("../Modelo/producto.php");
        $objetoProducto = new Producto($conexion,0,'nombreproducto','precioproducto','preciofabricaproducto','precioventa','fechavencimiento','idtipoproductoproducto','idproveedorproducto');
        $listaProductos = $objetoProducto->listar($pagina);
        $permiso = $objetoProducto->getPermiso($_SESSION['id']);  
        
if (stripos($permiso,"r")!==false){//listar
        while($unRegistro = mysqli_fetch_array($listaProductos)){
            echo '<tr><form id="fModificarProducto"'.$unRegistro["IdProducto"].' action="../Controlador/Controladorproducto.php" method="post">';
            echo '<td><input type="hidden" name="fIdProducto"         value="'.$unRegistro['IdProducto'].'">';
            echo '    <input type="text" name="fNombreProducto"  class="form-control"     value="'.$unRegistro['NombreProducto'].'"></td>';
            echo '<td><input type="text" name="fPrecioProducto"  class="form-control"     value="'.$unRegistro['PrecioProducto'].'"></td>';
            echo '<td><input type="text" name="fPrecioFabricaProducto"  class="form-control" value="'.$unRegistro['PrecioFabricaProducto'].'"></td>';
            echo '<td><input type="text" name="fPrecioVenta"  class="form-control"  value="'.$unRegistro['PrecioVenta'].'"></td>';
            echo '<td><input type="date" name="fFechaVencimiento"  class="form-control"    value="'.$unRegistro['FechaVencimiento'].'"></td>';
            echo '<td><select name="fIdTipoProductoProducto" class="form-control">';
            while($otroRegistro = mysqli_fetch_array($listaTipodeProductos)){
                echo "<option value='{$otroRegistro['IdTipodeProducto']}'";
                if($unRegistro['IdTipoProductoProducto']==$otroRegistro['IdTipodeProducto']){
                    echo " selected ";
                }
                echo ">{$otroRegistro['DescripcionTipoproducto']}</option>";
            }
            mysqli_data_seek($listaTipodeProductos,0);
            echo '</select></td>';
            echo '<td><select name="fIdProveedorProducto" class="form-control">';
            while($otroRegistro = mysqli_fetch_array($listaProveedores)){
                echo "<option value='{$otroRegistro['IdProveedor']}'";
                if($unRegistro['IdProveedorProducto']==$otroRegistro['IdProveedor']){
                    echo " selected ";
                }
                echo ">{$otroRegistro['NombreProveedor']}</option>";
            }
            mysqli_data_seek($listaProveedores,0);
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
            <tr><form id="fIngresarProducto" action="../Controlador/Controladorproducto.php" method="post">
                <td><input type="hidden" name="fIdProducto" value="0">
                    <input type="text" name="fNombreProducto" class="form-control"></td>
                <td><input type="text" name="fPrecioProducto" class="form-control"></td>
                <td><input type="text" name="fPrecioFabricaProducto" class="form-control"></td>
                <td><input type="text" name="fPrecioVenta" class="form-control"></td>
                <td><input type="date" name="fFechaVencimiento" class="form-control"></td>
                <td><select name="fIdTipoProductoProducto" class="form-control">
            <?php
                    while($otroRegistro = mysqli_fetch_array($listaTipodeProductos)){
                       echo "<option value='{$otroRegistro['IdTipodeProducto']}'>{$otroRegistro['DescripcionTipoproducto']}</option>";
                    }
            ?>     
                </select></td>
                <td><select name="fIdProveedorProducto" class="form-control">
            <?php
                    while($otroRegistro = mysqli_fetch_array($listaProveedores)){
                       echo "<option value='{$otroRegistro['IdProveedor']}'>{$otroRegistro['NombreProveedor']}</option>";
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
        $cantPaginas=$objetoProducto->cantidadPaginas();
        if($cantPaginas>1){
            if($pagina>1){
                echo '<li><a href="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
            }
            for($i=1;$i<=$cantPaginas;$i++){
                if($i==$pagina){
                    echo '<li class="active"><a href="#">'.$i.'</a></li>';
                }else{
                    echo '<li><a href="listarProducto.php?pag='.$i.'">'.$i.'</a></li>';
                }
            }
            if ($pagina<$cantPaginas){
                echo '<li><a href="#" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
            }
        }
    ?>
</ul></nav>
<?php
    mysqli_free_result($listaProveedores);
    mysqli_free_result($listaTipodeProductos);
    mysqli_free_result($listaProductos);
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