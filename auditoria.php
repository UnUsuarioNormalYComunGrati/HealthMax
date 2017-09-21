<?php
    class Auditoria{
        private $_conexion;
        private $_IdAuditoria;
        private $_FechaHoraAuditoria;
        private $_DetalleAuditoria;
        private $_IdUsuarioAudtoria;
        private $_paginacion = 10;
        
        function __construct($conexion,$IdAuditoria,$FechaHoraAuditoria,$DetalleAuditoria,$IdUsuarioAuditoria){
            $this->_conexion = $conexion;
            $this->_IdAuditoria = $IdAuditoria;
            $this->_FechaHoraAuditoria = $FechaHoraAuditoria;
            $this->_DetalleAuditoria = $DetalleAuditoria;
            $this->_IdUsuarioAuditoria = $IdUsuarioAuditoria;
            
        }
        function __get($k){
            return $this->$k;
        }
        function __set($k,$v){
            $this->$k = $v;
    }
        function insertar(){
            //$insercion = mysqli_query($this->_conexion,"INSERT INTO auditoria (IdAuditoria, FechaHoraAuditoria, DetalleAuditoria, IdUsuarioAuditoria)VALUES (NULL,'$this->_IdAuditoria','$this->_FechaHoraAuditoria','$this->_DetalleAuditoria','$this->_IdUsuarioAuditoria')")or die (mysqli_error($this->_conexion));
            //$auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES(NULL,'Inserto ".satic::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
            return $insercion;
        }
            function modificar(){
              //  "UPDATE auditoria SET FechaHoraAuditoria='$this->_FechaHoraAuditoria',DetalleAuditoria='$this->_DetalleAuditoria',IdUsuarioAuditoria='$this->_IdUsuarioAuditoria' WHERE IdAuditoria=$this->_IdAuditoria";
                $modificacion = mysqli_query($this->_conexion,"UPDATE auditoria SET FechaHoraAuditoria='$this->_FechaHoraAuditoria',DetalleAuditoria='$this->_DetalleAuditoria',IdUsuarioAuditoria='$this->_IdUsuarioAuditoria' WHERE IdAuditoria=$this->_IdAuditoria")or die (mysqli_error($this->_conexion));
                //$auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL, 'Modifico ".static::class.",".$SESSION['idUsuario'].",'CURDATE()')");
                return $modificacion;
                
            }
        function eliminar(){
            //$eliminacion = mysqli_query($this->_conexion,"DELETE FROM auditoria WHERE IdAuditoria=$this->_IdAuditoria");
            //$auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAudtoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
            return $eliminacion;
        }
        
        function cantidadPaginas(){
            $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdAuditoria)/$this->_paginacion) AS cantidad FROM auditoria");
            $unRegistro=mysqli_fetch_array($cantidadBloques);
            return $unRegistro ['cantidad'];
        }
        
        function listar($pagina){
            if ($pagina<=0){
                $listado = mysqli_query($this->_conexion,"SELECT * FROM auditoria ORDER BY IdAuditoria");
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado = mysqli_query($this->_conexion,"SELECT * FROM auditoria ORDER BY IdAuditoria LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
            }
            return $listado;
        }
    }
?>