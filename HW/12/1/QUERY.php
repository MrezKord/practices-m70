<?php

// CREATE TABLE ` Branches` (
//     `ID` INT AUTO_INCREMENT NOT NULL,
//     `Name` VARCHAR(255) NOT NULL,
//     `Date` date,
//     `City` VARCHAR(255) NOT NULL,
//     PRIMARY KEY (`ID`)
//   );
  
//   CREATE TABLE `Offices` (
//     `ID` INT AUTO_INCREMENT NOT NULL,
//     `Name` VARCHAR(255) NOT NULL,
//     `Description` Text,
//     `Brach_id` INT NOT NULL,
//     PRIMARY KEY (`ID`),
//     FOREIGN KEY (`Brach_id`) REFERENCES ` Branches`(`ID`)
//   );
  
//   CREATE TABLE `Employees` (
//     `ID` INT AUTO_INCREMENT NOT NULL,
//     `Name` VARCHAR(255) NOT NULL,
//     `Age` INT NOT NULL,
//     `Income` INT NOT NULL,
//     `Office_id` INT NOT NULL,
//     PRIMARY KEY (`ID`),
//     FOREIGN KEY (`Office_id`) REFERENCES `Offices`(`ID`)
//   );
  
######################################################


// CREATE TABLE ` Branches` (
//     ` BranchesID` INT AUTO_INCREMENT NOT NULL,
//     ` BranchesName` VARCHAR(255) NOT NULL,
//     `Date` date,
//     `City` VARCHAR(255) NOT NULL,
//     PRIMARY KEY (` BranchesID`)
//   );
  
//   CREATE TABLE `Offices` (
//     `OfficeID` INT AUTO_INCREMENT NOT NULL,
//     `OfficeName` VARCHAR(255) NOT NULL,
//     `Description` Text,
//     `BrachID` INT NOT NULL,
//     PRIMARY KEY (`OfficeID`),
//     FOREIGN KEY (`BrachID`) REFERENCES ` Branches`(` BranchesID`)
//   );
  
//   CREATE TABLE `Employees` (
//     `EmployeeID` INT AUTO_INCREMENT NOT NULL,
//     `EmployeeName` VARCHAR(255) NOT NULL,
//     `Age` INT NOT NULL,
//     `Income` INT NOT NULL,
//     `OfficeID` INT NOT NULL,
//     PRIMARY KEY (`EmployeeID`),
//     FOREIGN KEY (`OfficeID`) REFERENCES `Offices`(`OfficeID`)
//   );