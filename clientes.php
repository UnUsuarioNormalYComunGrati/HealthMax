<?php
    class Clientes{
        private $_conexion;
        private $_IdClientes;
        private $_NombreClientes;
        private $_TelefonoClientes;
        private $_CedulaClientes;
        private $_paginacion = 10;
        
        function __construct($conexion,$IdClientes,$NombreClientes,$TelefonoClientes,$CedulaClientes){
            $this->_conexion = $conexion;
            $this->_IdClientes = $IdClientes;
            $this->_NombreClientes = $NombreClientes;
            $this->_TelefonoClientes = $TelefonoClientes;
            $this->_CedulaClientes = $CedulaClientes;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
    }
        function insertar(){
            $insercion = mysqli_query($this->_conexion,"INSERT INTO clientes (IdClientes, NombreClientes, TelefonoClientes, CedulaClientes)VALUES (NULL,'$this->_NombreClientes','$this->_TelefonoClientes','$this->_CedulaClientes')")or die (mysqli_error($this->_conexion));
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES(NULL,'Inserto ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $insercion;
        }
            function modificar(){
                "UPDATE clientes SET NombreClientes='$this->_NombreClientes',TelefonoClientes='$this->_TelefonoClientes',CedulaClientes='$this->_CedulaClientes' WHERE IdClientes=$this->_IdClientes";
                $modificacion = mysqli_query($this->_conexion,"UPDATE clientes SET NombreClientes='$this->_NombreClientes',TelefonoClientes='$this->_TelefonoClientes',CedulaClientes='$this->_CedulaClientes' WHERE IdClientes=$this->_IdClientes")or die (mysqli_error($this->_conexion));
                session_start();
                $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL, 'Modifico ".static::class."',".$_SESSION['id'].",CURDATE())");
                return $modificacion;
                
            }
        function eliminar(){
            $eliminacion = mysqli_query($this->_conexion,"DELETE FROM clientes WHERE IdClientes=$this->_IdClientes");
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL,'Elimino ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $eliminacion;
        }
        
        function cantidadPaginas(){
            $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdClientes)/$this->_paginacion) AS cantidad FROM clientes");
            $unRegistro=mysqli_fetch_array($cantidadBloques);
            return $unRegistro ['cantidad'];
        }
        
        function listar($pagina){
            if ($pagina<=0){
                $listado = mysqli_query($this->_conexion,"SELECT * FROM clientes ORDER BY IdClientes");
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion,"SELECT * FROM clientes ORDER BY IdClientes LIMIT  $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
            }
            return $listado;
        }
         function getPermiso($idUsuario){
            $permisos=mysqli_query($this->_conexion,"SELECT ".static::class."rol AS elPermiso FROM rol WHERE IdRol IN(SELECT IdRolUsuario FROM Usuario WHERE IdUsuario = $idUsuario)")or die (mysqli_error($this->_conexion));
            $unRegistro=mysqli_fetch_array($permisos);
            return $unRegistro["elPermiso"];
        }
    }
?>