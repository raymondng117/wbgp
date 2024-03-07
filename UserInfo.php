<?php
include('Functions.php');
session_start();

if (!isset($_SESSION['loggedIn'])) {
    header("Location: Login.php");
    exit();
} else {
    if (isset($_SESSION['userLoggedIn'])) {
        $userLoggedIn = $_SESSION['userLoggedIn'];
        $userId = $userLoggedIn->getUserId();
        $userRole = $userLoggedIn->getUserRole();
    }
}

if (isset($_POST['submit'])) {
    if (isset($_POST['keywords'])) {
        // before sanitized and userd prepared statement
        // SQL injection: a' UNION SELECT userid, role, password FROM User;
        $courses = getCoursesByKeywordsWithoutSanitizationAndPrepared($_POST['keywords']);

        // after sanitized and userd prepared statement
        //$courses = getCoursesByKeywordsWithSanitizationAndPrepared($_POST['keywords']);
    }
} else {
    $courses = getAllCourses();
}
?>

<?php include("./common/header.php");
?>

<?PHP
global $userRole;
if ($userRole == 'admin') :
    ?>
    <div class="container">
        <div class="row justify-content-start my-4">
            <p class="my-1 fs-6 fw-light"> Welcome, <span class="fs-6 fw-bold"><?php
    global $userLoggedIn;
    echo $userLoggedIn->getName();
    ?></span>
                ! Your role is <span class="fs-6 fw-bold"><?php
                global $userLoggedIn;
                echo $userLoggedIn->getUserRole();
    ?></span>. Below is a list of all accounts with full information.</P>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <table class="table table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">UserId</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $users = getAllUsers();
                        foreach ($users as $user) {
                            echo '<tr>';
                            echo '<th scope="row">' . $user->getUserId() . '</th>';
                            echo '<td>' . $user->getName() . '</td>';
                            echo '<td>' . $user->getPhoneNum() . '</td>';
                            echo '<td>' . $user->getUserRole() . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?PHP elseif ($userRole == 'student') : ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="container">
        <div class="row justify-content-start my-4">
            <p class="my-1 fs-6 fw-light"> Welcome, <span class="fs-6 fw-bold"><?php
    global $userLoggedIn;
    echo $userLoggedIn->getName();
    ?></span> Your role is <span class="fs-6 fw-bold"><?php
                    global $userLoggedIn;
                    echo $userLoggedIn->getUserRole();
                    ?></span>.
                ! Below is a list of all the courses currently offered by the college.</P>
        </div>

        <div class="row justify-content-start my-4">
            <div class="col-6">
                <input type="text" class="form-control" name="keywords" placeholder="Search">
            </div>

            <div class="col-1">
            </div>

            <div class="col-2">
                <button name="submit" class="btn btn-primary btn-block">Search</button>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <table class="table table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Course Code</th>
                            <th scope="col">Course Title</th>
                            <th scope="col">Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        global $courses;
                        foreach ($courses as $course) {
                            echo '<tr>';
                            echo '<th scope="row">' . $course->getCourseCode() . '</th>';
                            echo '<td>' . $course->getTitle() . '</td>';
                            echo '<td>' . $course->getWeeklyHours() . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
<?PHP endif; ?>
<?php include('./common/footer.php'); ?>