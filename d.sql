-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2017 at 07:28 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


 

CREATE TABLE `crud_application` (
  `title` varchar(50) NOT NULL,
  `author` varchar(100) NOT NULL,
  `available` varchar(5) NOT NULL,
  `pages` varchar(5) NOT NULL,
  `isbn` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

 
 
