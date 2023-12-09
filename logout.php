<?php
require_once 'lib/db_php.php';
require_once 'include/header.php';
?>

<?php
/**
 * File: logout.php
 *
 * Purpose:
 * - This file is responsible for handling user logout.
 * - Upon visiting this file, the user's session should be destroyed and they should be redirected to the homepage.
 *
 * To-Do:
 * 1. Ensure that the session is started.
 * 2. Destroy the user's session.
 * 3. Redirect the user to the homepage or the login page.
 *
 * Remember to:
 * - Handle session securely to prevent any potential session hijacking.
 */

// TODO: Start the session if it hasn't been started already.
session_start();

// Check if the user is logged in (replace 'user_id' with your actual session variable)
if (!isset($_SESSION['email_address'])) {
    // User is not logged in, redirect to the login page
    header("Location: sign-in.php");
    exit();
}
setFlashMessage("{$_SESSION['first_name']} had successfully logged out!");
logEvent();
// TODO: Destroy the user's session.
session_destroy();
// TODO: Redirect the user to the homepage or the login page.
header("Location: index.php");
exit();
?>



<?php
include 'include/footer.php';
?>