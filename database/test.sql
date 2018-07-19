-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-07-2018 a las 17:59:34
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `test`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_hotel`
--

CREATE TABLE `auth_hotel` (
  `id` int(11) NOT NULL,
  `users_user_id` int(11) NOT NULL,
  `hoteles_hotel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `auth_hotel`
--

INSERT INTO `auth_hotel` (`id`, `users_user_id`, `hoteles_hotel_id`) VALUES
(17, 4, 1),
(18, 4, 2),
(19, 6, 3),
(20, 6, 4),
(21, 7, 4),
(22, 7, 5),
(23, 8, 4),
(24, 8, 5),
(25, 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `hoteles_hotel_id` int(11) NOT NULL,
  `coment_subjet` varchar(250) NOT NULL,
  `comment_text` varchar(250) NOT NULL,
  `comment_status` int(1) NOT NULL,
  `timestamp` datetime NOT NULL,
  `url` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id_comment`, `hoteles_hotel_id`, `coment_subjet`, `comment_text`, `comment_status`, `timestamp`, `url`) VALUES
(22, 5, 'Transfers', 'You received a new transfer', 1, '2018-07-18 17:14:39', 'index.php?r=transferencias%2Fview&id=23'),
(23, 1, 'Transfer Request', 'The hotel: Beach Palace requires a transfer', 0, '2018-07-18 23:38:37', 'index.php?r=request/view&id=15'),
(24, 2, 'Transfer Request', 'The hotel: Beach Palace requires a transfer', 0, '2018-07-18 23:38:37', 'index.php?r=request/view&id=15'),
(26, 5, 'Transfer Request', 'The hotel: Beach Palace requires a transfer', 1, '2018-07-18 23:38:37', 'index.php?r=request/view&id=15'),
(27, 3, 'Request accept', 'Your Transfer Request was accepted by: Le Blanc Spa Resorts', 1, '2018-07-18 23:55:41', 'index.php?r=request/view&id=15'),
(28, 1, 'Transfer Request', 'The hotel: Le Blanc Spa Resorts requires a transfer', 0, '2018-07-19 00:00:49', 'index.php?r=request/view&id=16'),
(29, 2, 'Transfer Request', 'The hotel: Le Blanc Spa Resorts requires a transfer', 0, '2018-07-19 00:00:49', 'index.php?r=request/view&id=16'),
(30, 3, 'Transfer Request', 'The hotel: Le Blanc Spa Resorts requires a transfer', 1, '2018-07-19 00:00:49', 'index.php?r=request/view&id=16'),
(31, 4, 'Transfer Request', 'The hotel: Le Blanc Spa Resorts requires a transfer', 1, '2018-07-19 00:00:49', 'index.php?r=request/view&id=16'),
(32, 4, 'Transfers', 'You received a new transfer', 1, '2018-07-19 16:04:29', 'index.php?r=transferencias%2Fview&id=24'),
(33, 3, 'Transfers', 'Transfer delivered', 1, '2018-07-19 16:06:49', 'index.php?r=transferencias/view&id=24'),
(34, 1, 'Transfer Request', 'The hotel: Beach Palace requires a transfer', 0, '2018-07-19 16:08:45', 'index.php?r=request/view&id=17'),
(35, 2, 'Transfer Request', 'The hotel: Beach Palace requires a transfer', 0, '2018-07-19 16:08:45', 'index.php?r=request/view&id=17'),
(36, 4, 'Transfer Request', 'The hotel: Beach Palace requires a transfer', 1, '2018-07-19 16:08:45', 'index.php?r=request/view&id=17'),
(37, 5, 'Transfer Request', 'The hotel: Beach Palace requires a transfer', 0, '2018-07-19 16:08:45', 'index.php?r=request/view&id=17'),
(38, 3, 'Request accept', 'Your Transfer Request was accepted by: Sun Palace', 1, '2018-07-19 16:09:12', 'index.php?r=request/view&id=17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hoteles`
--

CREATE TABLE `hoteles` (
  `hotel_id` int(11) NOT NULL,
  `hotel_name` varchar(50) NOT NULL,
  `hotel_address` varchar(100) NOT NULL,
  `hotel_phone` varchar(50) NOT NULL,
  `hotel_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `hoteles`
--

INSERT INTO `hoteles` (`hotel_id`, `hotel_name`, `hotel_address`, `hotel_phone`, `hotel_status`) VALUES
(1, 'cedis', 'av puerto morelos km unknow', '9982141345', 'active'),
(2, 'Moon Palace', 'some address', '9999999999', 'active'),
(3, 'Beach Palace', 'some address', '11234567890', 'active'),
(4, 'Sun Palace', 'some address', '1234567890', 'active'),
(5, 'Le Blanc Spa Resorts', 'some address', '1234567890', 'active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1527177810),
('m130524_201442_init', 1527177814);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `po`
--

CREATE TABLE `po` (
  `id` int(11) NOT NULL,
  `po_no` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `po`
--

INSERT INTO `po` (`id`, `po_no`, `description`) VALUES
(1, 'po-1', 'some description');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `po_item`
--

CREATE TABLE `po_item` (
  `id` int(11) NOT NULL,
  `po_item_no` varchar(10) NOT NULL,
  `quantity` double NOT NULL,
  `po_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `po_item`
--

INSERT INTO `po_item` (`id`, `po_item_no`, `quantity`, `po_id`) VALUES
(1, 'po-item-1', 10, 1),
(2, 'po-item-2', 20, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `prestamo_id` int(11) NOT NULL,
  `hoteles_hotel_id` int(11) NOT NULL,
  `users_user_id` int(11) NOT NULL,
  `prestamo_fecha` date NOT NULL,
  `prestamo_numero_empleado` int(11) NOT NULL,
  `prestamo_nombre_empleado` varchar(50) NOT NULL,
  `prestamo_fecha_entrega` date DEFAULT NULL,
  `prestamo_status` enum('delivered','on loan') NOT NULL,
  `prestamo_comentario` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`prestamo_id`, `hoteles_hotel_id`, `users_user_id`, `prestamo_fecha`, `prestamo_numero_empleado`, `prestamo_nombre_empleado`, `prestamo_fecha_entrega`, `prestamo_status`, `prestamo_comentario`) VALUES
(7, 2, 5, '2018-07-07', 123, 'Julian Javier Solis Herrera', '2018-07-07', 'on loan', 'The Collaborator Julian needs one wifi adaptor for his computer because don\'t have bluetooth.\r\nThe adapter was delivered in the same day and it\'s ok'),
(10, 4, 6, '2018-07-14', 666, 'Test user', NULL, 'delivered', 'need some items for his work'),
(12, 3, 6, '2018-07-17', 1, 'Fernando', '2018-07-17', 'delivered', 'testing save changes'),
(13, 3, 6, '2018-07-18', 1, '1', '2018-07-18', 'delivered', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo_articulos`
--

CREATE TABLE `prestamo_articulos` (
  `id` int(11) NOT NULL,
  `prestamos_prestamo_id` int(11) NOT NULL,
  `productos_product_id` int(11) NOT NULL,
  `producto_cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `prestamo_articulos`
--

INSERT INTO `prestamo_articulos` (`id`, `prestamos_prestamo_id`, `productos_product_id`, `producto_cantidad`) VALUES
(4, 7, 5, 1),
(7, 10, 10, 1),
(9, 12, 7, 1),
(10, 12, 8, 1),
(11, 12, 9, 1),
(12, 12, 19, 1),
(13, 12, 20, 1),
(14, 13, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `product_id` int(11) NOT NULL,
  `hoteles_hotel_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_image` varchar(250) DEFAULT 'product/not_available.png',
  `product_branch` varchar(50) NOT NULL,
  `product_provider` varchar(50) NOT NULL,
  `product_serial` varchar(250) DEFAULT NULL,
  `product_created_date` date NOT NULL,
  `product_stock` int(20) NOT NULL,
  `product_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`product_id`, `hoteles_hotel_id`, `product_name`, `product_image`, `product_branch`, `product_provider`, `product_serial`, `product_created_date`, `product_stock`, `product_status`) VALUES
(1, 1, 'cable hdmi', 'product/not_available.png', 'steren', 'IT Cancun', '', '2018-05-26', 1, 'active'),
(2, 1, 'audifonos', 'product/not_available.png', 'Steren', 'IT Movil Cancun', NULL, '2018-05-26', 4, 'active'),
(3, 1, 'SSD Adata 128 GB', 'product/not_available.png', 'Adata', 'Compu Co.', NULL, '2018-06-12', 2, 'active'),
(4, 2, 'Cable HDMI', 'product/not_available.png', 'Steren', 'Solulogic', NULL, '2018-07-07', 1, 'active'),
(5, 2, 'Bluetooth USB adapter', 'product/not_available.png', 'Stere', 'Solulogic', NULL, '2018-07-07', 3, 'active'),
(6, 2, 'Speakers  alambric', 'product/not_available.png', 'Logitech', 'Solulogic', NULL, '2018-07-07', 3, 'active'),
(7, 3, 'Bluetooth USB adapter', 'product/bluetooth.jpg', 'Logitech', 'Solulogic', 'MPLF010897HTCRS001', '2018-07-07', 0, 'inactive'),
(8, 3, 'USB Wifi Adapter', 'product/wifi.jpg', 'TP Link', 'Solulogic', NULL, '2018-07-07', 1, 'active'),
(9, 3, 'Speakers  alambric', 'product/bocinas.jpg', 'Steren', 'Solulogic', NULL, '2018-07-07', 0, 'inactive'),
(10, 4, 'UTP cable 2 metters', 'product/UTP cable 2 metters4.png', 'Steren', 'Solulogic', '', '2018-07-07', 2, 'active'),
(11, 4, 'Bluetooth USB Card', 'product/Bluetooth USB Card4.jpg', 'Logitech', 'Solulogic', '', '2018-07-07', 5, 'active'),
(12, 4, 'USB Wifi Card', 'product/not_available.png', 'TP Link', 'Solulogic', '', '2018-07-07', 0, 'inactive'),
(13, 5, 'Bluetooth USB adapter', 'product/not_available.png', 'Logitech', 'Solulogic', '', '2018-07-07', 5, 'active'),
(14, 5, 'RJ45 Connectors ', 'product/not_available.png', 'Steren', 'Solulogic', NULL, '2018-07-07', 400, 'active'),
(18, 4, 'Cable HDMI', 'product/not_available.png', 'Steren', 'Solulogic', NULL, '2018-07-10', 1, 'active'),
(19, 3, 'cable hdmi', 'product/hdmi.jpg', 'steren', 'IT Cancun', '', '2018-07-10', 1, 'active'),
(20, 3, 'Blackout', 'product/Blackout3.jpg', 'Scorpions', 'Sony Music', '', '2018-07-13', 1, 'active'),
(21, 3, 'testing by backed', 'product/not_available.png', 'backend', 'backend', 'backendserial', '2018-07-18', 5, 'active'),
(22, 4, 'Speakers  alambric', 'product/not_available.png', 'Steren', 'Solulogic', NULL, '2018-07-19', 1, 'active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rentas`
--

CREATE TABLE `rentas` (
  `rent_id` int(11) NOT NULL,
  `users_user_id` int(11) NOT NULL,
  `hoteles_hotel_id` int(11) NOT NULL,
  `productos_product_id` int(11) NOT NULL,
  `rent_date` date NOT NULL,
  `rent_quantity` int(20) NOT NULL,
  `rent_employee_number` int(11) NOT NULL,
  `rent_employee_name` varchar(50) NOT NULL,
  `rent_delivery_date` date DEFAULT NULL,
  `rent_status` enum('in rent','delivered') NOT NULL,
  `rent_commentary` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `rentas`
--

INSERT INTO `rentas` (`rent_id`, `users_user_id`, `hoteles_hotel_id`, `productos_product_id`, `rent_date`, `rent_quantity`, `rent_employee_number`, `rent_employee_name`, `rent_delivery_date`, `rent_status`, `rent_commentary`) VALUES
(5, 2, 1, 1, '2018-06-15', 3, 1, 'Fernando', NULL, 'in rent', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `user_made_id` int(11) NOT NULL,
  `hotel_made_id` int(11) NOT NULL,
  `user_acept_id` int(11) DEFAULT NULL,
  `hotel_acept_id` int(11) DEFAULT NULL,
  `request_details` varchar(250) NOT NULL,
  `request_status` enum('Accepted','On hold','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `request`
--

INSERT INTO `request` (`request_id`, `user_made_id`, `hotel_made_id`, `user_acept_id`, `hotel_acept_id`, `request_details`, `request_status`) VALUES
(12, 9, 5, 6, 4, 'test', 'Accepted'),
(13, 6, 3, 6, 4, 'testing again', 'Accepted'),
(14, 6, 3, NULL, NULL, 'testing 2', 'On hold'),
(15, 6, 3, 8, 5, 'i need a many JR45 plugs', 'Accepted'),
(16, 8, 5, NULL, NULL, 'necesito 3 cables hdmi de 2 m de largo minimo', 'On hold'),
(17, 6, 3, 6, 4, 'test', 'Accepted');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transferencias`
--

CREATE TABLE `transferencias` (
  `transferencia_id` int(11) NOT NULL,
  `usuarios_usuario_id` int(11) NOT NULL,
  `hoteles_hotel_id` int(11) NOT NULL,
  `transferencia_destino_id` int(11) NOT NULL,
  `usuarios_usuario_recibe` int(11) DEFAULT NULL,
  `transferencia_status` enum('delivered','to deliver') NOT NULL,
  `transferencia_comentario_origen` text,
  `transferencia_comentario_destino` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `transferencias`
--

INSERT INTO `transferencias` (`transferencia_id`, `usuarios_usuario_id`, `hoteles_hotel_id`, `transferencia_destino_id`, `usuarios_usuario_recibe`, `transferencia_status`, `transferencia_comentario_origen`, `transferencia_comentario_destino`) VALUES
(19, 5, 2, 3, 6, 'delivered', 'testing in back', 'transfer received correctly'),
(20, 5, 2, 4, 6, 'delivered', 'testeo de backend', 'test'),
(22, 6, 3, 5, 8, 'delivered', 'testing', 'the products arrived correctly'),
(23, 6, 3, 5, NULL, 'to deliver', 'comment', NULL),
(24, 6, 3, 4, 6, 'delivered', 'test', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transferencia_items`
--

CREATE TABLE `transferencia_items` (
  `id` int(11) NOT NULL,
  `transferencias_transferencia_id` int(11) NOT NULL,
  `productos_producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `item_status` enum('1','0') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `transferencia_items`
--

INSERT INTO `transferencia_items` (`id`, `transferencias_transferencia_id`, `productos_producto_id`, `cantidad`, `item_status`) VALUES
(4, 19, 4, 1, '1'),
(5, 20, 4, 1, '0'),
(7, 22, 7, 5, '0'),
(8, 22, 8, 8, '0'),
(9, 22, 9, 5, '0'),
(10, 22, 19, 7, '0'),
(11, 22, 20, 5, '0'),
(12, 23, 7, 1, '0'),
(13, 24, 7, 1, '1'),
(14, 24, 9, 1, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `colaborator_no` int(20) NOT NULL,
  `hoteles_hotel_id` int(11) NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `user_type` enum('admin','common') COLLATE utf8_unicode_ci NOT NULL,
  `user_image` varchar(250) COLLATE utf8_unicode_ci DEFAULT 'user/user.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `first_name`, `last_name`, `colaborator_no`, `hoteles_hotel_id`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `user_type`, `user_image`) VALUES
(2, 'admin', 'Fernando', 'Moreno', 1, 1, 'qgXDr_9BLxFr2PbIlMQhICX9S3uXOlZZ', '$2y$13$hi2nqhJbJtlh1AZnjxZLIu4zsnEouiekt15PRoCZxMiw3DmEpRzaS', NULL, 'fernandomoreno605@gmail.com', 10, 0, 0, 'admin', 'user/user.png'),
(4, 'user1', 'fernando', 'moreno', 2, 1, 'Y2SbUUnMPOqH9JFQyOQafcZUhmWVVtgT', '$2y$13$Q6.tyl4VEReFvrbFtHw2.eEkrOWHJpQVHaBJAvcevh3W3FtoNGZj.', NULL, 'mail@mail.com', 10, 1527959393, 1527959393, 'common', 'user/user.png'),
(5, 'user2', 'Jose', 'Perez', 3, 2, 'Gx2Fi5YgGT67q_kxS6gvGqXZo5euKzKg', '$2y$13$cXRnP4J1yP3Pck4dEGPZYug4KwejNlXgjV01pB.TH1enu3QRWDwya', NULL, 'usuario2@mail.com', 10, 1528127156, 1528127156, 'common', 'user/user.png'),
(6, 'user3', 'Alejandro', 'Figueroa', 5, 3, 'BbXAmoHCL9K6uX3Z6kCl_WX96qP0rgui', '$2y$13$9q0EDHNPBCMxAW8VcAwFquX.4Wia8TXvfJUyrM4X/Zscx3M.fH6GS', '', 'user3@mail.com', 10, 0, 0, 'common', 'user/fernandomoreno605.jpg'),
(7, 'user4', 'Francisco', 'Perez', 5, 4, 'tvNcJnRTYxxInOQ7YqfJg3CiIldwCL7p', '$2y$13$cZZuyX3yqJ1aML3YAM0.f.0KXXXKTC2w/V8SjLqdfMO7lhaWLbR7u', NULL, 'user4@mail.com', 10, 0, 0, 'common', 'user/user.png'),
(8, 'user5', 'Manuel', 'Gutierrez', 5, 5, 'FTlYNCoF2De87C4uV1ENl6zQbyTwO31Z', '$2y$13$hstWDD/FowqtjdB/SmAbFOYQNsl1xdyZyhbJdSgF1VJB8bZDGLm0S', NULL, 'user5@mail.com', 10, 0, 0, 'common', 'user/user.png'),
(9, 'user6', 'fernando', 'backend', 1, 5, 'k17_htC7bN6lKBU1tYb_d7MF_-WJCUY6', '$2y$13$OsY0v6PX8SSP3m3lRMfh6ebZb9ZjSNygLQJ6EpgqJ63QIv5v8eoVi', NULL, 'user6@mail.com', 10, 0, 0, 'common', 'user/user.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auth_hotel`
--
ALTER TABLE `auth_hotel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_user_id` (`users_user_id`),
  ADD KEY `hoteles_hotel_id` (`hoteles_hotel_id`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `hoteles_hotel_id` (`hoteles_hotel_id`);

--
-- Indices de la tabla `hoteles`
--
ALTER TABLE `hoteles`
  ADD PRIMARY KEY (`hotel_id`);

--
-- Indices de la tabla `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `po`
--
ALTER TABLE `po`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `po_item`
--
ALTER TABLE `po_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `po_id` (`po_id`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`prestamo_id`),
  ADD KEY `hoteles_hotel_id` (`hoteles_hotel_id`),
  ADD KEY `users_user_id` (`users_user_id`);

--
-- Indices de la tabla `prestamo_articulos`
--
ALTER TABLE `prestamo_articulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prestamos_prestamo_id` (`prestamos_prestamo_id`),
  ADD KEY `productos_product_id` (`productos_product_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `productos_ibfk_1` (`hoteles_hotel_id`);

--
-- Indices de la tabla `rentas`
--
ALTER TABLE `rentas`
  ADD PRIMARY KEY (`rent_id`),
  ADD KEY `id_hotel_rent` (`hoteles_hotel_id`),
  ADD KEY `id_product_rent` (`productos_product_id`),
  ADD KEY `users_user_id` (`users_user_id`);

--
-- Indices de la tabla `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_made_id` (`user_made_id`),
  ADD KEY `hotel_made_id` (`hotel_made_id`),
  ADD KEY `user_acept_id` (`user_acept_id`),
  ADD KEY `hotel_acept_id` (`hotel_acept_id`);

--
-- Indices de la tabla `transferencias`
--
ALTER TABLE `transferencias`
  ADD PRIMARY KEY (`transferencia_id`),
  ADD KEY `realiza` (`usuarios_usuario_id`),
  ADD KEY `desde` (`hoteles_hotel_id`),
  ADD KEY `hacia` (`transferencia_destino_id`),
  ADD KEY `quien recibe` (`usuarios_usuario_recibe`);

--
-- Indices de la tabla `transferencia_items`
--
ALTER TABLE `transferencia_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transferencias_transferencia_id` (`transferencias_transferencia_id`),
  ADD KEY `productos_producto_id` (`productos_producto_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD KEY `id_hotel_user` (`hoteles_hotel_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auth_hotel`
--
ALTER TABLE `auth_hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `hoteles`
--
ALTER TABLE `hoteles`
  MODIFY `hotel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `po`
--
ALTER TABLE `po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `po_item`
--
ALTER TABLE `po_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `prestamo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `prestamo_articulos`
--
ALTER TABLE `prestamo_articulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `rentas`
--
ALTER TABLE `rentas`
  MODIFY `rent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `transferencias`
--
ALTER TABLE `transferencias`
  MODIFY `transferencia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `transferencia_items`
--
ALTER TABLE `transferencia_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auth_hotel`
--
ALTER TABLE `auth_hotel`
  ADD CONSTRAINT `auth_hotel_ibfk_1` FOREIGN KEY (`users_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_hotel_ibfk_2` FOREIGN KEY (`hoteles_hotel_id`) REFERENCES `hoteles` (`hotel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`hoteles_hotel_id`) REFERENCES `hoteles` (`hotel_id`);

--
-- Filtros para la tabla `po_item`
--
ALTER TABLE `po_item`
  ADD CONSTRAINT `po_item_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `po` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`hoteles_hotel_id`) REFERENCES `hoteles` (`hotel_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`users_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamo_articulos`
--
ALTER TABLE `prestamo_articulos`
  ADD CONSTRAINT `prestamo_articulos_ibfk_1` FOREIGN KEY (`prestamos_prestamo_id`) REFERENCES `prestamos` (`prestamo_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamo_articulos_ibfk_2` FOREIGN KEY (`productos_product_id`) REFERENCES `productos` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`hoteles_hotel_id`) REFERENCES `hoteles` (`hotel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rentas`
--
ALTER TABLE `rentas`
  ADD CONSTRAINT `rentas_ibfk_1` FOREIGN KEY (`users_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rentas_ibfk_2` FOREIGN KEY (`hoteles_hotel_id`) REFERENCES `hoteles` (`hotel_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rentas_ibfk_3` FOREIGN KEY (`productos_product_id`) REFERENCES `productos` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`user_made_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`hotel_made_id`) REFERENCES `hoteles` (`hotel_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_3` FOREIGN KEY (`user_acept_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_4` FOREIGN KEY (`hotel_acept_id`) REFERENCES `hoteles` (`hotel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `transferencias`
--
ALTER TABLE `transferencias`
  ADD CONSTRAINT `desde` FOREIGN KEY (`hoteles_hotel_id`) REFERENCES `hoteles` (`hotel_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hacia` FOREIGN KEY (`transferencia_destino_id`) REFERENCES `hoteles` (`hotel_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quien recibe` FOREIGN KEY (`usuarios_usuario_recibe`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `realiza` FOREIGN KEY (`usuarios_usuario_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `transferencia_items`
--
ALTER TABLE `transferencia_items`
  ADD CONSTRAINT `transferencia_items_ibfk_1` FOREIGN KEY (`transferencias_transferencia_id`) REFERENCES `transferencias` (`transferencia_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transferencia_items_ibfk_2` FOREIGN KEY (`productos_producto_id`) REFERENCES `productos` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`hoteles_hotel_id`) REFERENCES `hoteles` (`hotel_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
