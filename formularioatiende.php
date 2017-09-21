<?php
    session_start();
    if (isset($_SESSION['id'])){
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Atiende</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
      <?php
        $formulario = "atiende";
        include_once("menu.php");
        $pagina = (isset($_GET['pag']))?$_GET['pag']:"1";
    ?>
     <div class="container">
    <header>
        <h1>Formulario Atiende</h1>
    </header>
    <table class="table-striped">
    <tbody>
        <tr>
        <th scope="col" class="breadcrumb">Empleados Atiende</th>
        <th scope="col" class="breadcrumb">Ventas Atiende</th>
        <th scope="col" class="breadcrumb">Opciones</th>    
        </tr>
<?php
        include_once("../Modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();
        
        include_once("../Modelo/empleados.php");
        $objetoEmpleados = new Empleados($conexion,0,'nombreempleados','turnoempleados','direccionempleados','telefonoempleados','idadministradorempleados');
        $listaEmpleadoss = $objetoEmpleados->listar(0);
        
        include_once("../Modelo/ventas.php");
        $objetoVentas = new Ventas($conexion,0,'fechaventas','idclienteventas','idtipodepagoventas');
        $listaVentass = $objetoVentas->listar(0);
        
        include_once("../Modelo/atiende.php");
        $objetoAtiende = new Atiende($conexion,0,'idempleadosatiende','idventasatiende');
        $listaAtiendes = $objetoAtiende->listar(0);
        $listaAtiendes = $objetoAtiende->listar($pagina);
        $permiso = $objetoAtiende->getPermiso($_SESSION['id']);
        
if (stripos($permiso,"r")!==false){//listar
        while($unRegistro = mysqli_fetch_array($listaAtiendes)){
            echo '<tr><form id="fModificarAtiende"'.$unRegistro["IdAtiende"].' action="../Controlador/Controladoratiende.php" method="post">';
            echo '<td><input type="hidden" name="fIdAtiende"         value="'.$unRegistro['IdAtiende'].'">';
            echo '    <select name="fIdEmpleadosAtiende" class="form-control">';
            while($otroRegistro = mysqli_fetch_array($listaEmpleadoss)){
                echo "<option value='{$otroRegistro['IdEmpleados']}'";
                if($unRegistro['IdEmpleadosAtiende']==$otroRegistro['IdEmpleados']){
                    echo " selected ";
                }
                echo ">{$otroRegistro['NombreEmpleados']}</option>";
            }
            mysqli_data_seek($listaEmpleadoss,0);
            echo '</select></td>';
            echo '<td><select name="fIdVentasAtiende" class="form-control">';
            while($otroRegistro = mysqli_fetch_array($listaVentass)){
                echo "<option value='{$otroRegistro['IdVentas']}'";
                if($unRegistro['IdVentasAtiende']==$otroRegistro['IdVentas']){
                    echo " selected ";
                }
                echo ">{$otroRegistro['FechaVentas']}</option>";
            }
            mysqli_data_seek($listaVentass,0);
            echo '</select></td>';
             echo '<td>';
            if (stripos($permiso,"u")!==false){//modificar
                echo '<button type="submit" name="fEnviar" class="btn btn-primary" value="Modificar"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modificar</button>';
            }
            if (stripos($permiso,"d")!==false){//eliminar
                echo '<button type="submit" name="fEnviar" class="btn btn-secondary" value="Eliminar"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Eliminar</button>';
            }
            echo '</td>';
            echo '</form></tr>';
        }
}//lista
    ?>
         <?php
        if (stripos($permiso,"c")!==false){//crear
        ?>
            <tr><form id="fIngresarAtiende" action="../Controlador/Controladoratiende.php" method="post">
                <td><input type="hidden" name="fIdAtiende" value="0">
                    <select name="fIdEmpleadosAtiende" class="form-control">
            <?php
                    while($otroRegistro = mysqli_fetch_array($listaEmpleadoss)){
                       echo "<option value='{$otroRegistro['IdEmpleados']}'>{$otroRegistro['NombreEmpleados']}</option>";
                    }
            ?>        
                    </select></td>
                <td><select name="fIdVentasAtiende" class="form-control">
            <?php
                    while($otroRegistro = mysqli_fetch_array($listaVentass)){
                       echo "<option value='{$otroRegistro['IdVentas']}'>{$otroRegistro['FechaVentas']}</option>";
                    }
            ?>
                </select></td>
                <td><button type="submit" name="fEnviar" class="btn btn-success" value="Ingresar"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ingresar</button>
                <button type="reset" name="fEnviar" class="btn btn-info" value="Limpiar"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> Limpiar</button></td>
                </form></tr>
        </tbody>
    </table>
     <?php
        }//fin crear
    ?>
    <nav><ul class="pagination">
    <?php
        $cantPaginas=$objetoAtiende->cantidadPaginas();
        if($cantPaginas>1){
            if($pagina>1){
                echo '<li><a href="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
            }
            for($i=1;$i<=$cantPaginas;$i++){
                if($i==$pagina){
                    echo '<li class="active"><a href="#">'.$i.'</a></li>';
                }else{
                    echo '<li><a href="listarAtiende.php?pag='.$i.'">'.$i.'</a></li>';
                }
            }
            if ($pagina<$cantPaginas){
                echo '<li><a href="#" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
            }
        }
    ?>
</ul></nav>
<?php
    mysqli_free_result($listaEmpleadoss);
    mysqli_free_result($listaVentass);
    mysqli_free_result($listaAtiendes);
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