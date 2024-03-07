<?php

include('EntityClassLib.php');

function getPDO() {
    // catch the database associative array from config.ini
    $dbConnection = parse_ini_file("config.ini");
    // extract corresponding values 
    extract($dbConnection);
    // pass the setting values to the PDO constructor to establish database connection
    return new PDO($dsn, $user, $password);
}

//save user without Hashed password
function addNewUserWithoutHashed($userId, $name, $phoneNum, $password, $role) {
    $pdo = getPDO();
    $sql = "INSERT INTO user (UserId, Name, Phone, Password, Role) VALUES ('$userId', '$name', '$phoneNum', '$password', '$role')";
    $pdoStmt = $pdo->query($sql);
}

//save user with Hashed password
function addNewUserWithHashed($userId, $name, $phoneNum, $password, $role) {
    $pdo = getPDO();
    $hashedPassword = hash("sha256", $password);
    $sql = "INSERT INTO user (UserId, Name, Phone, Password, Role) VALUES ('$userId', '$name', '$phoneNum', '$hashedPassword', '$role')";
    $pdoStmt = $pdo->query($sql);
}

//Without input sanitization and hash
function getUserByIdAndPasswordWithoutSanitizationAndHash($userId, $password) {
    $pdo = getPDO();
    $sql = "SELECT userId, Name, Phone, Role FROM user WHERE userId = '$userId' and password ='$password'";
    $resultSet = $pdo->query($sql);
    if ($resultSet) {
        $row = $resultSet->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new user($row['userId'], $row['Name'], $row['Phone'], $row['Role']);
        } else {
            return null;
        }
    }
}

//With input sanitization and hash
function getUserByIdAndPasswordWithSanitizationAndHash($userId, $password) {
    $pdo = getPDO();
    
    // Sanitize input
    $userId = filter_var($userId, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);
    
    // Hash the password
    $hashedPassword = hash("sha256", $password);

    // Use a prepared statement
    $sql = "SELECT userId, Name, Phone, Role FROM user WHERE userId = :userId AND password = :password";
    $stmt = $pdo->prepare($sql);
    
    // Bind parameters
    $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
    
    // Execute the statement
    $stmt->execute();
    
    // Fetch the result
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
        return new user($row['userId'], $row['Name'], $row['Phone'], $row['Role']);
    } else {
        return null;
    }
//filter_var is used to sanitize the input by removing any potentially harmful characters.
//The password is hashed using SHA-256 before being used in the query.
//A prepared statement is used to prevent SQL injection.
//Parameters are bound using bindParam to ensure proper data type handling and security.
}

//Without sanitization and prepared statement
function getCoursesByKeywordsWithoutSanitizationAndPrepared($word) {
    $pdo = getPDO();
    $sql = "SELECT * FROM Course WHERE Title LIKE '%$word%'";
    $resultSet = $pdo->query($sql);

    $courses = array();

    foreach ($resultSet as $row) {
        $course = new course($row['CourseCode'], $row['Title'], $row['WeeklyHours']);
        $courses[] = $course;
    }

    return $courses;
}

//With sanitization and prepared statement
function getCoursesByKeywordsWithSanitizationAndPrepared($word) {
    $pdo = getPDO();

    // Sanitize input
    $word = filter_var($word, FILTER_SANITIZE_STRING);

    // Use a prepared statement
    $sql = "SELECT * FROM Course WHERE Title LIKE :word";
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $searchTerm = "%$word%";
    $stmt->bindParam(':word', $searchTerm, PDO::PARAM_STR);

    // Execute the statement
    $stmt->execute();

    $courses = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $course = new Course($row['CourseCode'], $row['Title'], $row['WeeklyHours']);
        $courses[] = $course;
    }

    return $courses;
}


function getAllUsers() {
    $pdo = getPDO();
    $sql = "SELECT * FROM User";
    $resultSet = $pdo->query($sql);

    $users = array();

    foreach ($resultSet as $row) {
        $user = new user($row['UserId'], $row['Name'], $row['Phone'], $row['Role']);
        $users[] = $user;
    }
    return $users;
}

function getUserById($userId) {
    $pdo = getPDO();
    $sql = "SELECT userId, Name, Phone, Role FROM user WHERE userId = '$userId'";
    $resultSet = $pdo->query($sql);
    if ($resultSet) {
        $row = $resultSet->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new user($row['userId'], $row['Name'], $row['Phone'], $row['Role']);
        } else {
            return null;
        }
    }
}

function getAllCourses() {
    $pdo = getPDO();
    $sql = "SELECT * FROM Course";
    $resultSet = $pdo->query($sql);

    $courses = array();

    foreach ($resultSet as $row) {
        $course = new course($row['CourseCode'], $row['Title'], $row['WeeklyHours']);
        $courses[] = $course;
    }
    return $courses;
}



function getUserRecordById($userId) {
    $pdo = getPDO();
    $sql = "SELECT UserId, Name, Phone, Role FROM User WHERE userId = '$userId'";
    $resultSet = $pdo->query($sql);
    if ($resultSet) {
        $row = $resultSet->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new user($row['UserId'], $row['Name'], $row['Phone'], $row['Role']);
        }
    }
}

function ValidateName($name) {
    if (!isset($name) || empty(trim($name))) {
        return "Name cannot be blank";
    }
}

function ValidateUserID($usertID) {
    if (!isset($usertID) || empty(trim($usertID))) {
        return "UserID cannot be blank";
    }

    if (getUserRecordById($usertID)) {
        return 'A User with this ID has already signed up';
    }
}

function ValidateUserIDForLogin($usertID) {
    if (!isset($usertID) || empty(trim($usertID))) {
        return "UserID cannot be blank";
    }
}

function ValidatePhone($phone) {
    $pattern = '/^[2-9]\d{2}-[2-9]\d{2}-\d{4}$/';
    if (!isset($phone) || empty(trim($phone))) {
        return "Phone number cannot be blank";
    } elseif (!preg_match($pattern, $phone)) {
        return "Incorrect phone number";
    }
}

function ValidatePassword($password) {

    if (!isset($password) || empty(trim($password))) {
        return "Password cannot be blank";
    } else if (
            strlen($password) < 6 ||
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[a-z]/', $password) ||
            !preg_match('/[0-9]/', $password)
    ) {
        return "Password should be at least 6 characters long and contain at least one uppercase letter, one lowercase letter, and one digit.";
    }
}

function ValidatePasswordForLogin($password) {

    if (!isset($password) || empty(trim($password))) {
        return "Password cannot be blank";
    }
}

function ValidatePasswordRetyped($password, $passwordRetype) {

    if (!isset($passwordRetype) || empty(trim($passwordRetype))) {
        return "Password cannot be blank";
    } else if ($password !== $passwordRetype) {
        return "Passwords are not consistent";
    }
}
