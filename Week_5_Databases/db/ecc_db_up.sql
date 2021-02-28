CREATE DATABASE IF NOT EXISTS ecc_demo;

use ecc_demo;

CREATE TABLE IF NOT EXISTS `Groups` (
 `id` int NOT NULL AUTO_INCREMENT,
 `groupNumber` int NOT NULL,
 `repositoryURL` varchar(100) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `groupNumber` (`groupNumber`)
);

CREATE TABLE IF NOT EXISTS `Students` (
 `id` int NOT NULL AUTO_INCREMENT,
 `firstName` varchar(30) NOT NULL,
 `lastName` varchar(30) NOT NULL,
 `email` varchar(30) NOT NULL,
 `repositoryURL` varchar(100) NOT NULL,
 `groupID` int NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `email` (`email`)
);