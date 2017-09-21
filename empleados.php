<?php
    class Empleados{
        private $_conexion;
        private $_IdEmpleados;
        private $_NombreEmpleados;
        private $_TurnoEmpleados;
        private $_DireccionEmpleados;
        private $_TelefonoEmpleados;
        private $_IdAdministradorEmpleados;
        private $_paginacion = 10;
        
        function __construct($conexion,$IdEmpleados,$NombreEmpleados,$TurnoEmpleados,$DireccionEmpleados,$TelefonoEmpleados,$IdAdministradorEmpleados){
            $this->_conexion = $conexion;
            $this->_IdEmpleados = $IdEmpleados;
            $this->_NombreEmpleados = $NombreEmpleados;
            $this->_TurnoEmpleados = $TurnoEmpleados;
            $this->_DireccionEmpleados = $DireccionEmpleados;
            $this->_TelefonoEmpleados = $TelefonoEmpleados;
            $this->_IdAdministradorEmpleados = $IdAdministradorEmpleados;
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
    }
        function insertar(){
            $insercion = mysqli_query($this->_conexion,"INSERT INTO empleados (IdEmpleados, NombreEmpleados, TurnoEmpleados, DireccionEmpleados, TelefonoEmpleados, IdAdministradorEmpleados)VALUES (NULL,'$this->_NombreEmpleados','$this->_TurnoEmpleados','$this->_DireccionEmpleados','$this->_TelefonoEmpleados','$this->_IdAdministradorEmpleados')")or die (mysqli_error($this->_conexion));
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES(NULL,'Inserto ".static::class."',".$_SESSION['id'].",CURDATE())");
            return $insercion;
        }
            function modificar(){
                "UPDATE empleados SET NombreEmpleados='$this->_NombreEmpleados',TurnoEmpleados='$this->_TurnoEmpleados',DireccionEmpleados='$this->_DireccionEmpleados',TelefonoEmpleados='$this->_TelefonoEmpleados',IdAdministradorEmpleados='$this->_IdAdministradorEmpleados' WHERE IdEmpleados=$this->_IdEmpleados";
                $modificacion = mysqli_query($this->_conexion,"UPDATE empleados SET NombreEmpleados='$this->_NombreEmpleados',TurnoEmpleados='$this->_TurnoEmpleados',DireccionEmpleados='$this->_DireccionEmpleados',TelefonoEmpleados='$this->_TelefonoEmpleados',IdAdministradorEmpleados='$this->_IdAdministradorEmpleados' WHERE IdEmpleados=$this->_IdEmpleados")or die (mysqli_error($this->_conexion));
                session_start();
                $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL, 'Modifico ".static::class."',".$_SESSION['id'].",CURDATE())");
                return $modificacion;
                
            }
        function eliminar(){
            $eliminacion = mysqli_query($this->_conexion,"DELETE FROM empleados WHERE IdEmpleados=$this->_IdEmpleados");
            session_start();
            $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,FechaHoraAuditoria) VALUES (NULL,'Elimino ".static::class."',".$_SESSION['id'].",CURDATE())")or die (mysqli_error($this->_conexion));
            return $eliminacion;
        }
        
        function cantidadPaginas(){
            $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdEmpleados)/$this->_paginacion) AS cantidad FROM empleados");
            $unRegistro=mysqli_fetch_array($cantidadBloques);
            return $unRegistro ['cantidad'];
        }
        
        function listar($pagina){
            if ($pagina<=0){
                $listado = mysqli_query($this->_conexion,"SELECT * FROM empleados ORDER BY IdEmpleados");
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion,"SELECT * FROM empleados ORDER BY IdEmpleados LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
            }
            return $listado;
        }
        function getPermiso($idUsuario){
            $permisos=mysqli_query($this->_conexion,"SELECT ".static::class."rol AS elPermiso FROM rol WHERE IdRol IN(SELECT IdRolUsuario FROM Usuario WHERE IdUsuario = $idUsuario)") or die (mysqli_error($this->_conexion));
            $unRegistro=mysqli_fetch_array($permisos);
            return $unRegistro["elPermiso"];
        }
    }
?>