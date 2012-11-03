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
  `ATIME` datetime NOT NULL,
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
  `CTIME` datetime NOT NULL,
  `CSTATUS` int(11) DEFAULT NULL,
  `CTEXT` text,
  `POSTID` int(11) DEFAULT NULL,
  PRIMARY KEY (`CMTID`),
  KEY `UID` (`UID`),
  KEY `POSTID` (`POSTID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `comments` */

insert  into `comments`(`CMTID`,`UID`,`CDATE`,`CTIME`,`CSTATUS`,`CTEXT`,`POSTID`) values (1,1,'2012-11-03','2012-11-03 09:57:54',1,'adasdad',1),(2,1,'2012-11-03','2012-11-03 09:58:30',1,'asasadasdasd',2);

/*Table structure for table `friends` */

DROP TABLE IF EXISTS `friends`;

CREATE TABLE `friends` (
  `FRNID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) DEFAULT NULL,
  `FSTATUS` int(11) DEFAULT NULL,
  `FDATE` date DEFAULT NULL,
  `FTIME` datetime DEFAULT NULL,
  `MAILSTATUS` int(11) DEFAULT NULL,
  `FRIENDID` int(11) DEFAULT NULL,
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
  `POSTTIME` datetime DEFAULT NULL,
  `PSTATUS` int(11) DEFAULT NULL,
  PRIMARY KEY (`POSTID`),
  KEY `UID` (`UID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `post` */

insert  into `post`(`POSTID`,`UID`,`POST`,`POSTDATE`,`POSTTIME`,`PSTATUS`) values (1,1,'hi','2012-10-31','2012-10-31 10:52:10',1),(2,1,'testing','2012-11-03','2012-11-03 09:58:17',1);

/*Table structure for table `querstions` */

DROP TABLE IF EXISTS `querstions`;

CREATE TABLE `querstions` (
  `QID` int(11) DEFAULT NULL,
  `UID` int(11) DEFAULT NULL,
  `QDATE` date DEFAULT NULL,
  `QTIME` datetime NOT NULL,
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
  `UPASSWORD` text,
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
  `UDESCRIPTION` text,
  `UTAGLINE` varchar(500) DEFAULT NULL,
  `UTYPE` varchar(500) DEFAULT NULL,
  `USPECIALITIES` text,
  `UMISSION` text,
  `UFOUNDED` varchar(500) DEFAULT NULL,
  `UEMPCOUNT` int(11) DEFAULT NULL,
  PRIMARY KEY (`UID`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`UID`,`UNAME`,`UPASSWORD`,`USTATUS`,`UFULLNAME`,`UEMAILID`,`UBIO`,`UINDUSTRY`,`UOCCUPATION`,`UINTEREST`,`UGENDER`,`UWEBSITE`,`UPHOTO`,`UACCOUNT`,`UDOB`,`UPLACE`,`UDESCRIPTION`,`UTAGLINE`,`UTYPE`,`USPECIALITIES`,`UMISSION`,`UFOUNDED`,`UEMPCOUNT`) values (1,'sonymamtha','+dfnjKRY2ONeBS3vNJaymTLFWrVTsXnqhmpNIcBiZ3g=',1,'Mamtha    ','sonymamtha@gmail.com','lorem lipsum','IT                                  ','software engineer                                  ','music                                  ',2,'http://www.google.com','../uploads/1/profile/images.jpg',1,'1988-12-30','Bangalore                                  ',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'vinaykp3','NlUAbNzFlU8OL2XMFVfTHVcZQDl1Kz9jtPZm/v1frew=',1,'vinay','sonymamtha@yahoo.in',NULL,NULL,NULL,NULL,NULL,'http://www.google.com','../uploads/2/profile/15.JPG',2,NULL,NULL,'lorem lipsum',NULL,NULL,NULL,NULL,NULL,NULL),(3,'nagamani','s3QZUL4FF6IzpfzHxcy+1keH7ZsAMO42U4K7sBvBO5U=',1,'nagamani','sonymamtha@example.com',NULL,'IT',NULL,NULL,NULL,'http://www.google.com',NULL,3,NULL,'Bangalore',NULL,'tesing','IT','lorem lipsum','lorem lipsum','1988',1),(4,'pramodsony','uFaUICXErhzJ7gzEG5D0/1jF2HhRO7hAQ+dLJ4Z4a3E=',1,'Pramod','pramod@examle.com','lorem lipsum','blalbla','Student','music',1,'http://google.com',NULL,1,'1996-09-26','Bangalore',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'anithasony','r4JDcGwVKGfuN7xOlVgfQ5kprqx5HiO748KqNbhANJo=',1,'Anitha','anitha@example.com',NULL,NULL,NULL,NULL,NULL,'http://www.google.com',NULL,2,NULL,NULL,'lorem lipsum',NULL,NULL,NULL,NULL,NULL,NULL),(6,'sohansony','D0s8nbKmicB6Nddb6H79By15BfNJITKbbFq2+46HfW8=',1,'Sohan','sohan@skjhsf.com',NULL,'IT',NULL,NULL,NULL,'http://www.google.com',NULL,3,NULL,'pune',NULL,'my world','lorem','java','lorem lipsum','1988',20),(7,'rita','8bo9rm3Sf8o56UKzB/phE8QOEucptg9G9ys5qWwilMI=',1,'Rita','rita@example.com','lorem lipsum','Lorem lipsum','housewife','books',2,'http://google.com',NULL,1,'1997-01-01','Bangalore',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'nisha','kJq5NQVpQUitXGHhyJwLTszlLPNy0MPtHogewvLGNsw=',1,'Nisha','nisha@example.com',NULL,NULL,NULL,NULL,NULL,'http://www.google.com',NULL,2,NULL,NULL,'lorem lipsum',NULL,NULL,NULL,NULL,NULL,NULL),(9,'donald','+dhxV7oMTaB1WrpYOBkaV0h/ceVEPAg3h8RnRY2snAg=',1,'Donald','donald@duck.com',NULL,NULL,NULL,NULL,NULL,'http://www.google.com',NULL,2,NULL,NULL,'lorem lispum',NULL,NULL,NULL,NULL,NULL,NULL),(10,'maya','XiFWGEgaTa6dV28HF1mNc7DVwzxj5asfUJk0NVIRNEM=',1,'Maya','maya@example.com',NULL,NULL,NULL,NULL,NULL,'http://www.google.com',NULL,2,NULL,NULL,'lorem lipsum',NULL,NULL,NULL,NULL,NULL,NULL),(11,'piya','3bZOCO+XtVGG1iIGB5chbu8hTg22pHkPNVgHAKJ4+98=',1,'Piya','piya@example.com',NULL,'IT',NULL,NULL,NULL,'http://www.google.com',NULL,3,NULL,'pune',NULL,'my world','lorem','lorem lipsum','lorem lipsum','1988',20),(12,'zoya','OxJ6/ijpV8Xs66YMIGNBikj9MLJn2WmcQVVJTcKJvis=',1,'Zoya','zoya@example.com','lorem lipsum','blalbla','Student','books',2,'http://google.com',NULL,1,'1967-01-01','Bangalore',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,'rajeev','+gW/HBm5RKBnwPamt0fEUTn6Xdrgc/uBy/izb7Wkemg=',1,'Rajeev','rajeev@ksf.com',NULL,'IT',NULL,NULL,NULL,'http://www.google.com',NULL,3,NULL,'pune',NULL,'my world','lorem','QTP','lorem lipsum','1988',20),(14,'yash','YvoftafAtMQPf8OEcvHeKYseF+pnK5v7hBvx8Nggui8=',1,'yash','yash@example.com',NULL,NULL,NULL,NULL,NULL,'http://www.google.com',NULL,2,NULL,NULL,'lorem lipsum',NULL,NULL,NULL,NULL,NULL,NULL),(15,'rose','nyq9Ab8P5UzjrEUJnYm5wlF3S0ZSZdnQhG9LyogRXvo=',1,'rose','rose@example.com','lorem lipsum','blalbla','Student','dance',2,'http://google.com',NULL,1,'1979-04-04','Banglore',NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
