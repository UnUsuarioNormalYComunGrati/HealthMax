<?php
    session_start();
    if (isset($_SESSION['id'])){
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Auditoria</title>
   <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
     <?php
        $formulario = "auditoria";
        include_once("menu.php");
        $pagina = (isset($_GET['pag']))?$_GET['pag']:"1";
    ?>
    <div class="container">
    <header>
        <h1>Formulario Auditoria</h1>
    </header>
    <table class="table-striped">
    <tbody>
        <tr>
        <th scope="col" class="breadcrumb">Fecha Hora Auditoria</th>
        <th scope="col" class="breadcrumb">Detalle Auditoria</th>
        <th scope="col" class="breadcrumb">Usuario Auditoria</th>   
        </tr>
<?php
        include_once("../Modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();
        
        include_once("../Modelo/usuario.php");
        $objetoUsuario = new Usuario($conexion,0,'correo','clave','fecha','nombre','idrol');
        $listaUsuarios = $objetoUsuario->listar(0);
        
        include_once("../Modelo/auditoria.php");
        $objetoAuditoria = new Auditoria($conexion,0,'fechahoraauditoria','detalleauditoria','usuarioauditoria');
        $listaAuditorias = $objetoAuditoria->listar($pagina);
        while($unRegistro = mysqli_fetch_array($listaAuditorias)){
            echo '<tr><form id="fModificarAuditoria"'.$unRegistro["IdAuditoria"].' action="../Controlador/Controladorauditoria.php" method="post">';
            echo '<td><input type="hidden" name="fIdAuditoria"         value="'.$unRegistro['IdAuditoria'].'">';
            echo '    <input type="text" name="fFechaHoraAuditoria" class="form-control"    value="'.$unRegistro['FechaHoraAuditoria'].'"></td>';
            echo '<td><input type="text" name="fDetalleAuditoria" class="form-control"   value="'.$unRegistro['DetalleAuditoria'].'"></td>';
            echo '<td><text name="fIdUsuarioAudioria" class="form-control">';
            while($otroRegistro = mysqli_fetch_array($listaUsuarios)){
                
                if($unRegistro['IdUsuarioAuditoria']==$otroRegistro['IdUsuario']){
                   echo "<option value='{$otroRegistro['IdUsuario']}'>{$otroRegistro['NombreUsuario']}</option>";
                }
                
            }
            mysqli_data_seek($listaUsuarios,0); 
            echo '</td>';
            echo '</form></tr>';
        }
    ?>     
        </tbody>
    </table>
    <nav><ul class="pagination">
    <?php
        $cantPaginas=$objetoAuditoria->cantidadPaginas();
        if($cantPaginas>1){
            if($pagina>1){
                echo '<li><a href="formularioauditoria.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
            }
            for($i=1;$i<=$cantPaginas;$i++){
                if($i==$pagina){
                    echo '<li class="active"><a href="#">'.$i.'</a></li>';
                }else{
                    echo '<li><a href="formularioauditoria.php?pag='.$i.'">'.$i.'</a></li>';
                }
            }
            if ($pagina<$cantPaginas){
                echo '<li><a href="formularioauditoria.php?pag='.($pagina+1).'" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
            }
        }
    ?>
</ul></nav>
<?php    
    mysqli_free_result($listaAuditorias);
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