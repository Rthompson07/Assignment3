<?php
//session_start();
include 'include/header.php';

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
<?php

if(isset($_GET['logout']) && $_GET['logout'] === 'success' ){
    echo '<div class="alert alert-success" role="alert"> Logout successful!</div>';
}

?>
<div class="container mt-5">
<h1><br>About Us</h1>
<hr>

<p>We are Group 2! We are a team of three students currently attending school at <a href="https://durhamcollege.ca " >Durham College</a>
    studying Computer Programing. In this web application, we are creating a website which will first ask the user to create a
    profile for themselves. When the user enters the correct data into the sign-up.php page. They will be redirected to the sign-in.php page. At that
    point, the user can use their newly created email and password to log into the dashboard.php page. </p>

</div>
</body>

</html>


<!-- ============================= Start of Footer =============================
<?php
include 'include/footer.php';
?>
