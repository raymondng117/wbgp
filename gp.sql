DROP DATABASE IF EXISTS wbgp_database;

CREATE DATABASE wbgp_database;

USE wbgp_database;

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `UserId` VARCHAR(50) NOT NULL,
  `Name` VARCHAR(50) NULL,
  `Phone` VARCHAR(50) NULL,
  `Password` VARCHAR(256) NULL,
  `Role` VARCHAR(50) NULL,
  PRIMARY KEY (`UserId`)
);


DROP TABLE IF EXISTS `course`;

CREATE TABLE `course` (
  `CourseCode` varchar(10) NOT NULL,
  `Title` varchar(256) NOT NULL,
  `WeeklyHours` int NOT NULL
);

INSERT INTO `wbgp_database`.`course` VALUES ('CAD8400','AutoCAD I',3),('CAD8405','AutoCAD II',4),('CON8101','Residential Building/Estimating',5),('CON8102','Commercial Building/Estimating',5),('CON8404','Civil Estimating',3),('CON8406','Project Scheduling and Cost Control',3),('CON8411','Construction Materials I',3),('CON8416','GIS for Civil Engineering',3),('CON8417','Construction Materials II',5),('CON8418','Construction Building Code',3),('CON8425',' Design of Steel Structures',3),('CON8430','Computers and You',3),('CON8436','Building Systems',5),('CON8445','Soils Analysis',3),('CON8447','Foundations',3),('CON8466','Highway Engineering',3),('CON8476','Business Principles',3),('CST8110','Introduction to Computer Programming',4),('CST8209','Web Programming I',4),('CST8250','Database Design and Administration',4),('CST8253','Web Programming II',3),('CST8254','Network Operating Systems',4),('CST8255','Web Imaging and Animations',3),('CST8256','Web Programming Languages I',4),('CST8257','Web Applications Development',4),('CST8258','Web Project Management',3),('CST8259','Web Programming Languages II',4),('CST8260','Database System and Concepts',3),('CST8265','Web Security Basics',4),('CST8267','Ecommerce',3),('ENG8101','Statics',5),('ENG8102','Strength of Materials',3),('ENG8328','Hydraulics',3),('ENG8404','Introduction to Structural Design',3),('ENG8411','Structural Analysis',3),('ENG8435','Reinforced Concrete Design',3),('ENG8451','Water and Waste Water Technology',3),('ENG8454','Geotechnical Materials',3),('ENL1818M','Communications II',6),('ENL1818T','Communications I',3),('ENL1819Q','Reporting Technical Information II',5),('ENL1819T','Reporting Technical Information',3),('ENL4004','Orientation to Report Writing',4),('ENL8420','Project Report',3),('ENV8400','Environmental Engineering',3),('GED0192','General Education Elective',3),('MAT8001','Math Fundamentals',3),('MAT8050','Geometry and Trigonometry',3),('MAT8051','Algebra',3),('MAT8201','Calculus 1',3),('MGT8100','Career and College Success Skills',3),('MGT8400','Project Administration',4),('SAF8408','Health and Safety',4),('SUR8400','Civil Surveying III',3),('SUR8411','Construction Surveying I',5),('SUR8417','Construction Surveying II',3),('WKT8100','Cooperative Education Work Term Preparation',5);

