-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2016 a las 17:35:58
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `IdAdministrador` mediumint(9) NOT NULL,
  `NombreAdministrador` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `DireccionAdministrador` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `TelefonoAdministrador` int(11) NOT NULL,
  `IdEmpresaAdministrador` mediumint(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=455649 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`IdAdministrador`, `NombreAdministrador`, `DireccionAdministrador`, `TelefonoAdministrador`, `IdEmpresaAdministrador`) VALUES
(455648, 'Juan Alberto Perez Sosa', 'Cra 6#6-26 Antioquia', 3156485, 25652);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atiende`
--

CREATE TABLE IF NOT EXISTS `atiende` (
  `idAtiende` mediumint(9) NOT NULL,
  `IdEmpleadosAtiende` mediumint(9) NOT NULL,
  `IdVentasAtiende` mediumint(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=875490 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `atiende`
--

INSERT INTO `atiende` (`idAtiende`, `IdEmpleadosAtiende`, `IdVentasAtiende`) VALUES
(875489, 98456, 894546);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE IF NOT EXISTS `auditoria` (
  `IdAuditoria` mediumint(9) NOT NULL,
  `FechaHoraAuditoria` date NOT NULL,
  `DetalleAuditoria` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `IdUsuarioAuditoria` mediumint(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5488 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`IdAuditoria`, `FechaHoraAuditoria`, `DetalleAuditoria`, `IdUsuarioAuditoria`) VALUES
(5487, '2014-05-04', 'Se ingreso un nuevo Administrador', 482134);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `IdClientes` mediumint(9) NOT NULL,
  `NombreClientes` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `TelefonoClientes` int(11) NOT NULL,
  `CedulaClientes` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=54549 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`IdClientes`, `NombreClientes`, `TelefonoClientes`, `CedulaClientes`) VALUES
(54548, 'Jonny Alejandro Fontecha Forero', 350154437, 102518542);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE IF NOT EXISTS `detalle` (
  `IdDetalle` mediumint(9) NOT NULL,
  `CantidadDetalle` int(11) NOT NULL,
  `IdVentasDetalle` mediumint(9) NOT NULL,
  `IdProductoDetalle` mediumint(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=564219 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle`
--

INSERT INTO `detalle` (`IdDetalle`, `CantidadDetalle`, `IdVentasDetalle`, `IdProductoDetalle`) VALUES
(564218, 15, 894546, 589754);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE IF NOT EXISTS `empleados` (
  `IdEmpleados` mediumint(9) NOT NULL,
  `NombreEmpleados` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `TurnoEmpleados` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `DireccionEmpleados` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `TelefonoEmpleados` int(11) NOT NULL,
  `IdAdministradorEmpleados` mediumint(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=98457 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`IdEmpleados`, `NombreEmpleados`, `TurnoEmpleados`, `DireccionEmpleados`, `TelefonoEmpleados`, `IdAdministradorEmpleados`) VALUES
(98456, 'Carlos Andres Perez Martinez', 'Tarde', 'Cra 9# 7-98 Bogota', 2147483647, 455648);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `IdEmpresa` mediumint(9) NOT NULL,
  `NombreEmpresa` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `TipoEmpresa` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `DireccionEmpresa` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `TelefonoEmpresa` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25653 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`IdEmpresa`, `NombreEmpresa`, `TipoEmpresa`, `DireccionEmpresa`, `TelefonoEmpresa`) VALUES
(25652, 'Health Max', 'Publico', 'Km 25 Via Bucaramanga', 785454651);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `IdItem` mediumint(9) NOT NULL,
  `CantidadItem` int(11) NOT NULL,
  `IdProductoItem` mediumint(9) NOT NULL,
  `IdPedidosItem` mediumint(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=98457 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `item`
--

INSERT INTO `item` (`IdItem`, `CantidadItem`, `IdProductoItem`, `IdPedidosItem`) VALUES
(98456, 20, 589754, 4152171);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `IdPedidos` mediumint(9) NOT NULL,
  `FechaPedidos` date NOT NULL,
  `PersonaAtiende` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4152172 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`IdPedidos`, `FechaPedidos`, `PersonaAtiende`) VALUES
(4152171, '2014-12-05', 'Ricardo Fontecha Pardo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `IdProducto` mediumint(9) NOT NULL,
  `NombreProducto` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `PrecioProducto` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `PrecioFabricaProducto` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `PrecioVenta` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `FechaVencimiento` date NOT NULL,
  `IdTipoProductoProducto` mediumint(9) NOT NULL,
  `IdProveedorProducto` mediumint(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=589755 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`IdProducto`, `NombreProducto`, `PrecioProducto`, `PrecioFabricaProducto`, `PrecioVenta`, `FechaVencimiento`, `IdTipoProductoProducto`, `IdProveedorProducto`) VALUES
(589754, 'Acetaminofen', '2500', '2000', '2800', '2016-12-08', 745485, 456898);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE IF NOT EXISTS `proveedor` (
  `IdProveedor` mediumint(9) NOT NULL,
  `NombreProveedor` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `TelefonoProveedor` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=456899 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`IdProveedor`, `NombreProveedor`, `TelefonoProveedor`) VALUES
(456898, 'Jhon Alexander Diaz Fontecha', 2147483647);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recepcion`
--

CREATE TABLE IF NOT EXISTS `recepcion` (
  `IdRecepcion` mediumint(9) NOT NULL,
  `FechaRecepcion` date NOT NULL,
  `CantidadRecibida` int(11) NOT NULL,
  `IdItemRecepcion` mediumint(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15342 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `recepcion`
--

INSERT INTO `recepcion` (`IdRecepcion`, `FechaRecepcion`, `CantidadRecibida`, `IdItemRecepcion`) VALUES
(15341, '2014-12-20', 40, 98456);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `IdRol` mediumint(9) NOT NULL,
  `ClienteRol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `VentasRol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `ProveedoresRol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `ProductosRol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `UsuarioRol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `AuditoriaRol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `NombreRol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `Rolrol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `TipoProducto` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `Atiende` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `DetalleRol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `RecepcionRol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `ItemRol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `PedidosRol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `AdministradorRol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `EmpresaRol` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `TipodePagoRol` varchar(4) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=454487 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`IdRol`, `ClienteRol`, `VentasRol`, `ProveedoresRol`, `ProductosRol`, `UsuarioRol`, `AuditoriaRol`, `NombreRol`, `Rolrol`, `TipoProducto`, `Atiende`, `DetalleRol`, `RecepcionRol`, `ItemRol`, `PedidosRol`, `AdministradorRol`, `EmpresaRol`, `TipodePagoRol`) VALUES
(454486, 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodepago`
--

CREATE TABLE IF NOT EXISTS `tipodepago` (
  `IdTipodepago` mediumint(9) NOT NULL,
  `DescripcionTipodePago` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4551322 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipodepago`
--

INSERT INTO `tipodepago` (`IdTipodepago`, `DescripcionTipodePago`) VALUES
(4551321, 'Decontado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodeproducto`
--

CREATE TABLE IF NOT EXISTS `tipodeproducto` (
  `IdTipodeProducto` mediumint(9) NOT NULL,
  `DescripcionTipoproducto` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=745486 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipodeproducto`
--

INSERT INTO `tipodeproducto` (`IdTipodeProducto`, `DescripcionTipoproducto`) VALUES
(745485, 'Hidratante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `IdUsuario` mediumint(9) NOT NULL,
  `CorreoUsuario` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `ClaveUsuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `FechaRegistroUsuario` date NOT NULL,
  `NombreUsuario` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `IdRolUsuario` mediumint(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=482135 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `CorreoUsuario`, `ClaveUsuario`, `FechaRegistroUsuario`, `NombreUsuario`, `IdRolUsuario`) VALUES
(482134, 'jadep@co.zq', 'Usuario1', '2010-06-06', 'Jairo Restrepo Muñoz', 454486);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE IF NOT EXISTS `ventas` (
  `IdVentas` mediumint(9) NOT NULL,
  `FechaVentas` date NOT NULL,
  `IdClienteVentas` mediumint(9) NOT NULL,
  `IdTipodePagoVentas` mediumint(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=894547 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`IdVentas`, `FechaVentas`, `IdClienteVentas`, `IdTipodePagoVentas`) VALUES
(894546, '2015-05-29', 54548, 4551321);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`IdAdministrador`), ADD KEY `IdEmpresaAdministrador` (`IdEmpresaAdministrador`);

--
-- Indices de la tabla `atiende`
--
ALTER TABLE `atiende`
  ADD PRIMARY KEY (`idAtiende`), ADD KEY `IdEmpleadosAtiende` (`IdEmpleadosAtiende`), ADD KEY `IdVentasAtiende` (`IdVentasAtiende`);

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`IdAuditoria`), ADD KEY `IdUsuarioAuditoria` (`IdUsuarioAuditoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`IdClientes`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`IdDetalle`), ADD KEY `IdVentasDetalle` (`IdVentasDetalle`), ADD KEY `IdProductoDetalle` (`IdProductoDetalle`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`IdEmpleados`), ADD KEY `IdAdministradorEmpleados` (`IdAdministradorEmpleados`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`IdEmpresa`);

--
-- Indices de la tabla `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`IdItem`), ADD KEY `IdProductoItem` (`IdProductoItem`), ADD KEY `IdPedidosItem` (`IdPedidosItem`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`IdPedidos`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`IdProducto`), ADD KEY `IdTipoProductoProducto` (`IdTipoProductoProducto`), ADD KEY `IdProveedorProducto` (`IdProveedorProducto`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`IdProveedor`);

--
-- Indices de la tabla `recepcion`
--
ALTER TABLE `recepcion`
  ADD PRIMARY KEY (`IdRecepcion`), ADD KEY `IdItemRecepcion` (`IdItemRecepcion`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`IdRol`);

--
-- Indices de la tabla `tipodepago`
--
ALTER TABLE `tipodepago`
  ADD PRIMARY KEY (`IdTipodepago`);

--
-- Indices de la tabla `tipodeproducto`
--
ALTER TABLE `tipodeproducto`
  ADD PRIMARY KEY (`IdTipodeProducto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IdUsuario`), ADD KEY `IdRolUsuario` (`IdRolUsuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`IdVentas`), ADD KEY `IdClienteVentas` (`IdClienteVentas`), ADD KEY `IdTipodePagoVentas` (`IdTipodePagoVentas`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `IdAdministrador` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=455649;
--
-- AUTO_INCREMENT de la tabla `atiende`
--
ALTER TABLE `atiende`
  MODIFY `idAtiende` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=875490;
--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `IdAuditoria` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5488;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `IdClientes` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54549;
--
-- AUTO_INCREMENT de la tabla `detalle`
--
ALTER TABLE `detalle`
  MODIFY `IdDetalle` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=564219;
--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `IdEmpleados` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=98457;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `IdEmpresa` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25653;
--
-- AUTO_INCREMENT de la tabla `item`
--
ALTER TABLE `item`
  MODIFY `IdItem` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=98457;
--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `IdPedidos` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4152172;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `IdProducto` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=589755;
--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `IdProveedor` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=456899;
--
-- AUTO_INCREMENT de la tabla `recepcion`
--
ALTER TABLE `recepcion`
  MODIFY `IdRecepcion` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15342;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `IdRol` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=454487;
--
-- AUTO_INCREMENT de la tabla `tipodepago`
--
ALTER TABLE `tipodepago`
  MODIFY `IdTipodepago` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4551322;
--
-- AUTO_INCREMENT de la tabla `tipodeproducto`
--
ALTER TABLE `tipodeproducto`
  MODIFY `IdTipodeProducto` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=745486;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=482135;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `IdVentas` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=894547;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`IdEmpresaAdministrador`) REFERENCES `empresa` (`IdEmpresa`);

--
-- Filtros para la tabla `atiende`
--
ALTER TABLE `atiende`
ADD CONSTRAINT `atiende_ibfk_1` FOREIGN KEY (`IdEmpleadosAtiende`) REFERENCES `empleados` (`IdEmpleados`),
ADD CONSTRAINT `atiende_ibfk_2` FOREIGN KEY (`IdVentasAtiende`) REFERENCES `ventas` (`IdVentas`);

--
-- Filtros para la tabla `auditoria`
--
ALTER TABLE `auditoria`
ADD CONSTRAINT `auditoria_ibfk_1` FOREIGN KEY (`IdUsuarioAuditoria`) REFERENCES `usuario` (`IdUsuario`);

--
-- Filtros para la tabla `detalle`
--
ALTER TABLE `detalle`
ADD CONSTRAINT `detalle_ibfk_1` FOREIGN KEY (`IdVentasDetalle`) REFERENCES `ventas` (`IdVentas`),
ADD CONSTRAINT `detalle_ibfk_2` FOREIGN KEY (`IdProductoDetalle`) REFERENCES `producto` (`IdProducto`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`IdAdministradorEmpleados`) REFERENCES `administrador` (`IdAdministrador`);

--
-- Filtros para la tabla `item`
--
ALTER TABLE `item`
ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`IdProductoItem`) REFERENCES `producto` (`IdProducto`),
ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`IdPedidosItem`) REFERENCES `pedidos` (`IdPedidos`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`IdTipoProductoProducto`) REFERENCES `tipodeproducto` (`IdTipodeProducto`),
ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`IdProveedorProducto`) REFERENCES `proveedor` (`IdProveedor`);

--
-- Filtros para la tabla `recepcion`
--
ALTER TABLE `recepcion`
ADD CONSTRAINT `recepcion_ibfk_1` FOREIGN KEY (`IdItemRecepcion`) REFERENCES `item` (`IdItem`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`IdRolUsuario`) REFERENCES `rol` (`IdRol`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`IdClienteVentas`) REFERENCES `clientes` (`IdClientes`),
ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`IdTipodePagoVentas`) REFERENCES `tipodepago` (`IdTipodepago`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
