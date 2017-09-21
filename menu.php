<nav>
<ul class="nav nav-pills">
    <li <?php echo ($formulario=="administrador")?"class='active'":""; ?>><a href="formularioadministrador.php">Administrador</a></li>
    <li <?php echo ($formulario=="atiende")?"class='active'":""; ?>><a href="formularioatiende.php">Atiende</a></li>
    <li <?php echo ($formulario=="auditoria")?"class='active'":""; ?>><a href="formularioauditoria.php">Auditoria</a></li>
    <li <?php echo ($formulario=="clientes")?"class='active'":""; ?>><a href="formularioclientes.php">Clientes</a></li>
    <li <?php echo ($formulario=="detalle")?"class='active'":""; ?>><a href="formulariodetalle.php">Detalle</a></li>
    <li <?php echo ($formulario=="empleados")?"class='active'":""; ?>><a href="formularioempleados.php">Empleados</a></li>
    <li <?php echo ($formulario=="empresa")?"class='active'":""; ?>><a href="formularioempresa.php">Empresa</a></li>
    <li <?php echo ($formulario=="item")?"class='active'":""; ?>><a href="formularioitem.php">Item</a></li>
    <li <?php echo ($formulario=="pedidos")?"class='active'":""; ?>><a href="formulariopedidos.php">Pedidos</a></li>
    <li <?php echo ($formulario=="producto")?"class='active'":""; ?>><a href="formularioproducto.php">Producto</a></li>
    <li <?php echo ($formulario=="proveedor")?"class='active'":""; ?>><a href="formularioproveedor.php">Proveedor</a></li>
    <li <?php echo ($formulario=="recepcion")?"class='active'":""; ?>><a href="formulariorecepcion.php">Recepcion</a></li>
    <li <?php echo ($formulario=="rol")?"class='active'":""; ?>><a href="formulariorol.php">Rol</a></li>
    <li <?php echo ($formulario=="tipodepago")?"class='active'":""; ?>><a href="formulariotipodepago.php">Tipo de Pago</a></li>
    <li <?php echo ($formulario=="tipodeproducto")?"class='active'":""; ?>><a href="formulariotipodeproducto.php">Tipo de producto</a></li>
    <li <?php echo ($formulario=="usuario")?"class='active'":""; ?>><a href="formulariousuario.php">Usuarios</a></li>
    <li <?php echo ($formulario=="ventas")?"class='active'":""; ?>><a href="formularioventas.php">Ventas</a></li>
    <li <?php echo ($formulario=="cessionout")?"class='active'":""; ?>><a href="cessionout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
</ul>
</nav>