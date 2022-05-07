<?php


require_once "./vendor/autoload.php";

$connection = MySqlDatabaseConnection::getInstance();
$pdo1 = $connection->getConnection('localhost', 'root', '', 'hw12');


$query1 = new MySqlDatabase($connection);


// $stmt1 = 'CREATE TABLE `Branches` (
//   `BranchesID` INT AUTO_INCREMENT NOT NULL,
//   `BranchesName` VARCHAR(255) NOT NULL,
//   `Date` date,
//   `City` VARCHAR(255) NOT NULL,
//   PRIMARY KEY (`BranchesID`)
// );';
  
// $stmt2 = 'CREATE TABLE `Offices` (
//   `OfficeID` INT AUTO_INCREMENT NOT NULL,
//   `OfficeName` VARCHAR(255) NOT NULL,
//   `Description` Text,
//   `BrachID` INT NOT NULL,
//   PRIMARY KEY (`OfficeID`),
//   FOREIGN KEY (`BrachID`) REFERENCES `Branches`(`BranchesID`)
// );';
  
// $stmt3 = 'CREATE TABLE `Employees` (
//   `EmployeeID` INT AUTO_INCREMENT NOT NULL,
//   `EmployeeName` VARCHAR(255) NOT NULL,
//   `Age` INT NOT NULL,
//   `Income` INT NOT NULL,
//   `OfficeID` INT NOT NULL,
//   PRIMARY KEY (`EmployeeID`),
//   FOREIGN KEY (`OfficeID`) REFERENCES `Offices`(`OfficeID`)
// );';


// $query1->setStatment($stmt1)->execute();
// $query1->setStatment($stmt2)->execute();
// $query1->setStatment($stmt3)->execute();


########### EMPLOEEYS ###########

// $em1 = ['EmployeeName' => 'reza', 'Age' => 20, 'Income' => 2000, 'OfficeID' => 1];
// $em2 = ['EmployeeName' => 'taha', 'Age' => 25, 'Income' => 3000, 'OfficeID' => 3];
// $em3 = ['EmployeeName' => 'sara', 'Age' => 20, 'Income' => 700, 'OfficeID' => 2];
// $em4 = ['EmployeeName' => 'soda', 'Age' => 24, 'Income' => 700, 'OfficeID' => 2];
// $em5 = ['EmployeeName' => 'vahid', 'Age' => 26, 'Income' => 600, 'OfficeID' => 3];
// $em6 = ['EmployeeName' => 'sirvan', 'Age' => 27, 'Income' => 900, 'OfficeID' => 2];


// $query1->table('Employees')->insert($em1)->execute();
// $query1->table('Employees')->insert($em2)->execute();
// $query1->table('Employees')->insert($em3)->execute();
// $query1->table('Employees')->insert($em4)->execute();
// $query1->table('Employees')->insert($em5)->execute();
// $query1->table('Employees')->insert($em6)->execute();


// $result = $query1->table('Employees')->select()->fetchAll();
// print_r($result);


########### OFFICES ###########

// $office1 = ['OfficeName' => 'back_end', 'Description' => 'PHP Programmer', 'BrachID' => 2];
// $office2 = ['OfficeName' => 'front_end', 'Description' => 'JS Programmer', 'BrachID' => 1];
// $office3 = ['OfficeName' => 'Hacker', 'Description' => 'Pyton Programmer', 'BrachID' => 3];
// $office4 = ['OfficeName' => 'DevOps', 'Description' => 'null', 'BrachID' => 2];
// $office5 = ['OfficeName' => 'servant', 'Description' => 'Cleans', 'BrachID' => 3];


// $query1->table('Offices')->insert($office1)->execute();
// $query1->table('Offices')->insert($office2)->execute();
// $query1->table('Offices')->insert($office3)->execute();
// $query1->table('Offices')->insert($office4)->execute();
// $query1->table('Offices')->insert($office5)->execute();



// $result = $query1->table('Offices')->select()->fetchAll();
// print_r($result);

########### BRANCHES ###########

// $branch1 = ['BranchesName' => 'tak', 'Date' => '2012-2-2', 'City'=> 'asadabad'];
// $branch2 = ['BranchesName' => 'new', 'Date' => '2012-5-2', 'City'=> 'tehran'];
// $branch3 = ['BranchesName' => 'old', 'Date' => '2012-2-8', 'City'=> 'asadabad'];

// $query1->table('Branches')->insert($branch1)->execute();
// $query1->table('Branches')->insert($branch2)->execute();
// $query1->table('Branches')->insert($branch3)->execute();

//----------------------------  1  --------------------------------

###################  1.1  #####################

// $result = $query1->table('Employees')->select(['EmployeeName'])->condition('income' , 1000, '<')->fetchAll();
// print_r($result);

###################  1.2  #####################

// $result = $query1->table('Employees')->select(['Employees.EmployeeName', 'Offices.OfficeName'])->join('Offices', 'OfficeID', 'OfficeID')->fetchAll();
// print_r($result);
  
###################  1.3  #####################

// $result = $query1->table('Employees')
//                   ->select(['Offices.OfficeName', 'AVG(Employees.Income)'])
//                   ->join('Offices', 'OfficeID', 'OfficeID')
//                   ->groupBy('OfficeName')->fetchAll();
// print_r($result);
  
###################  1.4  #####################

// $result = $query1->table('Offices')
//                  ->select(['OfficeName'])
//                  ->join('Branches', 'BrachID', 'BranchesID')
//                  ->condition('City', 'asadabad')
//                  ->fetchAll();
// print_r($result);

###################  1.5  #####################

// $result = $query1->table('Branches')
//                  ->select(['BranchesName', 'COUNT(Offices.OfficeName)'])
//                  ->join('Offices', 'BranchesID', 'BrachID')
//                  ->groupBy('BrachID')
//                  ->fetchAll();
// print_r($result);

###################  1.6  #####################

// $result = $query1
//             ->table('Branches')
//             ->select(['BranchesName', 'Employees.EmployeeName'])
//             ->join('Offices', 'BranchesID', 'BrachID')
//             ->table('Offices')
//             ->join('Employees', 'OfficeID', 'OfficeID')
//             ->fetchAll();

// print_r($result);

###################  1.7  #####################

// $result = $query1
//             ->table('Branches')
//             ->select(['BranchesName', 'AVG(Employees.Income)'])
//             ->join('Offices', 'BranchesID', 'BrachID')
//             ->table('Offices')
//             ->join('Employees', 'OfficeID', 'OfficeID')
//             ->condition('City', 'tehran')
//             ->groupBy('BranchesName')
//             ->fetchAll();

// print_r($result);

###################  1.8  #####################

// $result = $query1
//             ->table('Branches')
//             ->select(['BranchesName', 'COUNT(Employees.EmployeeName)'])
//             ->join('Offices', 'BranchesID', 'BrachID')
//             ->table('Offices')
//             ->join('Employees', 'OfficeID', 'OfficeID')
//             ->groupBy('BranchesName')
//             ->fetchAll();

// print_r($result);

###################  1.9  #####################

// $result = $query1
//             ->table('Branches')
//             ->select(['Offices.OfficeName', 'COUNT(Employees.EmployeeName)'])
//             ->join('Offices', 'BranchesID', 'BrachID')
//             ->table('Offices')
//             ->join('Employees', 'OfficeID', 'OfficeID', 'LEFT') 
//             ->condition('Branches.City', 'asadabad')
//             ->groupBy('OfficeName')
//             ->fetchAll();

// print_r($result);


###################  1.10  #####################


// $result = $query1
//             ->table('Branches')
//             ->select(['BranchesName', 'COUNT(Employees.EmployeeName)'])
//             ->join('Offices', 'BranchesID', 'BrachID')
//             ->table('Offices')
//             ->join('Employees', 'OfficeID', 'OfficeID')
//             ->groupBy('BranchesName')
//             ->condition('COUNT(Employees.EmployeeName)', 10, '<', 'HAVING')
//             ->fetchAll();

// print_r($result);