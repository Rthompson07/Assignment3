<?php


// TODO: Include necessary files like db.php and functions.php
include 'include/headerlocked.php';
require_once 'lib/db_php.php';
require_once 'lib/functions.php';

// TODO: Start the session if it hasn't been started already.
//session_start();

// TODO: If the user is already logged in, redirect to the dashboard.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // TODO: Capture user input (email_address and password).
    if (isset($_POST['email_address']) && isset($_POST['password'])) {
        $email_address = $_POST['email_address'];
        $password = $_POST['password'];
        // TODO: Sanitize and validate user input.
        $email_address = sanitize($email_address);

        // TODO: Check user credentials against the database.
        try {
            $conn = db_connect();
            //$query = "SELECT * FROM user WHERE email = ?";
            $query = pg_prepare($conn, "check_credential", "SELECT * FROM users WHERE email_address=$1");
            $result = pg_execute($conn, 'check_credential', array($email_address));
            $user = pg_fetch_assoc($result);
        } catch (Exception $e) {
            echo "unable to connect to database";
        }



        //$stmt = $conn->prepare($query);
        //$stmt->execute([$email_address]);
        //$user = $stmt->fetch(PDO::FETCH_ASSOC);

        // TODO: If credentials match, create a user session.
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            print_r($user);
            $_SESSION['email_address'] = $user['email_address'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];

           require_once './db_population_script.php';

            header('Location: dashboard.php');
            setFlashMessage("{$user['first_name']} has successfully signed in");
            logEvent();
            ob_flush();
            exit();
        } else {
            // TODO: If not, show an error message.
            setFlashMessage("Invalid credentials. Please try again.");
            logEvent();
        }
    }
}
?>


<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta http-equiv="X-UA-Compatible" content="IE=edge">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--    <title>Sign In</title>-->
<!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">-->
<!--    TODO: Add any necessary CSS or JS links here -->
<!--</head>-->
<!--<body>-->

<!-- TODO: Display the sign-in form. Fields should include email_address and password -->

<div class="container mt-5"

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <?php
        if(hasFlashMessage()){
            echo '<div class="alert alert-danger" role="alert">' . getFlashMessage() . '</div>';
            removeFlashMessage(); //clear message
        }

        if (isset($_SESSION['log-out'])) {
        echo '<div class="alert alert-success" role="alert">Update successful!</div>';
        unset($_SESSION['edit']); // Clear the success message
        }
        ?>
        <form  method="POST" class="bg-light p-5 rounded">
            <div class="form-group">
                <label for="email_address" class="sr-only">Email address</label>
                <input type="email" id="email_address" name="email_address" class="form-control" placeholder="Enter Email address" required autofocus>
            </div>
            <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <a href="index.php" class="btn btn-secondary">Return to Index</a>
        </form>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<!--</body>-->
<!--</html>-->

<!-- ============================= Start of Footer ============================= -->
<?php include 'include/footer.php'?>
