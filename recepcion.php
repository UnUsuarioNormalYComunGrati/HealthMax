<?php
    class Recepcion{
        private $_conexion;
        private $_IdRecepcion;
        private $_FechaRecepcion;
        private $_CantidadRecibida;
        private $_IdItemRecepcion;
        private $_paginacion = 10;
        
        function __construct($conexion,$IdRecepcion,$FechaRecepcion,$CantidadRecibida,$IdItemRecepcion){
            $this->_conexion = $conexion;
            $this->_IdRecepcion = $IdRecepcion;
            $this->_FechaRecepcion = $FechaRecepcion;
            $this->_CantidadRecibida = $CantidadRecibida;
            $this->_IdItemRecepcion = $IdItemRecepcion;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
    }
        function insertar(){
            $insercion = mysqli_query($this->_conexion,"INSERT INTO recepcion (IdRecepcion, FechaRecepcion, CantidadRecibida, IdItemRecepcion)VALUES (NULL,'$this->_FechaRecepcion','$this->_CantidadRecibida','$this->_IdItemRecepcion')")or die (mysqli_error($this->_conexion));
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES(NULL,'Inserto ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $insercion;
        }
            function modificar(){
                echo "UPDATE recepcion SET FechaRecepcion='$this->_FechaRecepcion',CantidadRecibida='$this->_CantidadRecibida',IdItemRecepcion='$this->_IdItemRecepcion' WHERE IdRecepcion=$this->_IdRecepcion";
                $modificacion = mysqli_query($this->_conexion,"UPDATE recepcion SET FechaRecepcion='$this->_FechaRecepcion',CantidadRecibida='$this->_CantidadRecibida',IdItemRecepcion='$this->_IdItemRecepcion' WHERE IdRecepcion=$this->_IdRecepcion")or die (mysqli_error($this->_conexion));
                session_start();
                $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL, 'Modifico ".static::class."',".$_SESSION['id'].",CURDATE())");
                return $modificacion;
                
            }
        function eliminar(){
            $eliminacion = mysqli_query($this->_conexion,"DELETE FROM recepcion WHERE IdRecepcion=$this->_IdRecepcion");
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL,'Elimino ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $eliminacion;
        }
        
        function cantidadPaginas(){
            $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdRecepcion)/$this->_paginacion) AS cantidad FROM recepcion");
            $unRegistro=mysqli_fetch_array($cantidadBloques);
            return $unRegistro ['cantidad'];
        }
        
        function listar($pagina){
            if ($pagina<=0){
                $listado = mysqli_query($this->_conexion,"SELECT * FROM recepcion ORDER BY IdRecepcion");
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion,"SELECT * FROM recepcion ORDER BY IdRecepcion LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
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