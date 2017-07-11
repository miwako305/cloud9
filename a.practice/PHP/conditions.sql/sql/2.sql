-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- ホスト: 127.0.0.1
-- 生成日時: 2017 年 6 月 29 日 06:35
-- サーバのバージョン: 5.5.54-0ubuntu0.14.04.1
-- PHP のバージョン: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `db1`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- テーブルのデータのダンプ `products`
--

INSERT INTO `products` (`id`, `name`, `price`) VALUES
(1, 'マウスパッド', 1200),
(2, 'マウスウォッシュ', 900),
(3, 'トラックパッド', 500),
(4, 'ラバーマウスパッド2', 1400);
