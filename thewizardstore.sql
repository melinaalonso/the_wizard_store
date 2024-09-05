-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 03-07-2024 a las 00:23:27
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `thewizardstore`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  `estado_compra` enum('Activo','Anulado','Finalizado') NOT NULL,
  `fecha_compra` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `fk_usuario`, `estado_compra`, `fecha_compra`) VALUES
(1, 14, 'Anulado', '2024-07-01'),
(2, 14, 'Anulado', '2024-07-01'),
(3, 14, 'Finalizado', '2024-07-01'),
(4, 14, 'Finalizado', '2024-07-01'),
(5, 14, 'Activo', '2024-07-01'),
(6, 15, 'Finalizado', '2024-07-02'),
(7, 15, 'Activo', '2024-07-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_detalle`
--

CREATE TABLE `carrito_detalle` (
  `id` int(11) NOT NULL,
  `fkcarrito_id` int(11) NOT NULL,
  `fkproducto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrito_detalle`
--

INSERT INTO `carrito_detalle` (`id`, `fkcarrito_id`, `fkproducto_id`, `cantidad`) VALUES
(7, 1, 11, 1),
(8, 2, 11, 1),
(9, 2, 12, 1),
(17, 7, 10, 2),
(18, 7, 11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombreCategoria` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombreCategoria`) VALUES
(1, 'Gryffindor'),
(2, 'Slytherin'),
(3, 'Ravenclaw'),
(4, 'Hufflepuff'),
(5, 'Hogwarts');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `detalle` varchar(120) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` int(11) NOT NULL,
  `fk_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `imagen`, `nombre`, `detalle`, `descripcion`, `precio`, `fk_categoria`) VALUES
(10, 'img/Buzo-Gryffindor.png', 'Buzo Gryffindor', 'Buzo de algodón frizado', 'Celebre su orgullo por la casa de Hogwarts con esta túnica réplica de Gryffindor, como se ve en la serie de películas de Harry Potter. La túnica de Gryffindor personalizada presenta un forro escarlata en contraste, bolsillos (¡incluso hay un bolsillo oculto para tu varita!) y un escudo de Gryffindor bordado.', 55000, 1),
(11, 'img/toga-slytherin.png', 'Toga Slytherin', 'Toga de algodon negro con detalles en dorado y verde', 'La bata Slytherin personalizada presenta un forro verde contrastante, bolsillos (¡incluso hay un bolsillo oculto para tu varita!) y el escudo de Slytherin bordado. Todas las batas incluyen personalización opcional y complementaria. Para seleccionar la personalización, ingrese su nombre de hasta 13 caracteres a continuación.', 70000, 2),
(12, 'img/1230226-1_large.png', 'Varita Tom Riddle', 'La varita de Tom Ryddle medía 34 cm y cuarto de largo y pertenecía a Tom Ryddle.', 'La varita estaba hecha de tejo, con un núcleo de pluma de fénix. Fue fabricada por Garrick Ollivander y era la \\\"hermana\\\" o \\\"gemela\\\" de la varita de Harry Potter ya que ambas compartían plumas de la misma ave. Esta varita fue el arma con el que Lord Voldemort asesinó a incontables personas, entre las cuales se incluyen James y Lily Potter, el Muggle Frank Bryce, la ex-empleada del Ministerio de Magia Bertha Jorkins y Amelia Bones. También, bajo las órdenes de Voldemort, Peter Pettigrew utilizó esta misma varita para matar a Cedric Diggory en 1995. Su forma se asemeja a la de un hueso.', 45000, 2),
(13, 'img/giratiempo.png', 'Giratiempo', 'Hermione Granger: «Se llama giratiempo. Me lo dio la profesora McGonagall el día que volvimos de vacaciones.', 'El giratiempo es un objeto mágico que permite retroceder en el tiempo. Tiene la apariencia de un reloj de arena pequeño y retrocede una hora por cada vuelta que le den. Es muy importante que el que usa un giratiempo evite el contacto con su ser pasado porque podrían atacarse, llegando incluso a quitarse la vida por la confusión, o peor aún, el usuario podría alterar (nunca se sabe si en forma leve o drástica) su propio futuro o el de las personas con quiénes haya interactuado, causando que el curso de su vida, la de los demás, o incluso el destino del mundo (o al menos el destino de una parte de él) vayan en una dirección completamente distinta a la que se conoce en una determinada línea de tiempo, siendo absolutamente imposible predecir no sólo cuál será esta nueva dirección, sino también hasta qué punto se producirá la desviación de la línea de tiempo original en dicha nueva dirección.', 20000, 1),
(14, 'img/medias.png', 'Medias Ravenclaw', 'Pack de tres medias.', 'Mantente abrigado y cómodo con estos calcetines Ravenclaw House de 3 calcetines hechos a medida. Cada par de calcetines presenta un diseño único en azul marino y gris, los colores icónicos y tradicionales de la casa Ravenclaw.', 15000, 3),
(15, 'img/huff-cap.png', 'Vicera Hufflepuff', 'Vicera de la casa regulable', 'Un prefecto en el Colegio Hogwarts de Magia y Hechicería es un estudiante a quien se le ha dado autoridad y responsabilidades extra por el Jefe de Casa y el Director. Un estudiante hombre y otra mujer son elegidos de cada casa en su quinto año para actuar como prefectos, y continuarán siendo prefectos en su sexto y séptimo año hasta que se gradúen.', 15000, 4),
(16, 'img/hermione.png', 'Varita Hermione Granger', 'Conseguí super-inteligencia usando la varita de Hermione', 'La varita de Hermione Granger, estaba hecha de vid, con núcleo de fibra de corazón de dragón y medía 103/4 pulgadas (27,3 cm). Se caracterizaba por ser flexible y buena para realizar hechizos.', 45000, 1),
(17, 'img/sudadera.png', 'Sudadera Hufflepuff', 'Añade un poco de magia a tu guardarropa con esta sudadera unisex de Hufflepuff.', 'La sudadera gris claro presenta un diseño negro y amarillo brillante de la palabra Hufflepuff en el centro del pecho. La sudadera se completa con un parche con el escudo de Hufflepuff aplicado en la manga izquierda. La sudadera, confeccionada con un material de algodón suave, tiene puños redondos en las muñecas y en la parte inferior, lo que proporciona un ajuste elegante y cómodo y es perfecta para que cualquier aspirante a bruja o mago la agregue a su guardarropa.', 20000, 4),
(18, 'img/sweater.png', 'Sweater de Hogwarts', 'Mostrar tu orgullo por escuela Hogwarts nunca ha sido tan divertido..', 'La manga larga Hogwarts Spirit Jersey cuenta con una School Crest estilizada en la transferencia de papel de aluminio en el pecho delantero, mientras que en la parte posterior, el nombre de la escuela está blasonado en el famoso puff-text de Spirit Jersey, tinta elevada en los hombros.Totalmente de moda, estas camisas de gran tamaño tienen un ajuste relajado a través del cuerpo perfecto para el uso diario.', 55000, 1),
(19, 'img/sweatergeorge.png', '\'G\' por George Weasley sweater', 'Inspirado en el jersey que Molly Weasley creó para sus hijos', 'El jersey ha sido confeccionado con un hilo de lana y seda especialmente elaborado en Escocia por el mismo telar donde se crearon muchas de las prendas de punto utilizadas para los disfraces de las películas originales.', 40000, 1),
(20, 'img/bufanda.png', 'Bufanda Ravenclaw', 'Mantenete caliente y completa tu look Ravenclaw con esta bufanda de punto única.', 'La bufanda viene en azul marino y gris, los colores tradicionales de la casa Ravenclaw. La bufanda Ravenclaw súper suave mide aproximadamente 66 pulgadas de largo y 7 pulgadas de ancho y es el complemento perfecto para cualquier bruja aspirante o colección de accesorios del mago. Nuestras bufandas de cresta de punto también están disponibles en colores Gryffindor, Slytherin, Hufflepuff y Hogwarts.', 25000, 3),
(21, 'img/jumper.png', 'Slytherin Quidditch Jumper', 'Anima a tu equipo favorito de Hogwarts house Quidditch con este sweater', 'Con un parche bordado Slytherin crest de la casa en el pecho izquierdo en los colores verde y plata de la casa, este suéter Quidditch es una celebración fiel de los que se ven en la serie de películas de Harry Potter. Este puente Slytherin Quidditch está hecho de material acrílico 100% súper suave y es lavable a máquina.\\n\\nDisponible a través de tamaños pequeños a extra grandes. También disponible en todos sus otros colores favoritos de la casa.', 45000, 2),
(22, 'img/tresmagos.png', 'Remera torneo de los tres magos', 'Muestre su lealtad y celebre el orgullo de su casa con esta camisa de los tres magos de Hufflepuff hecha a medida.', 'La camisa de manga larga está disponible en el color tradicional de la casa, el amarillo, combinado con rayas negras. El icónico escudo de Hogwarts está bordado en el lado izquierdo de la camisa, que se compone de los simbólicos animales de la casa de Hogwarts; un león para Gryffindor, una serpiente para Slytherin, un tejón para Hufflepuff y un águila para Ravenclaw. Cada camiseta Triwizard incluye personalización gratuita', 35000, 5),
(23, 'img/gorra.png', 'Gorra Hufflepuff', 'Manténgase abrigado y cómodo en los viajes entre Hogwarts y Hogsmeade con este gorro tejido de Hufflepuff.', 'El sombrero presenta los colores tradicionales de Hufflepuff, amarillo brillante y negro, y ha sido diseñado con el escudo de la casa Hufflepuff bordado en el centro del sombrero, que muestra un tejón, el animal icónico de Hufflepuff.', 15000, 4),
(24, 'img/ravenclawremera.png', 'Remera capitan de Quidditch Ravenclaw', 'Únete al equipo de Ravenclaw Quidditch con esta camiseta de capitán del equipo Ravenclaw Quidditch para niños.', 'La camiseta es de color azul, el color tradicional de la casa Ravenclaw, y presenta un diseño con estampado flocado en relieve en el pecho en gris del animal de la casa Ravenclaw, un águila.', 35000, 3),
(25, 'img/bufanda-slytherin.png', 'Bufanda Slytherin', 'Bufanda personalizada de Slytherin', 'Mantente abrigado en el frío y completa tu atuendo de la Casa con esta mágica bufanda tejida de Slytherin que presenta los colores tradicionales de la Casa Slytherin en verde esmeralda y gris plateado. Esta bufanda está encantada con el liderazgo y la ambición del corazón de la Casa Slytherin y es el accesorio perfecto. para añadir a tu look diario. La bufanda mide 66 pulgadas de largo y 7 pulgadas de ancho.', 35000, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`) VALUES
(14, 'nikito', 'nikito@hola.com', '$2y$10$GZB3ATe9or7oW6C4kRiHZOHH.JY3xl7d6pVgKytHu6lrzFaF5sGRq'),
(15, 'Melina', 'meli@meli.com', '$2y$10$noVxaYb13JNLv9EzRBbpLeuPpkmMZo7qmh5kHmzfUReRGMpuU89sm');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuarios` (`fk_usuario`);

--
-- Indices de la tabla `carrito_detalle`
--
ALTER TABLE `carrito_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkcarrito_id` (`fkcarrito_id`),
  ADD KEY `fkproducto_id` (`fkproducto_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productos_categorias` (`fk_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `carrito_detalle`
--
ALTER TABLE `carrito_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `fk_usuarios` FOREIGN KEY (`fk_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `carrito_detalle`
--
ALTER TABLE `carrito_detalle`
  ADD CONSTRAINT `carrito_detalle_ibfk_1` FOREIGN KEY (`fkcarrito_id`) REFERENCES `carrito` (`id`),
  ADD CONSTRAINT `carrito_detalle_ibfk_2` FOREIGN KEY (`fkproducto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_categorias` FOREIGN KEY (`fk_categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
