<?php
    class TipodePago{
        private $_conexion;
        private $_IdTipodePago;
        private $_DescripcionTipodePago;
        private $_paginacion = 10;
        
        function __construct($conexion,$IdTipodePago,$DescripcionTipodePago){
            $this->_conexion = $conexion;
            $this->_IdTipodePago = $IdTipodePago;
            $this->_DescripcionTipodePago = $DescripcionTipodePago;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
    }
        function insertar(){
            $insercion = mysqli_query($this->_conexion,"INSERT INTO tipodepago (IdTipodePago, DescripcionTipodePago)VALUES (NULL,'$this->_DescripcionTipodePago')")or die (mysqli_error($this->_conexion));
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES(NULL,'Inserto ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $insercion;
        }
            function modificar(){
                "UPDATE tipodepago SET DescripcionTipodePago='$this->_DescripcionTipodePago' WHERE IdTipodePago=$this->_IdTipodePago";
                $modificacion = mysqli_query($this->_conexion,"UPDATE tipodepago SET DescripcionTipodePago='$this->_DescripcionTipodePago' WHERE IdTipodePago=$this->_IdTipodePago")or die (mysqli_error($this->_conexion));
                session_start();
                $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL, 'Modifico ".static::class."',".$S_ESSION['id'].",CURDATE())");
                return $modificacion;
                
            }
        function eliminar(){
            $eliminacion = mysqli_query($this->_conexion,"DELETE FROM tipodepago WHERE IdTipodePago=$this->_IdTipodePago");
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL,'Inserto ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $eliminacion;
        }
        
        function cantidadPaginas(){
            $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdTipodePago)/$this->_paginacion) AS cantidad FROM tipodepago");
            $unRegistro=mysqli_fetch_array($cantidadBloques);
            return $unRegistro ['cantidad'];
        }
        
        function listar($pagina){
            if ($pagina<=0){
                $listado = mysqli_query($this->_conexion,"SELECT * FROM tipodepago ORDER BY IdTipodePago");
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion,"SELECT * FROM tipodepago ORDER BY IdTipodePago LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
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