<?php
    class Detalle{
        private $_conexion;
        private $_IdDetalle;
        private $_CantidadDetalle;
        private $_IdVentasDetalle;
        private $_IdProductoDetalle;
        private $_paginacion = 10;
        
        function __construct($conexion,$IdDetalle,$CantidadDetalle,$IdVentasDetalle,$IdProductoDetalle){
            $this->_conexion = $conexion;
            $this->_IdDetalle = $IdDetalle;
            $this->_CantidadDetalle = $CantidadDetalle;
            $this->_IdVentasDetalle = $IdVentasDetalle;
            $this->_IdProductoDetalle = $IdProductoDetalle;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
    }
        function insertar(){
            $insercion = mysqli_query($this->_conexion,"INSERT INTO detalle (IdDetalle, CantidadDetalle, IdVentasDetalle, IdProductoDetalle)VALUES (NULL,'$this->_CantidadDetalle','$this->_IdVentasDetalle','$this->_IdProductoDetalle')")or die (mysqli_error($this->_conexion));
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES(NULL,'Inserto ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $insercion;
        }
            function modificar(){
                "UPDATE detalle SET CantidadDetalle='$this->_CantidadDetalle',IdVentasDetalle='$this->_IdVentasDetalle',IdProductoDetalle='$this->_IdProductoDetalle' WHERE IdDetalle=$this->_IdDetalle";
                $modificacion = mysqli_query($this->_conexion,"UPDATE detalle SET CantidadDetalle='$this->_CantidadDetalle',IdVentasDetalle='$this->_IdVentasDetalle',IdProductoDetalle='$this->_IdProductoDetalle' WHERE IdDetalle=$this->_IdDetalle")or die (mysqli_error($this->_conexion));
                session_start();
                $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL, 'Modifico ".static::class."',".$_SESSION['id'].",CURDATE())");
                return $modificacion;
                
            }
        function eliminar(){
            $eliminacion = mysqli_query($this->_conexion,"DELETE FROM detalle WHERE IdDetalle=$this->_IdDetalle");
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL,'Elimino ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $eliminacion;
        }
        
        function cantidadPaginas(){
            $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdDetalle)/$this->_paginacion) AS cantidad FROM detalle");
            $unRegistro=mysqli_fetch_array($cantidadBloques);
            return $unRegistro ['cantidad'];
        }
        
        function listar($pagina){
            if ($pagina<=0){
                $listado = mysqli_query($this->_conexion,"SELECT * FROM detalle ORDER BY IdDetalle");
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion,"SELECT * FROM detalle ORDER BY IdDetalle LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
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