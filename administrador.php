<?php
    class Administrador{
        private $_conexion;
        private $_IdAdministrador;
        private $_NombreAdministrador;
        private $_DireccionAdministrador;
        private $_TelefonoAdministrador;
        private $_IdEmpresaAdministrador;
        private $_paginacion = 10;
        
        function __construct($conexion,$IdAdministrador,$NombreAdministrador,$DireccionAdministrador,$TelefonoAdministrador,$IdEmpresaAdministrador){
            $this->_conexion = $conexion;
            $this->_IdAdministrador = $IdAdministrador;
            $this->_NombreAdministrador = $NombreAdministrador;
            $this->_DireccionAdministrador = $DireccionAdministrador;
            $this->_TelefonoAdministrador = $TelefonoAdministrador;
            $this->_IdEmpresaAdministrador = $IdEmpresaAdministrador;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
    }
        function insertar(){
            $insercion = mysqli_query($this->_conexion,"INSERT INTO administrador (IdAdministrador, NombreAdministrador, DireccionAdministrador, TelefonoAdministrador, IdEmpresaAdministrador)VALUES (NULL,'$this->_NombreAdministrador','$this->_DireccionAdministrador','$this->_TelefonoAdministrador','$this->_IdEmpresaAdministrador')")or die (mysqli_error($this->_conexion));
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES(NULL,'Inserto ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
            
            return $insercion;
        }
        
        function modificar(){
            "UPDATE administrador SET NombreAdministrador='$this->_NombreAdministrador',DireccionAdministrador='$this->_DireccionAdministrador',TelefonoAdministrador='$this->_TelefonoAdministrador',IdEmpresaAdministrador='$this->_IdEmpresaAdministrador' WHERE IdAdministrador=$this->_IdAdministrador";
            $modificacion = mysqli_query($this->_conexion,"UPDATE administrador SET NombreAdministrador='$this->_NombreAdministrador',DireccionAdministrador='$this->_DireccionAdministrador',TelefonoAdministrador='$this->_TelefonoAdministrador',IdEmpresaAdministrador='$this->_IdEmpresaAdministrador' WHERE IdAdministrador=$this->_IdAdministrador")or die (mysqli_error($this->_conexion));
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL, 'Modifico ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $modificacion;

        }
        
        function eliminar(){
            $eliminacion = mysqli_query($this->_conexion,"DELETE FROM administrador WHERE IdAdministrador=$this->_IdAdministrador");
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL,'Elimino ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
            return $eliminacion;
        }
        
        function cantidadPaginas(){
            $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdAdministrador)/$this->_paginacion) AS cantidad FROM administrador");
            $unRegistro=mysqli_fetch_array($cantidadBloques);
            return $unRegistro ['cantidad'];
        }
        
        function listar($pagina){
            if ($pagina<=0){
                $listado = mysqli_query($this->_conexion,"SELECT * FROM administrador ORDER BY IdAdministrador");
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion,"SELECT * FROM administrador ORDER BY IdAdministrador LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
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