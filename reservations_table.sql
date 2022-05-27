-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-05-27 18:23:07
-- サーバのバージョン： 10.4.24-MariaDB
-- PHP のバージョン: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gsacf_d11_10`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `reservations_table`
--

CREATE TABLE `reservations_table` (
  `reservation_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `user_name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `mail` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `people` int(11) NOT NULL,
  `room_type` varchar(128) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `reservations_table`
--

INSERT INTO `reservations_table` (`reservation_id`, `created_at`, `user_name`, `mail`, `check_in`, `check_out`, `people`, `room_type`) VALUES
(1, '2022-05-27 23:24:58', 'Aさん', 'a@gmail.com', '2022-05-27', '2022-05-28', 1, 'スタンダードダブルルーム'),
(2, '2022-05-27 23:28:31', 'Aさん', 'a@gmail.com', '2022-06-08', '2022-06-10', 1, 'スーペリアダブルルーム'),
(3, '2022-05-27 23:29:32', 'Bさん', 'b@gmail.com', '2022-05-29', '2022-05-30', 4, 'スタンダードスタジオ'),
(4, '2022-05-27 23:30:02', 'Bさん', 'b@gmail.com', '2022-06-11', '2022-06-12', 6, 'デラックススタジオ'),
(5, '2022-05-27 23:30:27', 'Bさん', 'b@gmail.com', '2022-07-16', '2022-07-17', 3, 'スーペリアスタジオ'),
(6, '2022-05-27 23:30:51', 'cさん', 'c@gmail.com', '2022-06-02', '2022-06-03', 1, 'ラージダブルルーム'),
(7, '2022-05-27 23:31:17', 'Dさん', 'd@gmail.com', '2022-06-06', '2022-06-07', 6, 'デラックススタジオ'),
(8, '2022-05-27 23:31:52', 'Eさん', 'e@gmail.com', '2022-06-09', '2022-06-11', 4, 'スーペリアスタジオ'),
(9, '2022-05-27 23:32:36', 'cさん', 'c@gmail.com', '2022-08-13', '2022-08-14', 1, 'スーペリアダブルルーム'),
(10, '2022-05-27 23:33:02', 'cさん', 'c@gmail.com', '2022-09-03', '2022-09-05', 1, 'デラックススタジオ'),
(11, '2022-05-28 00:43:28', 'Bさん', 'b@gmail.com', '2022-07-01', '2022-07-02', 1, 'スタンダードダブルルーム');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `reservations_table`
--
ALTER TABLE `reservations_table`
  ADD PRIMARY KEY (`reservation_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `reservations_table`
--
ALTER TABLE `reservations_table`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
