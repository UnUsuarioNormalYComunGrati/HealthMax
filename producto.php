<?php
    class Producto{
        private $_conexion;
        private $_IdProducto;
        private $_NombreProducto;
        private $_PrecioProducto;
        private $_PrecioFabricaProducto;
        private $_PrecioVenta;
        private $_FechaVencimiento;
        private $_IdTipoProductoProducto;
        private $_IdProveedorProducto;
        private $_paginacion = 10;
        
        function __construct($conexion,$IdProducto,$NombreProducto,$PrecioProducto,$PrecioFabricaProducto,$PrecioVenta,$FechaVencimiento,$IdTipoProductoProducto,$IdProveedorProducto){
            $this->_conexion = $conexion;
            $this->_IdProducto = $IdProducto;
            $this->_NombreProducto = $NombreProducto;
            $this->_PrecioProducto = $PrecioProducto;
            $this->_PrecioFabricaProducto = $PrecioFabricaProducto;
            $this->_PrecioVenta = $PrecioVenta;
            $this->_FechaVencimiento = $FechaVencimiento;
            $this->_IdTipoProductoProducto = $IdTipoProductoProducto;
            $this->_IdProveedorProducto = $IdProveedorProducto;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
    }
        function insertar(){
            $insercion = mysqli_query($this->_conexion,"INSERT INTO producto (IdProducto, NombreProducto, PrecioProducto, PrecioFabricaProducto, PrecioVenta, FechaVencimiento, IdTipoProductoProducto, IdProveedorProducto)VALUES (NULL,'$this->_NombreProducto','$this->_PrecioProducto','$this->_PrecioFabricaProducto','$this->_PrecioVenta','$this->_FechaVencimiento','$this->_IdTipoProductoProducto','$this->_IdProveedorProducto')")or die (mysqli_error($this->_conexion));
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES(NULL,'Inserto ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $insercion;
        }
            function modificar(){
                "UPDATE producto SET NombreProducto='$this->_NombreProducto',PrecioProducto='$this->_PrecioProducto',PrecioFabricaProducto='$this->_PrecioFabricaProducto',PrecioVenta='$this->_PrecioVenta',FechaVencimiento='$this->_FechaVencimiento',IdTipoProductoProducto='$this->_IdTipoProductoProducto',IdProveedorProducto='$this->_IdProveedorProducto' WHERE IdProducto=$this->_IdProducto";
                $modificacion = mysqli_query($this->_conexion,"UPDATE producto SET NombreProducto='$this->_NombreProducto',PrecioProducto='$this->_PrecioProducto',PrecioFabricaProducto='$this->_PrecioFabricaProducto',PrecioVenta='$this->_PrecioVenta',FechaVencimiento='$this->_FechaVencimiento',IdTipoProductoProducto='$this->_IdTipoProductoProducto',IdProveedorProducto='$this->_IdProveedorProducto' WHERE IdProducto=$this->_IdProducto")or die (mysqli_error($this->_conexion));
                session_start();
                $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL, 'Modifico ".static::class."',".$_SESSION['id'].",CURDATE())");
                return $modificacion;
                
            }
        function eliminar(){
            $eliminacion = mysqli_query($this->_conexion,"DELETE FROM producto WHERE IdProducto=$this->_IdProducto");
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL,'Elimino ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $eliminacion;
        }
        
        function cantidadPaginas(){
            $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdProducto)/$this->_paginacion) AS cantidad FROM producto");
            $unRegistro=mysqli_fetch_array($cantidadBloques);
            return $unRegistro ['cantidad'];
        }
        
        function listar($pagina){
            if ($pagina<=0){
                $listado = mysqli_query($this->_conexion,"SELECT * FROM producto ORDER BY IdProducto");
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion,"SELECT * FROM producto ORDER BY IdProducto LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
            }
            return $listado;
        }
         function getPermiso($idUsuario){
            $permisos=mysqli_query($this->_conexion,"SELECT ".static::class."srol AS elPermiso FROM rol WHERE IdRol IN(SELECT IdRolUsuario FROM Usuario WHERE IdUsuario = $idUsuario)");
            $unRegistro=mysqli_fetch_array($permisos);
            return $unRegistro["elPermiso"];
        }
    }
?>