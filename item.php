<?php
    class Item{
        private $_conexion;
        private $_IdItem;
        private $_CantidadItem;
        private $_IdProductoItem;
        private $_IdPedidosItem;
        private $_paginacion = 10;
        
        function __construct($conexion,$IdItem,$CantidadItem,$IdProductoItem,$IdPedidosItem){
            $this->_conexion = $conexion;
            $this->_IdItem = $IdItem;
            $this->_CantidadItem = $CantidadItem;
            $this->_IdProductoItem = $IdProductoItem;
            $this->_IdPedidosItem = $IdPedidosItem;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
    }
        function insertar(){
            $insercion = mysqli_query($this->_conexion,"INSERT INTO item (IdItem, CantidadItem, IdProductoItem, IdPedidosItem)VALUES (NULL,'$this->_CantidadItem','$this->_IdProductoItem','$this->_IdPedidosItem')")or die (mysqli_error($this->_conexion));
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES(NULL,'Inserto ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
            return $insercion;
        }
            function modificar(){
                "UPDATE item SET CantidadItem='$this->_CantidadItem',IdProductoItem='$this->_IdProductoItem',IdPedidosItem='$this->_IdPedidosItem' WHERE IdItem=$this->_IdItem";
                $modificacion = mysqli_query($this->_conexion,"UPDATE item SET CantidadItem='$this->_CantidadItem',IdProductoItem='$this->_IdProductoItem',IdPedidosItem='$this->_IdPedidosItem' WHERE IdItem=$this->_IdItem")or die (mysqli_error($this->_conexion));
                session_start();
                $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL, 'Modifico ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
                return $modificacion;
                
            }
        function eliminar(){
            $eliminacion = mysqli_query($this->_conexion,"DELETE FROM item WHERE IdItem=$this->_IdItem");
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL,'Elimino ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
            return $eliminacion;
        }
        
        function cantidadPaginas(){
            $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdItem)/$this->_paginacion) AS cantidad FROM item");
            $unRegistro=mysqli_fetch_array($cantidadBloques);
            return $unRegistro ['cantidad'];
        }
        
        function listar($pagina){
            if ($pagina<=0){
                $listado = mysqli_query($this->_conexion,"SELECT * FROM item ORDER BY IdItem");
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion,"SELECT * FROM item ORDER BY IdItem LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
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