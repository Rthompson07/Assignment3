<?php


// 1. Include the header
include 'include/header.php';


if (isset($_SESSION['edit'])) {
    echo '<div class="alert alert-success" role="alert">Update successful!</div>';
    unset($_SESSION['edit']); // Clear the success message
}



// 2. Check user authentication
//session_start();
if (!isset($_SESSION['email_address'])) {
    // Not authenticated, redirect to login
    header("sign-in.php");
    exit;
}

$users = getAllUsers();
// 3. Fetch user-specific data (placeholder, requires proper implementation)
// $email_address = $_SESSION['email_address'];
// Fetch user details based on email address from the database
// ...


echo '<div class="alert alert-success" role="alert"> Welcome '. $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] .  '</div>';


// Display the Dashboard content
?>
<div class="container">
    <h1 class="h2">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <p>Here are our user entries</p>
    </div>
    <h4><br>Select <q>ID</q> number to edit employee information</h4>
    <h2>Section title</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
                <th>ID</th>
                <th>Email Address</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone Extension</th>
                <th>User Type</th>
                <th>Time Created</th>
            </tr>
            <tbody>
            <?php
            foreach ($users as $user) {
                echo '<td><a href="edituser.php?id=' . urlencode($user['id']) . '&email=' . urlencode($user['email_address'])
                . '&first_name=' . urlencode($user['first_name']) . '&last_name=' . urlencode($user['last_name']) .
                    '&phone_extension=' . urlencode($user['phone_extension']) . '&user_type=' . urlencode($user['user_type']) . '">'
                    .  $user['id'] . '</a></td>';

                echo "<td>" . $user['email_address'] . "</td>";
                echo "<td>" . $user['first_name'] . "</td>";
                echo "<td>" . $user['last_name'] . "</td>";
                echo "<td>" . $user['phone_extension'] . "</td>";
                echo "<td>" . $user['user_type'] . "</td>";
                echo "<td>" . $user['created_time'] . "</td>";
                echo "</tr>";


            }
            ?>
        </table>
    </div>
</div>

<?php

// Include the footer
include 'include/footer.php'
?>

