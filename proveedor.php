<?php
    class Proveedor{
        private $_conexion;
        private $_IdProveedor;
        private $_NombreProveedor;
        private $_TelefonoProveedor;
        private $_paginacion = 10;
        
        function __construct($conexion,$IdProveedor,$NombreProveedor,$TelefonoProveedor){
            $this->_conexion = $conexion;
            $this->_IdProveedor = $IdProveedor;
            $this->_NombreProveedor = $NombreProveedor;
            $this->_TelefonoProveedor = $TelefonoProveedor;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
    }
        function insertar(){
            $insercion = mysqli_query($this->_conexion,"INSERT INTO proveedor (IdProveedor, NombreProveedor, TelefonoProveedor)VALUES (NULL,'$this->_NombreProveedor','$this->_TelefonoProveedor')")or die (mysqli_error($this->_conexion));
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES(NULL,'Inserto ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $insercion;
        }
            function modificar(){
                "UPDATE proveedor SET NombreProveedor='$this->_NombreProveedor',TelefonoProveedor='$this->_TelefonoProveedor' WHERE IdProveedor=$this->_IdProveedor";
                $modificacion = mysqli_query($this->_conexion,"UPDATE proveedor SET NombreProveedor='$this->_NombreProveedor',TelefonoProveedor='$this->_TelefonoProveedor' WHERE IdProveedor=$this->_IdProveedor")or die (mysqli_error($this->_conexion));
                session_start();
                $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL, 'Modifico ".static::class."',".$_SESSION['id'].",CURDATE())");
                return $modificacion;
                
            }
        function eliminar(){
            $eliminacion = mysqli_query($this->_conexion,"DELETE FROM proveedor WHERE IdProveedor=$this->_IdProveedor");
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL,'Elimino ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $eliminacion;
        }
        
        function cantidadPaginas(){
            $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdProveedor)/$this->_paginacion) AS cantidad FROM proveedor");
            $unRegistro=mysqli_fetch_array($cantidadBloques);
            return $unRegistro ['cantidad'];
        }
        
        function listar($pagina){
            if ($pagina<=0){
                $listado = mysqli_query($this->_conexion,"SELECT * FROM proveedor ORDER BY IdProveedor");
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion,"SELECT * FROM proveedor ORDER BY IdProveedor LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
            }
            return $listado;
        }
        function getPermiso($idUsuario){
            $permisos=mysqli_query($this->_conexion,"SELECT ".static::class."esrol AS elPermiso FROM rol WHERE IdRol IN(SELECT IdRolUsuario FROM Usuario WHERE IdUsuario = $idUsuario)");
            $unRegistro=mysqli_fetch_array($permisos);
            return $unRegistro["elPermiso"];
        }
    }
?>