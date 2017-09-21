<?php
    class Rol{
        private $_conexion;
        private $_IdRol;
        private $_ClientesRol;
        private $_EmpleadosRol;
        private $_VentasRol;
        private $_ProveedoresRol;
        private $_ProductosRol;
        private $_UsuarioRol;
        private $_AuditoriaRol;
        private $_NombreRol;
        private $_Rolrol;
        private $_TipodeProducto;
        private $_Atiende;
        private $_DetalleRol;
        private $_RecepcionRol;
        private $_ItemRol;
        private $_PedidosRol;
        private $_AdministradorRol;
        private $_EmpresaRol;
        private $_TipodePagoRol;
        private $_paginacion = 10;
        
        function __construct($conexion,$IdRol,$ClientesRol,$EmpleadosRol,$VentasRol,$ProveedoresRol,$ProductosRol,$UsuarioRol,$AuditoriaRol,$NombreRol,$Rolrol,$TipodeProducto,$Atiende,$DetalleRol,$RecepcionRol,$ItemRol,$PedidosRol,$AdministradorRol,$EmpresaRol,$TipodePagoRol){
            $this->_conexion = $conexion;
            $this->_IdRol = $IdRol;
            $this->_ClientesRol = $ClientesRol;
            $this->_EmpleadosRol = $EmpleadosRol;
            $this->_VentasRol = $VentasRol;
            $this->_ProveedoresRol = $ProveedoresRol;
            $this->_ProductosRol = $ProductosRol;
            $this->_UsuarioRol = $UsuarioRol;
            $this->_AuditoriaRol = $AuditoriaRol;
            $this->_NombreRol = $NombreRol;
            $this->_Rolrol = $Rolrol;
            $this->_TipodeProducto = $TipodeProducto;
            $this->_Atiende = $Atiende;
            $this->_DetalleRol = $DetalleRol;
            $this->_RecepcionRol = $RecepcionRol;
            $this->_ItemRol = $ItemRol;
            $this->_PedidosRol = $PedidosRol;
            $this->_AdministradorRol = $AdministradorRol;
            $this->_EmpresaRol = $EmpresaRol;
            $this->_TipodePagoRol = $TipodePagoRol;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
    }
        function insertar(){
            $insercion = mysqli_query($this->_conexion,"INSERT INTO rol (IdRol, ClientesRol, EmpleadosRol, VentasRol, ProveedoresRol, ProductosRol, UsuarioRol, AuditoriaRol, NombreRol, Rolrol, TipodeProducto, Atiende, DetalleRol, RecepcionRol, ItemRol, PedidosRol, AdministradorRol, EmpresaRol, TipodePagoRol)VALUES (NULL,'$this->_ClientesRol','$this->_EmpleadosRol','$this->_VentasRol','$this->_ProveedoresRol','$this->_ProductosRol','$this->_UsuarioRol','$this->_AuditoriaRol','$this->_NombreRol','$this->_Rolrol','$this->_TipodeProducto','$this->_Atiende','$this->_DetalleRol','$this->_RecepcionRol','$this->_ItemRol','$this->_PedidosRol','$this->_AdministradorRol','$this->_EmpresaRol','$this->_TipodePagoRol')")or die (mysqli_error($this->_conexion));
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES(NULL,'Inserto ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $insercion;
        }
            function modificar(){
                "UPDATE rol SET ClientesRol='$this->_ClientesRol',EmpleadosRol='$this->_EmpleadosRol',VentasRol='$this->_VentasRol',ProveedoresRol='$this->_ProveedoresRol',ProductosRol='$this->_ProductosRol',UsuarioRol='$this->_UsuarioRol',AuditoriaRol='$this->_AuditoriaRol',NombreRol='$this->_NombreRol',Rolrol='$this->_Rolrol',TipodeProducto='$this->_TipodeProducto',Atiende='$this->_Atiende',DetalleRol='$this->_DetalleRol',RecepcionRol='$this->_RecepcionRol',ItemRol='$this->_ItemRol',PedidosRol='$this->_PedidosRol',AdministradorRol='$this->_AdministradorRol',EmpresaRol='$this->_EmpresaRol',TipodePagoRol='$this->_TipodePagoRol' WHERE IdRol=$this->_IdRol";
                $modificacion = mysqli_query($this->_conexion,"UPDATE rol SET ClientesRol='$this->_ClientesRol',VentasRol='$this->_VentasRol',ProveedoresRol='$this->_ProveedoresRol',ProductosRol='$this->_ProductosRol',UsuarioRol='$this->_UsuarioRol',AuditoriaRol='$this->_AuditoriaRol',NombreRol='$this->_NombreRol',Rolrol='$this->_Rolrol',TipodeProducto='$this->_TipodeProducto',Atiende='$this->_Atiende',DetalleRol='$this->_DetalleRol',RecepcionRol='$this->_RecepcionRol',ItemRol='$this->_ItemRol',PedidosRol='$this->_PedidosRol',AdministradorRol='$this->_AdministradorRol',EmpresaRol='$this->_EmpresaRol',TipodePagoRol='$this->_TipodePagoRol' WHERE IdRol=$this->_IdRol")or die (mysqli_error($this->_conexion));
                session_start();
                $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL, 'Modifico ".static::class."',".$_SESSION['id'].",CURDATE())");
                return $modificacion;
                
            }
        function eliminar(){
            $eliminacion = mysqli_query($this->_conexion,"DELETE FROM rol WHERE IdRol=$this->_IdRol");
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL,'Elimino ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $eliminacion;
        }
        
        function cantidadPaginas(){
            $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdRol)/$this->_paginacion) AS cantidad FROM rol");
            $unRegistro=mysqli_fetch_array($cantidadBloques);
            return $unRegistro ['cantidad'];
        }
        
        function listar($pagina){
            if ($pagina<=0){
                $listado = mysqli_query($this->_conexion,"SELECT * FROM rol ORDER BY IdRol");
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion,"SELECT * FROM rol ORDER BY IdRol LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
            }
            return $listado;
        }
        function getPermiso($idUsuario){
            $permisos=mysqli_query($this->_conexion,"SELECT ".static::class."rol AS elPermiso FROM rol WHERE IdRol IN(SELECT IdRolUsuario FROM Usuario WHERE IdUsuario = $idUsuario)");
            $unRegistro=mysqli_fetch_array($permisos);
            return $unRegistro["elPermiso"];
        }
    }
?>