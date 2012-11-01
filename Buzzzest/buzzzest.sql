/*
SQLyog Enterprise - MySQL GUI v7.02 
MySQL - 5.1.30-community : Database - buzzzest
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`buzzzest` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `buzzzest`;

/*Table structure for table `answers` */

DROP TABLE IF EXISTS `answers`;

CREATE TABLE `answers` (
  `ANSID` int(11) NOT NULL AUTO_INCREMENT,
  `QID` int(11) DEFAULT NULL,
  `UID` int(11) DEFAULT NULL,
  `ANSWER` text,
  `ADATE` date DEFAULT NULL,
  `ATIME` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ASTATUS` int(11) DEFAULT NULL,
  PRIMARY KEY (`ANSID`),
  KEY `QID` (`QID`),
  KEY `UID` (`UID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `answers` */

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `CMTID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) DEFAULT NULL,
  `CDATE` date DEFAULT NULL,
  `CTIME` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CSTATUS` int(11) DEFAULT NULL,
  `CTEXT` text,
  PRIMARY KEY (`CMTID`),
  KEY `UID` (`UID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `comments` */

/*Table structure for table `friends` */

DROP TABLE IF EXISTS `friends`;

CREATE TABLE `friends` (
  `FRNID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) DEFAULT NULL,
  `FSTATUS` int(11) DEFAULT NULL,
  `FDATE` date DEFAULT NULL,
  `FTIME` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`FRNID`),
  KEY `UID` (`UID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `friends` */

/*Table structure for table `post` */

DROP TABLE IF EXISTS `post`;

CREATE TABLE `post` (
  `POSTID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) DEFAULT NULL,
  `POST` text,
  `POSTDATE` date DEFAULT NULL,
  `POSTTIME` timestamp NULL DEFAULT NULL,
  `PSTATUS` int(11) DEFAULT NULL,
  PRIMARY KEY (`POSTID`),
  KEY `UID` (`UID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `post` */

/*Table structure for table `querstions` */

DROP TABLE IF EXISTS `querstions`;

CREATE TABLE `querstions` (
  `QID` int(11) DEFAULT NULL,
  `UID` int(11) DEFAULT NULL,
  `QDATE` date DEFAULT NULL,
  `QTIME` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `QUESTION` text,
  `QSTATUS` int(11) DEFAULT NULL,
  KEY `UID` (`UID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `querstions` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `UNAME` varchar(500) DEFAULT NULL,
  `UPASSWORD` varchar(500) DEFAULT NULL,
  `USTATUS` int(11) DEFAULT NULL,
  `UFULLNAME` varchar(500) DEFAULT NULL,
  `UEMAILID` varchar(500) DEFAULT NULL,
  `UBIO` text,
  `UINDUSTRY` varchar(500) DEFAULT NULL,
  `UOCCUPATION` varchar(500) DEFAULT NULL,
  `UINTEREST` varchar(500) DEFAULT NULL,
  `UGENDER` int(11) DEFAULT NULL,
  `UWEBSITE` text,
  `UPHOTO` text,
  `UACCOUNT` int(11) DEFAULT NULL,
  `UDOB` date DEFAULT NULL,
  `UPLACE` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`UID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`UID`,`UNAME`,`UPASSWORD`,`USTATUS`,`UFULLNAME`,`UEMAILID`,`UBIO`,`UINDUSTRY`,`UOCCUPATION`,`UINTEREST`,`UGENDER`,`UWEBSITE`,`UPHOTO`,`UACCOUNT`,`UDOB`,`UPLACE`) values (1,'sonymamtha','Mamtha1988',1,'mamtha','sonymamtha@gmail.com','Lorem ','IT','Software engineer','music',2,'http://www.google.com',NULL,1,'1988-12-30','Bangalore');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
