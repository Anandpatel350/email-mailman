-- Adminer 4.8.1 MySQL 8.0.29-0ubuntu0.20.04.3 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `mailman` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `mailman`;

DROP TABLE IF EXISTS `userdata`;
CREATE TABLE `userdata` (
  `id` int NOT NULL AUTO_INCREMENT,
  `from_email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `to_email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cc_email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bcc_email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` varchar(2000) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `time` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `sendstatus` int NOT NULL,
  `recievestatus` int NOT NULL,
  `draftstatus` int NOT NULL,
  `trashstatus` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `userdata` (`id`, `from_email`, `to_email`, `cc_email`, `bcc_email`, `subject`, `message`, `attachment`, `time`, `sendstatus`, `recievestatus`, `draftstatus`, `trashstatus`) VALUES
(1,	'anandpatel@mailman.com',	'rovis@mailman.com',	'vefar@mailman.com',	'xyvopiqyh@mailman.com',	'Fist mail',	'hello ',	'phone (copy).png',	'2022-07-12 13:21:35',	0,	0,	1,	0),
(2,	'anandpatel@mailman.com',	'xyvopiqyh@mailman.com',	'vefar@mailman.com',	'rovis@mailman.com',	'Second_mail',	'hello ',	'youtube.jpg',	'2022-07-12 13:21:35',	0,	0,	0,	0),
(3,	'rovis@mailman.com',	'anandpatel@mailman.com',	'vefar@mailman.com',	'xyvopiqyh@mailman.com',	'Third_mail',	'hello ',	'favicon-meetj.png',	'2022-07-12 13:21:35',	0,	0,	0,	0),
(4,	'anandpatel@mailman.com',	'rovis@mailman.com',	'xyvopiqyh@mailman.com',	'vefar@mailman.com',	'subject1',	' hello',	'',	'2022-07-12 13:21:35',	0,	0,	0,	0),
(5,	'anandpatel@mailman.com',	'rovis@mailman.com',	'xyvopiqyh@mailman.com',	'vefar@mailman.com',	'hesta mail',	'hello',	'',	'2022-07-12 13:21:35',	0,	0,	0,	0),
(6,	'anandpatel@mailman.com',	'xoqoz@mailman.com',	'xyvopiqyh@mailman.com',	'vefar@mailman.com',	'subject2',	' helo',	'',	'2022-07-12 13:21:35',	0,	0,	0,	0),
(7,	'anandpatel@mailman.com',	'wodi@mailman.com',	'rovis@mailman.com',	'vefar@mailman.com',	'subject3',	' hello',	'',	'2022-07-12 13:21:35',	0,	0,	0,	0),
(8,	'anandpatel@mailman.com',	'rovis@mailman.com',	'wodi@mailman.com',	'guduvav@mailman.com',	'subject4',	' ',	'',	'2022-07-12 14:16:14',	0,	0,	0,	1),
(9,	'anandpatel@mailman.com',	'rovis@mailman.com',	'wodi@mailman.com',	'vefar@mailman.com',	'subject5',	' hello',	'',	'2022-07-12 13:21:54',	0,	0,	0,	1),
(10,	'rovis@mailman.com',	'anandpatel@mailman.com',	'vefar@mailman.com',	'xoqoz@mailiman.com',	'on call',	'Hi my name is herry',	NULL,	'2022-07-12 13:22:05',	0,	0,	0,	1),
(11,	'anandpatel@mailman.com',	'pyquliq@mailinator.com',	'meracyb@mailinator.com',	'dygadaduju@mailinator.com',	'Amet distinctio Op',	'Earum sapiente maxim ',	'',	'2022-07-12 13:21:35',	0,	0,	1,	0),
(12,	'anandpatel@mailman.com',	'qomugywyw@mailinator.com',	'joqu@mailinator.com',	'vavaq@mailinator.com',	'Perferendis maiores ',	'Voluptas temporibus  ',	'',	'2022-07-12 13:21:35',	0,	0,	1,	0),
(13,	'anandpatel@mailman.com',	'abhishek',	'gixyhap@mailinator.com',	'tavat@mailinator.com',	'Natus enim corporis ',	'Consectetur vitae iu ',	'',	'2022-07-12 13:21:35',	0,	0,	1,	0),
(14,	'anandpatel@mailman.com',	'manish panday',	'rysijamisi@mailinator.com',	'kigefaxy@mailinator.com',	'Non laborum Obcaeca',	'Magni doloribus non  ',	'',	'2022-07-12 13:21:35',	0,	0,	1,	0),
(15,	'anandpatel@mailman.com',	'hosyz@mailinator.com',	'cumutumi@mailinator.com',	'zawabucak@mailinator.com',	'Harum porro omnis ea',	'Dignissimos dolores  ',	'',	'2022-07-12 13:21:35',	0,	0,	1,	0),
(16,	'anandpatel@mailman.com',	'',	'',	'',	'',	' ',	'',	'2012-07-22 02:15:37',	0,	0,	1,	0);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `First_name` varchar(15) NOT NULL,
  `Last_name` varchar(15) NOT NULL,
  `User_name` varchar(15) NOT NULL,
  `Picture` varchar(255) DEFAULT NULL,
  `Email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Secordary_mail` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Password` varchar(15) NOT NULL,
  `Confirmpassword` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `reset_link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`Id`, `First_name`, `Last_name`, `User_name`, `Picture`, `Email`, `Secordary_mail`, `Password`, `Confirmpassword`, `reset_link`) VALUES
(1,	'Anand',	'patel',	'mutant0',	'IMG_20220614_110008060_HDR~2.jpg',	'anandpatel@mailman.com',	'anandpatel350@gmail.com',	'Anand!!!123',	'Anand!!!123',	'1657543640'),
(2,	'lucifer',	'devil',	'mutant1',	'youtube.jpg',	'rovis@mailman.com',	'anandpatel@mailman.com',	'Pa$$w0rd!',	'Pa$$w0rd!',	NULL),
(3,	'Alexander',	'Wood',	'mutant2',	'bible.jpg',	'xyvopiqyh@mailman.com',	'rovis@mailman.com',	'Pa$$w0rd!',	'Pa$$w0rd!',	NULL),
(4,	'Nina',	'Jackson',	'mutant3',	'jesus.jpg',	'vefar@mailman.com',	'anandpatel@mailman.com',	'Anand@123',	'Anand@123',	NULL),
(5,	'Chandler',	'Woods',	'xecif',	'',	'peqiw@mailman.com',	'qovos@mailinator.com',	'Pa$$w0rd!',	'Pa$$w0rd!',	NULL),
(6,	'Carissa',	'Stuart',	'cikudew',	'',	'pamixipah@mailman.com',	'zohiwo@mailinator.com',	'Pa$$w0rd!',	'Pa$$w0rd!',	NULL),
(7,	'Gregory',	'Cardenas',	'rekyxisyv',	'',	'wivaz@mailman.com',	'hakazany@mailinator.com',	'Pa$$w0rd!',	'Pa$$w0rd!',	NULL);

-- 2022-07-12 16:16:45
