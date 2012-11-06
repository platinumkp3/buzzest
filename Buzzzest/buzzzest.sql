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
  KEY `UID` (`UID`),
  CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `users` (`UID`),
  CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`QID`) REFERENCES `querstions` (`QID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `answers` */

insert  into `answers`(`ANSID`,`QID`,`UID`,`ANSWER`,`ADATE`,`ATIME`,`ASTATUS`) values (1,1,1,'sdfsfsdf ','2012-11-05','2012-11-05 13:53:55',1),(2,1,1,'testing!!!!','2012-11-05','2012-11-05 13:54:47',1);

/*Table structure for table `blog` */

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog` (
  `BLID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) DEFAULT NULL,
  `BLTEXT` text,
  `BLDATE` date DEFAULT NULL,
  `BLTIME` datetime DEFAULT NULL,
  `BLSTATUS` int(11) DEFAULT NULL,
  `CATID` int(11) DEFAULT NULL,
  `BLTITLE` varchar(500) DEFAULT NULL,
  `BLSUMMARY` text,
  PRIMARY KEY (`BLID`),
  KEY `UID` (`UID`),
  KEY `FK_blog` (`CATID`),
  CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `users` (`UID`),
  CONSTRAINT `FK_blog` FOREIGN KEY (`CATID`) REFERENCES `category` (`CATID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `blog` */

insert  into `blog`(`BLID`,`UID`,`BLTEXT`,`BLDATE`,`BLTIME`,`BLSTATUS`,`CATID`,`BLTITLE`,`BLSUMMARY`) values (1,1,'lorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsum','2012-11-05','2012-11-05 12:13:12',1,1,'lorem ipsum','lorem ipsumlorem ipsumlorem ipsumlorem ipsum');

/*Table structure for table `blog_comments` */

DROP TABLE IF EXISTS `blog_comments`;

CREATE TABLE `blog_comments` (
  `BLCMTID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) DEFAULT NULL,
  `BLCDATE` date DEFAULT NULL,
  `BLCTIME` datetime NOT NULL,
  `BLCSTATUS` int(11) DEFAULT NULL,
  `BLCTEXT` text,
  `BLID` int(11) DEFAULT NULL,
  PRIMARY KEY (`BLCMTID`),
  KEY `UID` (`UID`),
  KEY `BLID` (`BLID`),
  CONSTRAINT `blog_comments_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `users` (`UID`),
  CONSTRAINT `blog_comments_ibfk_2` FOREIGN KEY (`BLID`) REFERENCES `blog` (`BLID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `blog_comments` */

insert  into `blog_comments`(`BLCMTID`,`UID`,`BLCDATE`,`BLCTIME`,`BLCSTATUS`,`BLCTEXT`,`BLID`) values (1,2,'2012-11-05','2012-11-05 12:19:59',1,'testing!!!',1);

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `CATID` int(11) NOT NULL AUTO_INCREMENT,
  `CATNAME` varchar(500) DEFAULT NULL,
  `CATSTATUS` int(11) DEFAULT NULL,
  `CATEGORYID` int(11) DEFAULT NULL,
  PRIMARY KEY (`CATID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `category` */

insert  into `category`(`CATID`,`CATNAME`,`CATSTATUS`,`CATEGORYID`) values (1,'Entertainment',1,1),(2,'Sports',1,1),(3,'News',1,1),(4,'Religious',1,1),(5,'Science',1,1),(6,'Environmental',1,1),(7,'Politics',1,1),(8,'Business',1,1),(9,'Personal',1,1),(10,'Close Ended',1,2),(11,'Open Ended',1,2);

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
  KEY `POSTID` (`POSTID`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`POSTID`) REFERENCES `post` (`POSTID`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`UID`) REFERENCES `users` (`UID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `comments` */

insert  into `comments`(`CMTID`,`UID`,`CDATE`,`CTIME`,`CSTATUS`,`CTEXT`,`POSTID`) values (1,1,'2012-11-04','2012-11-04 21:48:22',1,'awfoasf',1),(2,1,'2012-11-05','2012-11-05 00:08:28',1,'hi',1);

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
  KEY `UID` (`UID`),
  CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `users` (`UID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `friends` */

insert  into `friends`(`FRNID`,`UID`,`FSTATUS`,`FDATE`,`FTIME`,`MAILSTATUS`,`FRIENDID`) values (1,1,0,'2012-11-05','2012-11-05 17:40:53',1,11);

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
  KEY `UID` (`UID`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `users` (`UID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `post` */

insert  into `post`(`POSTID`,`UID`,`POST`,`POSTDATE`,`POSTTIME`,`PSTATUS`) values (1,1,'hi','2012-11-04','2012-11-04 21:32:59',1);

/*Table structure for table `querstions` */

DROP TABLE IF EXISTS `querstions`;

CREATE TABLE `querstions` (
  `QID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) DEFAULT NULL,
  `QDATE` date DEFAULT NULL,
  `QTIME` datetime NOT NULL,
  `QUESTION` text,
  `QSTATUS` int(11) DEFAULT NULL,
  `CATID` int(11) DEFAULT NULL,
  PRIMARY KEY (`QID`),
  KEY `UID` (`UID`),
  KEY `FK_querstions` (`CATID`),
  CONSTRAINT `FK_querstions` FOREIGN KEY (`CATID`) REFERENCES `category` (`CATID`),
  CONSTRAINT `querstions_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `users` (`UID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `querstions` */

insert  into `querstions`(`QID`,`UID`,`QDATE`,`QTIME`,`QUESTION`,`QSTATUS`,`CATID`) values (1,1,'2012-11-05','2012-11-05 12:49:06','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book',1,11);

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`UID`,`UNAME`,`UPASSWORD`,`USTATUS`,`UFULLNAME`,`UEMAILID`,`UBIO`,`UINDUSTRY`,`UOCCUPATION`,`UINTEREST`,`UGENDER`,`UWEBSITE`,`UPHOTO`,`UACCOUNT`,`UDOB`,`UPLACE`,`UDESCRIPTION`,`UTAGLINE`,`UTYPE`,`USPECIALITIES`,`UMISSION`,`UFOUNDED`,`UEMPCOUNT`) values (1,'sonymamtha','+dfnjKRY2ONeBS3vNJaymTLFWrVTsXnqhmpNIcBiZ3g=',1,'Mamtha    ','sonymamtha@gmail.com','lorem lipsum','IT                                  ','software engineer                                  ','music                                  ',2,'http://www.google.com','../uploads/1/profile/images.jpg',1,'1988-12-30','Bangalore                                  ',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'vinaykp3','NlUAbNzFlU8OL2XMFVfTHVcZQDl1Kz9jtPZm/v1frew=',1,'vinay','sonymamtha@yahoo.in',NULL,NULL,NULL,NULL,NULL,'http://www.google.com','../uploads/2/profile/15.JPG',2,NULL,NULL,'lorem lipsum',NULL,NULL,NULL,NULL,NULL,NULL),(3,'nagamani','s3QZUL4FF6IzpfzHxcy+1keH7ZsAMO42U4K7sBvBO5U=',1,'nagamani','sonymamtha@example.com',NULL,'IT',NULL,NULL,NULL,'http://www.google.com',NULL,3,NULL,'Bangalore',NULL,'tesing','IT','lorem lipsum','lorem lipsum','1988',1),(4,'pramodsony','uFaUICXErhzJ7gzEG5D0/1jF2HhRO7hAQ+dLJ4Z4a3E=',1,'Pramod','pramod@examle.com','lorem lipsum','blalbla','Student','music',1,'http://google.com',NULL,1,'1996-09-26','Bangalore',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'anithasony','r4JDcGwVKGfuN7xOlVgfQ5kprqx5HiO748KqNbhANJo=',1,'Anitha','anitha@example.com',NULL,NULL,NULL,NULL,NULL,'http://www.google.com',NULL,2,NULL,NULL,'lorem lipsum',NULL,NULL,NULL,NULL,NULL,NULL),(6,'sohansony','D0s8nbKmicB6Nddb6H79By15BfNJITKbbFq2+46HfW8=',1,'Sohan','sohan@skjhsf.com',NULL,'IT',NULL,NULL,NULL,'http://www.google.com',NULL,3,NULL,'pune',NULL,'my world','lorem','java','lorem lipsum','1988',20),(7,'rita','8bo9rm3Sf8o56UKzB/phE8QOEucptg9G9ys5qWwilMI=',1,'Rita','rita@example.com','lorem lipsum','Lorem lipsum','housewife','books',2,'http://google.com',NULL,1,'1997-01-01','Bangalore',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'nisha','kJq5NQVpQUitXGHhyJwLTszlLPNy0MPtHogewvLGNsw=',1,'Nisha','nisha@example.com',NULL,NULL,NULL,NULL,NULL,'http://www.google.com',NULL,2,NULL,NULL,'lorem lipsum',NULL,NULL,NULL,NULL,NULL,NULL),(9,'donald','+dhxV7oMTaB1WrpYOBkaV0h/ceVEPAg3h8RnRY2snAg=',1,'Donald','donald@duck.com',NULL,NULL,NULL,NULL,NULL,'http://www.google.com',NULL,2,NULL,NULL,'lorem lispum',NULL,NULL,NULL,NULL,NULL,NULL),(10,'maya','XiFWGEgaTa6dV28HF1mNc7DVwzxj5asfUJk0NVIRNEM=',1,'Maya','maya@example.com',NULL,NULL,NULL,NULL,NULL,'http://www.google.com',NULL,2,NULL,NULL,'lorem lipsum',NULL,NULL,NULL,NULL,NULL,NULL),(11,'piya','3bZOCO+XtVGG1iIGB5chbu8hTg22pHkPNVgHAKJ4+98=',1,'Piya','piya@example.com',NULL,'IT',NULL,NULL,NULL,'http://www.google.com',NULL,3,NULL,'pune',NULL,'my world','lorem','lorem lipsum','lorem lipsum','1988',20),(12,'zoya','OxJ6/ijpV8Xs66YMIGNBikj9MLJn2WmcQVVJTcKJvis=',1,'Zoya','zoya@example.com','lorem lipsum','blalbla','Student','books',2,'http://google.com',NULL,1,'1967-01-01','Bangalore',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,'rajeev','+gW/HBm5RKBnwPamt0fEUTn6Xdrgc/uBy/izb7Wkemg=',1,'Rajeev','rajeev@ksf.com',NULL,'IT',NULL,NULL,NULL,'http://www.google.com',NULL,3,NULL,'pune',NULL,'my world','lorem','QTP','lorem lipsum','1988',20),(14,'yash','YvoftafAtMQPf8OEcvHeKYseF+pnK5v7hBvx8Nggui8=',1,'yash','yash@example.com',NULL,NULL,NULL,NULL,NULL,'http://www.google.com',NULL,2,NULL,NULL,'lorem lipsum',NULL,NULL,NULL,NULL,NULL,NULL),(15,'rose','nyq9Ab8P5UzjrEUJnYm5wlF3S0ZSZdnQhG9LyogRXvo=',1,'rose','rose@example.com','lorem lipsum','blalbla','Student','dance',2,'http://google.com',NULL,1,'1979-04-04','Banglore',NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
