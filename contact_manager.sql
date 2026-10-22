-- Création de la base de données et de la table contacts

CREATE DATABASE IF NOT EXISTS `contact_manager`
  DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `contact_manager`;

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `contacts` (`id`, `name`, `email`, `phone_number`) VALUES
(1, 'Gandalf the Grey', 'gandalf@istari.com', '01013021'),
(2, 'Buffy Summers', 'buffy@sunnydale.com', '01091901'),
(3, 'Hermione Granger', 'hermione@hogwarts.com', '19091979');
