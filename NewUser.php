<?php
include('Functions.php');
session_start();
$userIdError = '';

if (isset($_POST['submit'])) {
    $userId = $_POST['userId'];
    $_SESSION['userId'] = $userId;

    $userIdError = ValidateUserID($userId);

    //role
    $role = $_POST['role'];

    //name
    $name = $_POST['name'];
    $nameError = ValidateName($name);
    $_SESSION['name'] = $name;

    //phone number
    $phoneNum = $_POST['phoneNum'];
    $phoneNumError = ValidatePhone($phoneNum);
    $_SESSION['phoneNum'] = $phoneNum;

    //password 
    $password = $_POST['password'];
    $passwordError = ValidatePassword($password);
    //passRetyped 
    $passwordRetyped = $_POST['passwordRetyped'];
    $passwordRetypedError = ValidatePasswordRetyped($password, $passwordRetyped);

    if (!$userIdError && !$nameError && !$phoneNumError && !$passwordError && !$passwordRetypedError) {
        try {
            //before hashed
            addNewUserWithoutHashed($userId, $name, $phoneNum, $password, $role);
            
            // after hashed
            //addNewUserWithHashed($userId, $name, $phoneNum, $password, $role);
            $userLoggedIn = getUserById($userId);
            if ($userLoggedIn) {
                $signedUpMsg = 'You have signed up an account. Please head to log in page to log in.';
            }
        } catch (Exception $e) {
            echo $e;
            die("The system is currently not available, try again later");
        }
    }
} elseif (isset($_POST['clear'])) {
    $_SESSION['userId'] = '';
    $_SESSION['name'] = '';
    $_SESSION['phoneNum'] = '';
    $_SESSION['password'] = '';
    $_SESSION['passwordRetyped'] = '';
}
?>


<?php include("./common/header.php");
?>

<?PHP
global $signedUpMsg;
if (!isset($signedUpMsg)) :
    ?>
    <form class="container mt-1" id="loginInfo" method="post" action="./NewUser.php">

        <div class="row align-content-center justify-content-center mt-2">
            <div class="display-6 fw-bolder text-center">
                Sign up
            </div>
        </div>

        <!--userId-->
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

        <!--name-->
        <div class="row align-content-center justify-content-center mt-4">
            <div class="col-4 text-end ">
                <label for="name" class="text-xl fw-bold">Name:</label>
            </div>

            <div class="col-4 text-start">
                <input type="text" name="name" class="form-control col-4"                     
                <?php
                if (isset($_SESSION['name'])) {
                    echo 'value="' . $_SESSION['name'] . '"';
                }
                ?>>
            </div>

            <div class="col-4 text-danger fw-bolder error">
                <?php
                global $nameError;
                if ($nameError) {
                    echo $nameError;
                }
                ?>
            </div>
        </div>

        <!--Phone number-->
        <div class="row align-content-center justify-content-center mt-4">
            <div class="col-4 text-end ">
                <label for="phoneNum" class="text-xl fw-bold">Phone Number:</label>
            </div>

            <div class="col-4 text-start">
                <input type="text" name="phoneNum" class="form-control col-4" 
                <?php
                if (isset($_SESSION['phoneNum'])) {
                    echo 'value="' . $_SESSION['phoneNum'] . '"';
                }
                ?>       
                       >
            </div>

            <div class="col-4 text-danger fw-bolder error">
                <?php
                global $phoneNumError;
                if ($phoneNumError) {
                    echo $phoneNumError;
                }
                ?>
            </div>
        </div>

        <!--role-->
        <div class="row align-content-center justify-content-center mt-4">
            <div class="col-4 text-end ">
                <label for="password" class="text-xl fw-bold">Role:</label>
            </div>
            <div class="col-4 text-start">
                <select class="form-control" name="role">
                    <option value="admin">Admin</option>
                    <option value="student">Student</option>
                </select>
            </div>
            <div class="col-4">
            </div>
        </div>

        <!--password-->
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

        <!--passwordRetype-->
        <div class="row align-content-center justify-content-center mt-4">
            <div class="col-4 text-end ">
                <label for="passwordRetyped" class="text-xl fw-bold">Password Again:</label>
            </div>

            <div class="col-4 text-start">
                <input type="password" name="passwordRetyped" class="form-control col-4"                     
                <?php
                if (isset($_SESSION['passwordRetyped'])) {
                    echo 'value="' . $_SESSION['passwordRetyped'] . '"';
                }
                ?>>
            </div>

            <div class="col-4 text-danger fw-bolder error">
                <?php
                global $passwordRetypedError;
                if ($passwordRetypedError) {
                    echo $passwordRetypedError;
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
    </form>
<?PHP else: ?>
    <?php
    global $signedUpMsg;
    echo $signedUpMsg;
    ?>
<?PHP endif; ?>





<?php include('./common/footer.php'); ?>