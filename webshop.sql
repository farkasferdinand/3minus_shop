-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Feb 05. 21:37
-- Kiszolgáló verziója: 10.4.27-MariaDB
-- PHP verzió: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `webshop`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `zipcode` varchar(4) NOT NULL,
  `city` varchar(40) NOT NULL,
  `address` varchar(100) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `comment` varchar(300) NOT NULL,
  `order_date` date NOT NULL,
  `ordered_products` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `orders`
--

INSERT INTO `orders` (`order_id`, `name`, `email`, `zipcode`, `city`, `address`, `telephone`, `comment`, `order_date`, `ordered_products`) VALUES
(1, 'Kolompár Ödön', '', '2941', 'Miskolc', 'Mocskos Ferenc utca 200.', '+3670123456', 'xd', '2024-01-12', '1,2,1,1,2'),
(2, '', '', '', '', '', '', '', '0000-00-00', ''),
(3, '', '', '', '', '', '', '', '0000-00-00', ''),
(4, '', '', '', '', '', '', '', '0000-00-00', ''),
(5, '', '', '', '', '', '', '', '0000-00-00', ''),
(6, '', '', '', '', '', '', '', '0000-00-00', ''),
(7, '', '', '2941', '', '', '', '', '0000-00-00', ''),
(8, '', '', '', '', '', '', '', '0000-00-00', ''),
(9, '', '', '', '', '', '', '', '0000-00-00', ''),
(10, 'aaa', '', '1231', '', '', '', '', '0000-00-00', ''),
(11, 'aaa', '', '1231', '', '', '', '', '0000-00-00', ''),
(12, 'Ablakgyártó László', '', '1231', '', '', '', '', '0000-00-00', ''),
(13, 'Ablakgyártó László', '', '1231', '', '', '', '', '0000-00-00', ''),
(14, 'Ablakgyártó László', '', '1231', '', '', '', '', '0000-00-00', ''),
(15, 'Ablakgyártó László', '', '1231', '', '', '', '', '0000-00-00', ''),
(16, 'Ablakgyártó László', '', '1231', '', '', '', '', '0000-00-00', ''),
(17, 'Ablakgyártó László', '', '1231', '', '', '', '', '0000-00-00', ''),
(18, 'Ablakgyártó László', '', '1231', '', '', '', '', '0000-00-00', ''),
(19, 'Ablakgyártó László', '', '1231', '', '', '', '', '0000-00-00', ''),
(20, '', '', '1231', '', '', '', '', '0000-00-00', ''),
(21, 'hhhh', '', '1231', '', '', '', 'hhhh', '0000-00-00', ''),
(22, '1231', '', '1231', '', '', '', '1231', '0000-00-00', ''),
(23, 'aaa@aaa.aa', '', '1231', '', '', '', 'aaa@aaa.aa', '0000-00-00', ''),
(24, 'hhhh', 'aaa@aaa.aa', '1231', '', '', '', 'aaa@aaa.aa', '0000-00-00', ''),
(25, 'hhhh', 'aaa@aaa.aa', '1231', '', '', '', '', '0000-00-00', ''),
(26, 'hhhh', 'aaa@aaa.aa', '1231', '', '', '', '', '0000-00-00', ''),
(27, 'hhhh', 'aaa@aaa.aa', '1231', '', '', '', '', '0000-00-00', ''),
(28, 'Gyurbán Viktor Ferenc', 'aaa@aaa.aa', '1231', '', '', '', '', '0000-00-00', ''),
(29, 'Gyurbán Viktor Ferenc', 'aaa@aaa.aa', '1231', '', '', '', '', '0000-00-00', ''),
(30, 'Gyurbán Viktor Ferenc', 'aaa@valammi.ga', '8000', '', '', '', '', '0000-00-00', ''),
(31, 'Gyurbán Viktor Ferenc', 'aaa@valammi.ga', '8000', '', '', '', '', '0000-00-00', ''),
(32, 'Gyurbán Viktor Ferenc', 'aaa@valammi.ga', '8000', '', '', '', '', '0000-00-00', ''),
(33, 'Gyurbán Viktor Ferenc', 'aaa@valammi.ga', '8000', '', '', '', '', '0000-00-00', ''),
(34, '', '', '', '', '', '', '', '0000-00-00', ''),
(35, '', '', '', '', '', '', '', '0000-00-00', ''),
(36, 'Gyurbán Viktor Ferenc', 'aaa@valammi.ga', '8000', '', '', '', '', '0000-00-00', ''),
(37, 'Gyurbán Viktor Ferenc', 'aaa@valammi.ga', '8000', '', '', '', '', '0000-00-00', ''),
(38, 'Gyurbán Viktor Ferenc', 'aaa@valammi.ga', '8000', '', '', '', '', '0000-00-00', ''),
(39, 'nemtom', 'nem@tom.aa', '5666', 'ggg', 'ggg', 'ggg', 'ggg', '2000-12-12', 'aaaa'),
(40, 'hh', 'hh@a.a', '12', 'ggg', 'ggg', 'gg', 'ggg', '2000-12-12', 'aaa'),
(44, 'Gyurbán Viktor Ferenc', 'asd@asd.asd', '1234', 'Miskolc', 'alma utca 12', '061234567', 'nope', '2024-01-13', 'aaaaa'),
(45, 'Füty Imre', 'imre.futy@freemail.hu', '8000', 'Apáczatorna', 'Matuska Szilveszter u. 32.', '+3630454545', '', '2024-01-13', '1,1,2,2,1'),
(46, 'aaaa', 'aaaa@aaa.aaa', '0123', 'aaa', 'asd ', 'asd', '', '2024-01-14', '2,2,1,3'),
(47, 'Tamás Ferdinánd Farkas', 'farkasferdike@gmail.com', '2941', 'Ács', 'Gárdonyi Géza u. 51', '06703617252', '', '2024-01-15', '1,2'),
(48, 'aaaa', 'aaa@aa.aa', '8000', 'Miskolc', 'váci ucca 4', '0123', '', '2024-01-19', '1,1,1,1,1,1,1,2,2'),
(49, 'aaaa', 'aaaa@aaa.aaa', '0123', 'aaa', 'asd ', 'asd', '', '2024-01-20', '3,3,3,2'),
(50, 'aaaa', 'aaaa@aaa.aaa', '0123', 'aaa', 'asd ', 'asd', '', '2024-01-20', '3,3,3,2'),
(51, 'aaaa', 'aaaa@aaa.aaa', '0123', 'aaa', 'asd ', 'asd', '', '2024-01-20', '1,1,1,2'),
(52, 'aaaa', 'aaaa@aaa.aaa', '0123', 'aaa', 'asd ', 'asd', '', '2024-01-20', '1,1,1,2'),
(53, 'Tamás Ferdinánd Farkas', 'farkasferdike@gmail.com', '2941', 'Ács', 'Gárdonyi Géza u. 51', '06703617252', '', '2024-01-20', '1,1,1'),
(54, 'aaaa', '3minus.perfumes@gmail.com', '8000', 'Miskolc', 'váci ucca 4', '0123', '', '2024-01-20', '1,1,1'),
(55, 'aaaa', '3minus.perfumes@gmail.com', '8000', 'Miskolc', 'váci ucca 4', '0123', '', '2024-01-20', '1,1,1'),
(56, '', '', '', '', '', '', '', '2024-01-28', '3,3,3,3,3,2'),
(57, '', 'farkasferdike@gmail.com', '1234', 'Miskolc', 'Alma ucca 13', '014565', 'nope', '2024-01-29', '3,3,3'),
(58, '', 'farkasferdike@gmail.com', '1234', 'aaa', 'aaa', '01234', '', '2024-01-29', '3,3,3,3'),
(59, 'aaa aaav', 'farkasferdike@gmail.com', '1234', 'aaa', 'váci ucca 4', '0123', '', '2024-01-29', '3,3,3,3'),
(60, 'Lakatos József', 'farkasferdike@gmail.com', '8000', 'new york', 'váci ucca 4', '01235656', '', '2024-01-29', '2,2,2,1'),
(61, ' ', '', '', '', '', '', '', '2024-01-29', '1'),
(62, 'aaa aaa', 'farkasferdike@gmail.com', '8000', 'Miskolc', 'váci ucca 4', '0123', '', '2024-01-29', '1'),
(63, 'Lakatos József', 'farkasferdike@gmail.com', '8000', 'Miskolc', 'váci ucca 4', '0123', '', '2024-01-29', '3,3'),
(64, 'Lakatos József', 'farkasferdike@gmail.com', '8000', 'Miskolc', 'váci ucca 4', '0123', '', '2024-01-29', '3,3'),
(65, 'Lakatos József', 'farkasferdike@gmail.com', '8000', 'Miskolc', 'váci ucca 4', '0123', '', '2024-01-29', '3,3'),
(66, 'Lakatos József', 'farkasferdike@gmail.com', '8000', 'Miskolc', 'váci ucca 4', '0123', '', '2024-01-29', '3,3'),
(67, 'Lakatos József', 'farkasferdike@gmail.com', '8000', 'Miskolc', 'alma utca 6', '0123', '', '2024-01-29', '3,3'),
(68, 'Lakatos József', 'farkasferdike@gmail.com', '8000', 'Miskolc', 'alma utca 6', '0123', '', '2024-01-29', '3,3'),
(69, 'Orbán Viktor', 'farkasferdike@gmail.com', '8000', 'Miskolc', 'gyurcsány ferenc ucca 12', '123123', '', '2024-02-05', '1,3,2,2'),
(70, 'Orbán Viktor', 'farkasferdike@gmail.com', '8000', 'Miskolc', 'gyurcsány ferenc ucca 12', '123123', '', '2024-02-05', '1,3,2,2'),
(71, 'Orbán Viktor', 'farkasferdike@gmail.com', '8000', 'Miskolc', 'gyurcsány ferenc ucca 12', '123123', '', '2024-02-05', '1,3,2,2'),
(72, 'obán viktor', 'farkasferdike@gmail.com', '8000', 'alcsút', 'gyurcsány ferec ucca 89', '123123124', 'milyen feri?xddd', '2024-02-05', '1,1,1,1,3,3,3,3,3,2,2,2');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `thumbnail` varchar(300) NOT NULL,
  `url` varchar(200) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `brand_friendly` varchar(50) NOT NULL,
  `strength` varchar(100) NOT NULL,
  `ptype` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `thumbnail`, `url`, `gender`, `brand`, `brand_friendly`, `strength`, `ptype`) VALUES
(1, 'Spiderman Eau de Toilette', 19900, 'img/product1.webp', '', 'male', 'Marvel', 'marvel', 'Eau de Toilette', 'parfum'),
(2, 'Frozen II Elsa by Disney, 3.4 oz Eau De Toilette', 24900, 'img/product2.jpg', '', 'female', 'Disney', 'disney', 'Eau de Toilette', 'parfum'),
(3, 'Minions Eau de Toilette', 1990, 'img/product3.webp', '', 'male', 'Air Val', 'air_val', 'Eau de Toilette', 'parfum'),
(4, 'nemtudom', 12, '', '', '', '', '', '', 'olaly');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- A tábla indexei `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
