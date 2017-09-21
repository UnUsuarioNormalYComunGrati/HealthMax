<?php
    class Pedidos{
        private $_conexion;
        private $_IdPedidos;
        private $_FechaPedidos;
        private $_PersonaAtiende;
        private $_paginacion = 10;
        
        function __construct($conexion,$IdPedidos,$FechaPedidos,$PersonaAtiende){
            $this->_conexion = $conexion;
            $this->_IdPedidos = $IdPedidos;
            $this->_FechaPedidos = $FechaPedidos;
            $this->_PersonaAtiende = $PersonaAtiende;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
    }
        function insertar(){
            $insercion = mysqli_query($this->_conexion,"INSERT INTO pedidos (IdPedidos, FechaPedidos, PersonaAtiende)VALUES (NULL,'$this->_FechaPedidos','$this->_PersonaAtiende')")or die (mysqli_error($this->_conexion));
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES(NULL,'Inserto ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $insercion;
        }
            function modificar(){
                "UPDATE pedidos SET FechaPedidos='$this->_FechaPedidos',PersonaAtiende='$this->_PersonaAtiende' WHERE IdPedidos=$this->_IdPedidos";
                $modificacion = mysqli_query($this->_conexion,"UPDATE pedidos SET FechaPedidos='$this->_FechaPedidos',PersonaAtiende='$this->_PersonaAtiende' WHERE IdPedidos=$this->_IdPedidos")or die (mysqli_error($this->_conexion));
                session_start();
                $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL, 'Modifico ".static::class."',".$_SESSION['id'].",CURDATE())");
                return $modificacion;
                
            }
        function eliminar(){
            $eliminacion = mysqli_query($this->_conexion,"DELETE FROM pedidos WHERE IdPedidos=$this->_IdPedidos");
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL,'Elimino ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $eliminacion;
        }
        
        function cantidadPaginas(){
            $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdPedidos)/$this->_paginacion) AS cantidad FROM pedidos");
            $unRegistro=mysqli_fetch_array($cantidadBloques);
            return $unRegistro ['cantidad'];
        }
        
        function listar($pagina){
            if ($pagina<=0){
                $listado = mysqli_query($this->_conexion,"SELECT * FROM pedidos ORDER BY IdPedidos");
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion,"SELECT * FROM pedidos ORDER BY IdPedidos LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
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