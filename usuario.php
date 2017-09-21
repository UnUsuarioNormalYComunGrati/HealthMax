<?php
    class Usuario{
        private $_conexion;
        private $_IdUsuario;
        private $_CorreoUsuario;
        private $_ClaveUsuario;
        private $_FechaRegistroUsuario;
        private $_NombreUsuario;
        private $_IdRolUsuario;
        private $_paginacion = 10;
        
        function __construct($conexion,$IdUsuario,$CorreoUsuario,$ClaveUsuario,$FechaRegistroUsuario,$NombreUsuario,$IdRolUsuario){
            $this->_conexion = $conexion;
            $this->_IdUsuario = $IdUsuario;
            $this->_CorreoUsuario = $CorreoUsuario;
            $this->_ClaveUsuario = $ClaveUsuario;
            $this->_FechaRegistroUsuario = $FechaRegistroUsuario;
            $this->_NombreUsuario = $NombreUsuario;
            $this->_IdRolUsuario = $IdRolUsuario;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
    }
        function insertar(){
            echo "INSERT INTO usuario (IdUsuario, CorreoUsuario, ClaveUsuario, FechaRegistroUsuario, NombreUsuario, IdRolUsuario)VALUES (NULL,'$this->_CorreoUsuario','$this->_ClaveUsuario','$this->_FechaRegistroUsuario','$this->_NombreUsuario','$this->_IdRolUsuario')";
            $insercion = mysqli_query($this->_conexion,"INSERT INTO usuario (IdUsuario, CorreoUsuario, ClaveUsuario, FechaRegistroUsuario,NombreUsuario, IdRolUsuario)VALUES (NULL,'$this->_CorreoUsuario','".hash('sha256', $this->_ClaveUsuario)."','$this->_FechaRegistroUsuario','$this->_NombreUsuario','$this->_IdRolUsuario')")or die (mysqli_error($this->_conexion));
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES(NULL,'Inserto ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $insercion;
        }
            function modificar(){
                "UPDATE usuario SET CorreoUsuario='$this->_CorreoUsuario',ClaveUsuario='$this->_ClaveUsuario',FechaRegistroUsuario='$this->_FechaRegistroUsuario',NombreUsuario='$this->_NombreUsuario',IdRolUsuario='$this->_IdRolUsuario' WHERE IdUsuario=$this->_IdUsuario";
                $modificacion = mysqli_query($this->_conexion,"UPDATE usuario SET CorreoUsuario='$this->_CorreoUsuario','".hash('sha256', $this->_ClaveUsuario)."',FechaRegistroUsuario='$this->_FechaRegistroUsuario',NombreUsuario='$this->_NombreUsuario',IdRolUsuario='$this->_IdRolUsuario' WHERE IdUsuario=$this->_IdUsuario")or die (mysqli_error($this->_conexion));
                session_start();
                $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL, 'Modifico ".static::class."',".$_SESSION['id'].",CURDATE())");
                return $modificacion;
                
            }
        function eliminar(){
            $eliminacion = mysqli_query($this->_conexion,"DELETE FROM usuario WHERE IdUsuario=$this->_IdUsuario");
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL,'Elimino ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $eliminacion;
        }
        
        function cantidadPaginas(){
            $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdUsuario)/$this->_paginacion) AS cantidad FROM usuario");
            $unRegistro=mysqli_fetch_array($cantidadBloques);
            return $unRegistro ['cantidad'];
        }
        
        function listar($pagina){
            if ($pagina<=0){
                $listado = mysqli_query($this->_conexion,"SELECT * FROM usuario ORDER BY IdUsuario");
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion,"SELECT * FROM usuario ORDER BY IdUsuario LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
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