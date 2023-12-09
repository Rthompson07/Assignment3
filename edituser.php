<?php
//session_start();

include 'include/header.php';
require_once 'lib/db_php.php';
require_once 'lib/functions.php';

?>
<?php
//if ($_SERVER["REQUEST_METHOD"] == "GET") {
if(isset($_POST['edit'])) {
    echo ">>>>>>>>>>>>>>>>>>> in function  222";
    // Handle form submission and update user data in the database
    $user_id = $_POST['id'];
    $new_email = $_POST['email_address'];
    $new_first_name = sanitize($_POST['first_name']);
    $new_last_name = sanitize($_POST['last_name']);
    $new_phone_ext = sanitize($_POST['phone_extension']);
    $new_user_type = sanitize($_POST['user_type']);

    // Redirect back to dashboard.php after the update
    $_SESSION['REQUEST_METHOD'] = true;
    try {
        // update user
        $result = updateUser($user_id, $new_email, $new_first_name, $new_last_name, $new_phone_ext, $new_user_type);

        if($result){
            setFlashMessage("Update successful");
            logEvent();
            header('Location: dashboard.php');
            //ob_flush();
            exit();
            //redirect("Location: dashboard.php");
        }else{
            setFlashMessage("Update failed. Please try again.");
            logEvent();
            redirect("dashboard.php");
        }
    }catch (Exception $e){
        setFlashMessage($e->getMessage());
    }
}

if (isset($_POST['delete'])) {
    $user_id = $_POST['id'];

    // Handle user deletion
    try {
        $result = deleteUser($user_id);

        if ($result) {
            setFlashMessage("Deletion successful");
            logEvent();
            header('Location: dashboard.php');
            exit();
        } else {
            setFlashMessage("Deletion failed. Please try again.");
            logEvent();
            header('Location: dashboard.php');
            exit();
        }
    } catch (Exception $e) {
        setFlashMessage($e->getMessage());
        header('Location: dashboard.php');
        exit();
    }
}

?>
<div class="container mt-5">
<?php
if (isset($_GET['id']) && isset($_GET['email']) && isset($_GET['first_name']) && isset($_GET['last_name'])
    && isset($_GET['phone_extension']) && isset($_GET['user_type'])) {
    $user_id = $_GET['id'];
    $email = $_GET['email'];
    $first_name = $_GET['first_name'];
    $last_name = $_GET['last_name'];
    $phone_extension = $_GET['phone_extension'];
    $user_type = $_GET['user_type'];

    // Display the edit form with user data pre-filled
    echo '<h2>Edit User Information </h2>';
    echo '<form method=POST ' . 'class="bg-light p-5 rounded">';
    echo '<input type="hidden" name="id" value="' . $user_id . '">';
    // Edit User Email
    echo '<div class="form-group">';
    echo '<label for="email_address">Email Address:</label>';
    echo '<input type="email" name="email_address" class="form-control" value="' . $email . '" required>';
    echo '</div>';
    // Edit User First Name
    echo '<div class="form-group">';
    echo '<label for="first_name">First Name:</label>';
    echo '<input type="text" name="first_name" class="form-control" value="' . $first_name . '" required>';
    echo '</div>';
    // Edit User Last Name
    echo '<div class="form-group">';
    echo '<label for="last_name">Last Name:</label>';
    echo '<input type="text" name="last_name" class="form-control" value="' . $last_name . '" required>';
    echo '</div>';

    echo '<div class="form-group">';
    echo '<label for="phone_extension">Phone Extension:</label>';
    echo '<input type="text" name="phone_extension" class="form-control" value="' . $phone_extension . '" required>';
    echo '</div>';

    echo '<div class="form-group">';
    echo '<label for="user_type ">User Type:</label>';
    echo '<input type="text" name="user_type" class="form-control" value="' . $user_type . '" required>';
    echo '</div>';


    echo '<button type="submit" name="edit" class="btn btn-primary">Edit</button>';
    echo '<button type="submit" name="delete" class="btn btn-primary">Delete</button>';
    echo '</form>';

} else {
    echo 'User information not provided.';
}



?>
</div>

