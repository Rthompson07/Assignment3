<?php
require_once 'vendor/autoload.php';
require_once 'lib/functions.php';
require_once 'lib/db_php.php';

// Initialize Faker
$faker = Faker\Factory::create();

try {
    $connection = db_connect();

    for ($i=0; $i<1; $i++) {
    // Set parameter values
        $email_address = $faker->email;
        $first_name = $faker->firstName;
        $last_name = $faker->lastName;
        $password = $faker->password;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $phone_extension = $faker->randomNumber(5, true);
        $user_type = $faker->randomElement(['s', 'a', 'c', 'p', 'd', 'v']);

        try {
            $result = registerUser($email_address, $first_name, $last_name, $hashedPassword, $phone_extension, $user_type);

            // Check the result
            if ($result) {
                echo "Data inserted successfully!";
            } else {
                echo "Error: unable to insert data";
            }
        } catch (Exception $e) {
        }

    }
} catch (Exception $e) {

}
