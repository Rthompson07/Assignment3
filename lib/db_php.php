<?php

// 1. Include constants.php
require_once "./config/constants.php";
$connection = null;

/**
 * Establish connection to Postgres SQL Database
 * @return mixed The database conenction
 * @throws Exception
 */
function db_connect(): mixed
{

    global $connection;

    if(!$connection) {
        $conn_string = sprintf("host=%s port=%s dbname=%s user=%s password=%s",
            DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASS);
        $connection = pg_connect($conn_string);
    }

    if(!$connection){
        throw new Exception("Database Connection Failed: ", pg_last_error());
    }


    return $connection;
}

/**
 * @param $plainPassword
 * @return string The hash password.
 * @throws Exception
 */

function hash_password($plainPassword) : string {
    // TODO: Implement this function using password_hash() or similar.
    // Reference: https://www.php.net/manual/en/function.password-hash.php

    $connection = db_connect();

    //Generate random salt for crypt function
    $salt_query = "SELECT gen_salt('bf')";
    $salt_result = pg_query($connection, $salt_query);

    if(!$salt_result){
        throw new Exception("Salt Generation failed: ". pg_last_error());
    }

    $salt_row = pg_fetch_row($salt_result);
    $salt = $salt_row[0];

    //Hash the password with the salt using postgresSQL crypt() function
    $hash_query = "SELECT crypt($1, $2)";
    $hash_result = pg_query_params($connection, $hash_query, array($plainPassword, $salt));
    if(!$hash_result){
        throw new Exception("Password hashing failed: ". pg_last_error());

    }
// Placeholder, replace with the actual hashed password
    $hash_row = pg_fetch_row($hash_result);
    return $hash_row[0];
}

/**
 * @param string $email
 * @return array|null
 * @throws Exception
 */
function user_select(string $email) : ?array
{
    $connection = db_connect();

    $query = "SELECT * FROM users WHERE email_address = $1";
    $result = pg_query_params($connection, $query, array($email));

    if(!$result){
        throw new Exception("Query Failed: ". pg_last_error());

    }else{

        return pg_fetch_assoc($result) ?: null;
    }
}


function getAllUsers() : array{
    $connection = db_connect();

    $query = "SELECT * FROM users";
    $result = pg_query_params($connection, $query, array());

    if(!$result){
        throw new Exception("Query failed: " . pg_last_error());
    }

    $users = [];
    while( $row = pg_fetch_assoc($result)){
        $users[] = $row;
    }
    return $users;
}

/**
 * Authenticates a user by checking the password against the hashed version of the database
 * @param $email
 * @param $plain_password
 * @return bool
 * @throws Exception
 */
function user_authenticate($email, $plain_password): bool
{
    $connection = db_connect();

    //retrieve the users hashed password from the database
    $user = user_select($email);
    if(!$user || !isset($user['password'])) {
        return false;
    }

    $stored_hash = $user['password'];

    // Hash the provided password using stored_hash as the salt and compare to stored hash
    $verify_query = "SELECT (crypt($1, $2) = $2) AS password_match";
    $verify_result = pg_query_params($connection, $verify_query, array($plain_password, $stored_hash));

    if(!$verify_result){
        throw new Exception("Password verification failed: ". pg_last_error());
    }

    $verify_row = pg_fetch_assoc($verify_result);
    return $verify_row['password_match'] === 't';

}

/**
 * Closes the database connection
 * @return void
 */
function db_close() : void {
    global $connection;
    if($connection){
        pg_close($connection);
    }
}

/**
 * Registers a new user in the database.
 * @param string $email_address
 * @param string $first_name
 * @param string $last_name
 * @param string $password
 * @param string $phone_extension
 * @param string $user_type
 * @return bool
 * @throws Exception
 */
function registerUser(string $email_address, string $first_name, string $last_name, string $password,
                      string $phone_extension, string $user_type) : bool {

    $connection = db_connect();

    // Check is user exists
    $existingUser = user_select($email_address);
    if($existingUser){
        throw new Exception("User with email {$email_address} already exists");
    }

    $query = "INSERT INTO users (email_address, first_name, last_name, password,
                            phone_extension, user_type) VALUES ($1, $2, $3, $4, $5, $6)";

    $result = pg_query_params($connection, $query, array($email_address, $first_name, $last_name, $password,
                      $phone_extension, $user_type));

    if(!$result){
        throw new Exception("Insertion Failed: " . pg_last_error());
    }

    return true;
}

// Check if user exists
function updateUser(string $user_id, string $new_email, string $new_first_name, string $new_last_name, string $new_phone_ext,
string $new_user_type) : bool {

    $connection = db_connect();

    $query = "UPDATE users SET email_address = $2, first_name = $3, last_name = $4, phone_extension = $5, user_type = $6 
             WHERE id = $1 ";

    $result = pg_query_params($connection, $query, array( $user_id, $new_email, $new_first_name, $new_last_name, $new_phone_ext
    , $new_user_type));

    if(!$result){
        throw new Exception("Insertion Failed: " . pg_last_error());
    }

    return true;
}

function deleteUser(string $user_id) : bool {

    $connection = db_connect();

    $query = "DELETE FROM users WHERE id = $1 ";

    $result = pg_query_params($connection, $query, array($user_id));

    if(!$result){
        throw new Exception("Deletion Failed: " . pg_last_error());
    }

    return true;
}


