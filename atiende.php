<?php
    class Atiende{
        private $_conexion;
        private $_IdAtiende;
        private $_IdEmpleadosAtiende;
        private $_IdVentasAtiende;
        private $_paginacion = 10;
        
        function __construct($conexion,$IdAtiende,$IdEmpleadosAtiende,$IdVentasAtiende){
            $this->_conexion = $conexion;
            $this->_IdAtiende = $IdAtiende;
            $this->_IdEmpleadosAtiende = $IdEmpleadosAtiende;
            $this->_IdVentasAtiende = $IdVentasAtiende;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
    }
        function insertar(){
            $insercion = mysqli_query($this->_conexion,"INSERT INTO atiende (IdAtiende, IdEmpleadosAtiende, IdVentasAtiende)VALUES (NULL,'$this->_IdEmpleadosAtiende','$this->_IdVentasAtiende')")or die (mysqli_error($this->_conexion));
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES(NULL,'Inserto ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
            return $insercion;
        }
        
        function modificar(){
            "UPDATE atiende SET IdEmpleadosAtiende='$this->_IdEmpleadosAtiende',IdVentasAtiende='$this->_IdVentasAtiende' WHERE IdAtiende=$this->_IdAtiende";
            $modificacion = mysqli_query($this->_conexion,"UPDATE atiende SET IdEmpleadosAtiende='$this->_IdEmpleadosAtiende',IdVentasAtiende='$this->_IdVentasAtiende' WHERE IdAtiende=$this->_IdAtiende")or die (mysqli_error($this->_conexion));
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL, 'Modifico ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $modificacion;

        }
        
        function eliminar(){
            $eliminacion = mysqli_query($this->_conexion,"DELETE FROM atiende WHERE IdAtiende=$this->_IdAtiende");
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL,'Elimino ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
            return $eliminacion;
        }
        
        function cantidadPaginas(){
            $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdAtiende)/$this->_paginacion) AS cantidad FROM atiende");
            $unRegistro=mysqli_fetch_array($cantidadBloques);
            return $unRegistro ['cantidad'];
        }
        
       function listar($pagina){
            if ($pagina<=0){
                $listado = mysqli_query($this->_conexion,"SELECT * FROM atiende ORDER BY IdAtiende");
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion,"SELECT * FROM atiende ORDER BY IdAtiende LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
            }
            return $listado;
        }
        function getPermiso($idUsuario){
            $permisos=mysqli_query($this->_conexion,"SELECT ".static::class." AS elPermiso FROM rol WHERE IdRol IN(SELECT IdRolUsuario FROM Usuario WHERE IdUsuario = $idUsuario)")or die (mysqli_error($this->_conexion));
            $unRegistro=mysqli_fetch_array($permisos);
            return $unRegistro["elPermiso"];
        }
    }
?>