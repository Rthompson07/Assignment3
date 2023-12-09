<?php

/**
 * File: functions.php
 *
 * Purpose:
 * - This file contains the essential functions used throughout the website.
 * - Students are expected to implement and potentially extend these functions as needed.
 *
 * To-Do:
 * 1. Implement the 'hash_password' function to securely hash user passwords.
 * 2. Implement the 'verify_password' function to check a given password against its hash.
 * 3. Add any other utility functions that you may need for the website.
 *
 * Remember to:
 * - Use PHP's built-in functions and libraries where appropriate.
 * - Follow the security practices mentioned during lectures.
 */

/**
 * Redirect user to the specified URL
 * @param string $url
 * @return void
 */

function redirect(string $url) : void {
    header("Location: " . $url);
    exit;
}

/**
 *  Sets message in the session
 * @param string $msg
 * @return void
 */
function setFlashMessage(string $msg): void {
    $_SESSION['flash'] = $msg;
}

/**
 * Retrieves current flash message from the session
 * @return string|null
 */
function getFlashMessage() : ?string{
    return $_SESSION['flash'] ?? null;
}

/**
 * Checks if flash message was set
 * @return bool
 */
function hasFlashMessage() : bool {
    return isset($_SESSION['flash']);
}

/**
 * Remove flash message
 * @return void
 */
function removeFlashMessage() : void{
    unset($_SESSION['flash']);
}

/**
 * Retrieves and removes the current flash message from the session
 * @return string The flash message or an empty string if it does not exist
 */
function flashMessage() : string {
    $message = getFlashMessage();
    removeFlashMessage();
    return $message();
}

/**
 * Sanitizes input param by trimming white spaces
 * And removing HTML tags and special characters
 * @param string $input
 * @return string
 */
function sanitize(string $input): string
{
    // first trim
    $input = trim($input);

    // strip HTML
    $input = strip_tags($input);

    // remove special char
    $input = htmlspecialchars($input,ENT_QUOTES, 'UTF-8');

    return $input;
}

/**
 * Log out for user function
 * @return void
 */
function logOffUser(): void
{
    if(isset($_SESSION['email_address'])){
        session_destroy();
        session_unset();
        setFlashMessage("Logout successful. You have been logged out.");
        header("Location: sign-in.php?logout=success");
        exit;
    } else {
        header("Location: sign_in.php");
        exit;
    }
// lib/functions.php
}

/**
 * Logs flash message activities with timestamp on text file
 * @return void
 */
function logEvent(): void{
    $logFile = 'log.txt';

    $flashMessage = getFlashMessage();
    $logMessage = "[" . date('Y-m-d H:i:s') . "] {$flashMessage} \n";

    // Open log file
    $file = fopen($logFile, 'a');

    // Append log message in the file
    fwrite($file, $logMessage);

    // Close file
    fclose($file);
}