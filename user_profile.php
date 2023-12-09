<?php
// Include the header file
include 'include/header.php';

// Include necessary files
require_once 'lib/db_php.php';
require_once 'lib/functions.php';

// Check if the user is authenticated
if (!isset($_SESSION['email_address'])) {
    // If not authenticated, redirect to the login page
    header("Location: sign-in.php");
    exit;
}

// Get user details from the session
$email_address = $_SESSION['email_address'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];

// Directory for uploading profile pictures
$targetDirectory = "uploads/";

// Display a welcome message and user information
echo '<div class="alert alert-success" role="alert"> Welcome ' . $first_name . ' ' . $last_name .  '</div>';
?>

<!-- Container for user profile -->
<div class="container">
    <h1 class="h2">User Profile</h1>

    <!-- Display user name -->
    <div class="btn-toolbar mb-2 mb-md-0">
        <?php echo '<div> ' . $first_name . ' ' . $last_name .  '</div>'; ?>
    </div>

    <!-- Profile picture box -->
    <div class="profile-picture-box">
        <!-- Display profile picture, use default if not set -->
        <img src="<?php echo isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : 'images/profilepictemp.jpg'; ?>" alt="Profile Picture" class="profile-picture" width="150" height="150">
    </div>

    <!-- Link to upload profile picture page -->
    <a href="http://localhost:8080/Assignment2/upload_pfp_page.php"><li>Upload Profile Pic Here</li></a>

    <!-- Inline styles for profile picture box -->
    <style>
        .profile-picture-box {
            width: 150px; /* Set the width of the box */
            height: 150px; /* Set the height of the box */
            border: 1px solid #ccc; /* Add a border to the box */
            overflow: hidden; /* Hide any overflowing content */
            display: inline-block; /* Display the box as an inline block */
        }

        .profile-picture {
            width: 100%; /* Make the image fill the entire container */
            height: auto; /* Maintain the image's aspect ratio */
            display: block; /* Remove any extra spacing below the image */
        }
    </style>

    <!-- Table to display user details -->
    <table class="table table-striped">
        <tbody>
        <tr>
            <th>Email Address</th>
            <td><?php echo $email_address; ?></td>
        </tr>
        <tr>
            <th>First Name</th>
            <td><?php echo $first_name; ?></td>
        </tr>
        <tr>
            <th>Last Name</th>
            <td><?php echo $last_name; ?></td>
        </tr>
        </tbody>
    </table>
</div>

<?php
// Include the footer file
include 'include/footer.php';
?>
