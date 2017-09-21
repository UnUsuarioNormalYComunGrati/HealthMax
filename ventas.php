<?php
    class Ventas{
        private $_conexion;
        private $_IdVentas;
        private $_FechaVentas;
        private $_IdClienteVentas;
        private $_IdTipodePagoVentas;
        private $_paginacion = 10;
        
        function __construct($conexion,$IdVentas,$FechaVentas,$IdClienteVentas,$IdTipodePagoVentas){
            $this->_conexion = $conexion;
            $this->_IdVentas = $IdVentas;
            $this->_FechaVentas = $FechaVentas;
            $this->_IdClienteVentas = $IdClienteVentas;
            $this->_IdTipodePagoVentas = $IdTipodePagoVentas;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
    }
        function insertar(){
            $insercion = mysqli_query($this->_conexion,"INSERT INTO ventas (IdVentas, FechaVentas, IdClienteVentas, IdTipodePagoVentas)VALUES (NULL,'$this->_FechaVentas','$this->_IdClienteVentas','$this->_IdTipodePagoVentas')")or die (mysqli_error($this->_conexion));
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES(NULL,'Inserto ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $insercion;
        }
            function modificar(){
                "UPDATE ventas SET FechaVentas='$this->_FechaVentas',IdClienteVentas='$this->_IdClienteVentas',IdTipodePagoVentas='$this->_IdTipodePagoVentas' WHERE IdVentas=$this->_IdVentas";
                $modificacion = mysqli_query($this->_conexion,"UPDATE ventas SET FechaVentas='$this->_FechaVentas',IdClienteVentas='$this->_IdClienteVentas',IdTipodePagoVentas='$this->_IdTipodePagoVentas' WHERE IdVentas=$this->_IdVentas")or die (mysqli_error($this->_conexion));
                session_start();
                $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL, 'Modifico ".static::class."',".$_SESSION['id'].",CURDATE())");
                return $modificacion;
                
            }
        function eliminar(){
            $eliminacion = mysqli_query($this->_conexion,"DELETE FROM ventas WHERE IdVentas=$this->_IdVentas");
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL,'Elimino ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $eliminacion;
        }
        
        function cantidadPaginas(){
            $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdVentas)/$this->_paginacion) AS cantidad FROM ventas");
            $unRegistro=mysqli_fetch_array($cantidadBloques);
            return $unRegistro ['cantidad'];
        }
        
        function listar($pagina){
            if ($pagina<=0){
                $listado = mysqli_query($this->_conexion,"SELECT * FROM ventas ORDER BY IdVentas");
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion,"SELECT * FROM ventas ORDER BY IdVentas LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
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