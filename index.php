<?php
//Header wont display navbar info
include 'include/headerlocked.php';

if (isset($_SESSION['user_authenticated']) && $_SESSION['user_authenticated'] === true) {
// User is authenticated, show the navigation bar
    include 'include/header.php';
}
?>

<!DOCTYPE html>

<html lang="en">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="./assets/styles.css" rel="stylesheet">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>

<!-- Log out success message will appear when user signs out -->
<?php

if(isset($_GET['logout']) && $_GET['logout'] === 'success' ){
    echo '<div class="alert alert-success" role="alert"> Logout successful!</div>';
    logEvent();
}

?>
<div class="container mt-5">

<h1><br>Welcome to INFT-2100 Group2's Website!</h1>

<p>Need to create an account? Click <a href='sign-up.php'>Sign-Up</a> to register. </p>
<p>Already have an account? Click <a href='sign-in.php'>Sign-In</a> to sign in. </p>


<!-- Login in Sign Up Buttons-->

    <a href="sign-in.php"  class="btn btn-primary">Sign-In Here</a>
    <a href="sign-up.php"  class="btn btn-primary">Sign-Up Here</a>


</div>
</body>

</html>


<!-- ============================= Start of Footer =============================
<?php
include 'include/footer.php';
?>
