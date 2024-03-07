<?php
session_start();

include('Functions.php');

if (isset($_SESSION['loggedIn'])) {
    header('Location:Logout.php');
    exit();
}

// data persistence 
if (isset($_POST['submit'])) {
    $userId = $_POST['userId'];
    $userIdError = ValidateUserIDForLogin($userId);
    $_SESSION['userId'] = $userId;

    //password 
    $password = $_POST['password'];
    $passwordError = ValidatePasswordForLogin($password);

    
    if (!$userIdError && !$passwordError) {
        try {
            //before sanitized
            //using ' OR '1'='1 for either userid or password input
            $userLoggedIn = getUserByIdAndPasswordWithoutSanitizationAndHash($userId, $password);
            
            //after sanitized and used prepared statment
            //$userLoggedIn = getUserByIdAndPasswordWithSanitizationAndHash($userId, $password);      
            if ($userLoggedIn) {
                $_SESSION['loggedIn'] = true;
                $_SESSION['userLoggedIn'] = $userLoggedIn;
            } else {
                $loggedInError = 'Incorrect user ID and/or password';
            }
       } catch (Exception $ex) {
            die("The system is currently not available, try again later");
       }
  }
} elseif (isset($_POST['clear'])) {
    $_SESSION['userId'] = '';
}
?>

<?php include("./common/header.php");
?>

<div id="wrapper" class="flex-grow-1">
    <?PHP
    if (!isset($_SESSION['loggedIn'])) :
        ?>
        <form class="container my-1" id="loginInfo" method="post" action="./Login.php">


            <div class="row align-content-center justify-content-center my-2">
                <div class="display-6 fw-bolder text-center">
                    Log in
                </div>
            </div>

            <div class="row mt-3 align-content-center text-center">
                <p>You need to <a href="NewUser.php" class="d-inline mx-1 fw-bold text-decoration-none">sign up</a>if you are a new student.</p>
            </div>

            <!--data for userId-->
            <div class="row align-content-center justify-content-center mt-4">
                <div class="col-4 text-end ">
                    <label for="userId" class="text-xl fw-bold">UserId:</label>
                </div>

                <div class="col-4 text-start">
                    <input type="text" name="userId" class="form-control col-4"                     
                    <?php
                    if (isset($_SESSION['userId'])) {
                        echo 'value="' . $_SESSION['userId'] . '"';
                    }
                    ?>>
                </div>

                <div class="col-4 text-danger fw-bolder error">
                    <?php
                    global $userIdError;
                    if ($userIdError) {
                        echo $userIdError;
                    }
                    ?>
                </div>
            </div>

            <!--Data for password-->
            <div class="row align-content-center justify-content-center mt-4">
                <div class="col-4 text-end ">
                    <label for="password" class="text-xl fw-bold">Password:</label>
                </div>

                <div class="col-4 text-start">
                    <input type="password" name="password" class="form-control col-4"                     
                    <?php
                    if (isset($_SESSION['password'])) {
                        echo 'value="' . $_SESSION['password'] . '"';
                    }
                    ?>>
                </div>

                <div class="col-4 text-danger fw-bolder error">
                    <?php
                    global $passwordError;
                    if ($passwordError) {
                        echo $passwordError;
                    }
                    ?>
                </div>
            </div>

            <!--buttons-->
            <div class="row mt-3">
                <div class="col-4"></div>
                <div class="col-4">
                    <input type='submit' name='submit' class="btn btn-primary btn-rounded m-2" value='Submit' >
                    <input type='submit' name='clear' class="btn btn-warning btn-rounded m-2" value='Clear' >
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 text-danger fw-bolder error text-center">
                    <?php
                    global $loggedInError;
                    if ($loggedInError) {
                        print $loggedInError;
                    }
                    ?>
                </div>
            </div>
        </form>
    <?php else : ?>
        <div class="container my-1">
            <p>Successfully logged in!</p>
        </div>
    <?php endif; ?>
</div>

<?php include('./common/footer.php'); ?>