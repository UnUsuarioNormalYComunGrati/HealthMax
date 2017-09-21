<?php
    class Empresa{
        private $_conexion;
        private $_IdEmpresa;
        private $_NombreEmpresa;
        private $_TipoEmpresa;
        private $_DireccionEmpresa;
        private $_TelefonoEmpresa;
        private $_paginacion = 10;
        
        function __construct($conexion,$IdEmpresa,$NombreEmpresa,$TipoEmpresa,$DireccionEmpresa,$TelefonoEmpresa){
            $this->_conexion = $conexion;
            $this->_IdEmpresa = $IdEmpresa;
            $this->_NombreEmpresa = $NombreEmpresa;
            $this->_TipoEmpresa = $TipoEmpresa;
            $this->_DireccionEmpresa = $DireccionEmpresa;
            $this->_TelefonoEmpresa = $TelefonoEmpresa;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
    }
        function insertar(){
            $insercion = mysqli_query($this->_conexion,"INSERT INTO empresa (IdEmpresa, NombreEmpresa, TipoEmpresa, DireccionEmpresa, TelefonoEmpresa)VALUES (NULL,'$this->_NombreEmpresa','$this->_TipoEmpresa','$this->_DireccionEmpresa','$this->_TelefonoEmpresa')")or die (mysqli_error($this->_conexion));
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES(NULL,'Inserto ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $insercion;
        }
        
        function modificar(){
                "UPDATE empresa SET NombreEmpresa='$this->_NombreEmpresa',TipoEmpresa='$this->_TipoEmpresa',DireccionEmpresa='$this->_DireccionEmpresa',TelefonoEmpresa='$this->_TelefonoEmpresa' WHERE IdEmpresa=$this->_IdEmpresa";
                
                $modificacion=mysqli_query($this->_conexion,"UPDATE empresa SET NombreEmpresa='$this->_NombreEmpresa',TipoEmpresa='$this->_TipoEmpresa',DireccionEmpresa='$this->_DireccionEmpresa',TelefonoEmpresa='$this->_TelefonoEmpresa' WHERE IdEmpresa=$this->_IdEmpresa")or die (mysqli_error($this->_conexion));
                session_start();
                $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL, 'Modifico ".static::class."',".$_SESSION['id'].",CURDATE())");
                return $modificacion;  
        }
        
        function eliminar(){
            $eliminacion = mysqli_query($this->_conexion,"DELETE FROM empresa WHERE IdEmpresa=$this->_IdEmpresa");
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL,'Elimino ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $eliminacion;
        }
        
        function cantidadPaginas(){
            $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdEmpresa)/$this->_paginacion) AS cantidad FROM empresa");
            $unRegistro=mysqli_fetch_array($cantidadBloques);
            return $unRegistro ['cantidad'];
        }
        
        function listar($pagina){
            if ($pagina<=0){
                $listado = mysqli_query($this->_conexion,"SELECT * FROM empresa ORDER BY IdEmpresa");
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion,"SELECT * FROM empresa ORDER BY IdEmpresa LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
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