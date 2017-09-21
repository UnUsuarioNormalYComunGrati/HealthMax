<?php
    class TipodeProducto{
        private $_conexion;
        private $_IdTipodeProducto;
        private $_DescripcionTipodeproducto;
        private $_paginacion = 10;
        
        function __construct($conexion,$IdTipodeProducto,$DescripcionTipodeproducto){
            $this->_conexion = $conexion;
            $this->_IdTipodeProducto = $IdTipodeProducto;
            $this->_DescripcionTipodeproducto = $DescripcionTipodeproducto;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
    }
        function insertar(){
            $insercion = mysqli_query($this->_conexion,"INSERT INTO tipodeproducto (IdTipodeProducto, DescripcionTipodeproducto)VALUES (NULL,'$this->_DescripcionTipodeproducto')")or die (mysqli_error($this->_conexion));
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES(NULL,'Inserto ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $insercion;
        }
            function modificar(){
                "UPDATE tipodeproducto SET DescripcionTipodeproducto='$this->_DescripcionTipodeproducto' WHERE IdTipodeProducto=$this->_IdTipodeProducto";
                $modificacion = mysqli_query($this->_conexion,"UPDATE tipodeproducto SET DescripcionTipodeproducto='$this->_DescripcionTipodeproducto' WHERE IdTipodeProducto=$this->_IdTipodeProducto")or die (mysqli_error($this->_conexion));
                session_start();
                $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL, 'Modifico ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
                return $modificacion;
                
            }
        function eliminar(){
            $eliminacion = mysqli_query($this->_conexion,"DELETE FROM tipodeproducto WHERE IdTipodeProducto=$this->_IdTipodeProducto");
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL,'Elimino ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
            return $eliminacion;
        }
        
        function cantidadPaginas(){
            $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdTipodeProducto)/$this->_paginacion) AS cantidad FROM tipodeproducto");
            $unRegistro=mysqli_fetch_array($cantidadBloques);
            return $unRegistro ['cantidad'];
        }
        
        function listar($pagina){
            if ($pagina<=0){
                $listado = mysqli_query($this->_conexion,"SELECT * FROM tipodeproducto ORDER BY IdTipodeProducto");
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion,"SELECT * FROM tipodeproducto ORDER BY IdTipodeProducto LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
            }
            return $listado;
        }
        function getPermiso($idUsuario){
            $permisos=mysqli_query($this->_conexion,"SELECT ".static::class." AS elPermiso FROM rol WHERE IdRol IN(SELECT IdRolUsuario FROM Usuario WHERE IdUsuario = $idUsuario)");
            $unRegistro=mysqli_fetch_array($permisos);
            return $unRegistro["elPermiso"];
        }
    }
?>