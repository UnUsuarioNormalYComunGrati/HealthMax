<?php
    session_start();
    if (isset($_SESSION['id'])){
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Empleados</title>
   <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        $formulario = "empleados";
        include_once("menu.php");
        $pagina = (isset($_GET['pag']))?$_GET['pag']:"1";
    ?>
    <div class="container">
    <header>
        <h1>Formulario Empleados</h1>
    </header>
    <table class="table-striped">
    <tbody>
        <tr>
        <th scope="col" class="breadcrumb">Nombre Empleado</th>
        <th scope="col" class="breadcrumb">Turno Empleado</th>
        <th scope="col" class="breadcrumb">Direccion Empleado</th>
        <th scope="col" class="breadcrumb">Telefono Empleado</th>
        <th scope="col" class="breadcrumb">Administrador</th>
        <th scope="col" class="breadcrumb">Opciones</th>    
        </tr>
<?php
        include_once("../Modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();
        
        include_once("../Modelo/administrador.php");
        $objetoAdministrador = new Administrador($conexion,0,'nombreadministrador','direccionadministrador','telefonoadministrador','idempresaadministrador');
        $listaAdministradores = $objetoAdministrador->listar(0);
        
        include_once("../Modelo/empleados.php");
        $objetoEmpleados = new Empleados($conexion,0,'nombreempleados','turnoempleados','direccionempleados','telefonoempleados','idadministradorempleados');
        $listaEmpleadoss = $objetoEmpleados->listar(0);
         $listaEmpleadoss = $objetoEmpleados->listar($pagina);
        $permiso = $objetoEmpleados->getPermiso($_SESSION['id']);  
        
if (stripos($permiso,"r")!==false){//listar
        while($unRegistro = mysqli_fetch_array($listaEmpleadoss)){
            echo '<tr><form id="fModificarEmpleados"'.$unRegistro["IdEmpleados"].' action="../Controlador/Controladorempleados.php" method="post">';
            echo '<td><input type="hidden" name="fIdEmpleados"         value="'.$unRegistro['IdEmpleados'].'">';
            echo '    <input type="text" name="fNombreEmpleados" class="form-control"      value="'.$unRegistro['NombreEmpleados'].'"></td>';
            echo '<td><input type="text" name="fTurnoEmpleados"  class="form-control"     value="'.$unRegistro['TurnoEmpleados'].'"></td>';
            echo '<td><input type="text" name="fDireccionEmpleados" class="form-control"  value="'.$unRegistro['DireccionEmpleados'].'"></td>';
            echo '<td><input type="text" name="fTelefonoEmpleados"  class="form-control"  value="'.$unRegistro['TelefonoEmpleados'].'"></td>';
            echo '<td><select name="fIdAdministradorEmpleados" class="form-control">';
            while($otroRegistro = mysqli_fetch_array($listaAdministradores)){
                echo "<option value='{$otroRegistro['IdAdministrador']}'";
                if($unRegistro['IdAdministradorEmpleados']==$otroRegistro['IdAdministrador']){
                    echo " selected ";
                }
                echo ">{$otroRegistro['NombreAdministrador']}</option>";
            }
            mysqli_data_seek($listaAdministradores,0);
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
            <tr><form id="fIngresarRol" action="../Controlador/Controladorempleados.php" method="post">
                <td><input type="hidden" name="fIdEmpleados" value="0">
                    <input type="text" class="form-control" name="fNombreEmpleados"></td>
                <td><input type="text" class="form-control" name="fTurnoEmpleados"></td>
                <td><input type="text" class="form-control" name="fDireccionEmpleados"></td>
                <td><input type="text" class="form-control" name="fTelefonoEmpleados"></td>
                <td><select name="fIdAdministradorEmpleados" class="form-control">
            <?php
                    while($otroRegistro = mysqli_fetch_array($listaAdministradores)){
                       echo "<option value='{$otroRegistro['IdAdministrador']}'>{$otroRegistro['NombreAdministrador']}</option>";
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
        $cantPaginas=$objetoEmpleados->cantidadPaginas();
        if($cantPaginas>1){
            if($pagina>1){
                echo '<li><a href="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
            }
            for($i=1;$i<=$cantPaginas;$i++){
                if($i==$pagina){
                    echo '<li class="active"><a href="#">'.$i.'</a></li>';
                }else{
                    echo '<li><a href="listarEmpleados.php?pag='.$i.'">'.$i.'</a></li>';
                }
            }
            if ($pagina<$cantPaginas){
                echo '<li><a href="#" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
            }
        }
    ?>
</ul></nav>
<?php
    mysqli_free_result($listaAdministradores);
    mysqli_free_result($listaEmpleadoss);
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