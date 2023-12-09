<?php

//require_once 'config/constants.php';
//require_once './lib/db_php.php';
//require_once './lib/functions.php';
session_start();
ob_start();


echo '<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Link to the Bootstrap CSS library-->
<!--  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="assets/styles.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 1 Group 2</title>
    <link rel="icon" href ="images/hippo-solid.svg" type="image/x-icon">
</head>
<body>
    <div class="header">
    <div class="inner_header">
        <div class="logo_container">
            <img src="./images/hippo-solid.svg" alt="hippo logo">
            <h1>INFT-2100 Group 2<span> Website</span></h1>
        </div>

        <ul class=navbar_header>

        </ul>
    </div>
</div>';
//<div class="container"> // Closing div might be in the footer.php -->
//
//
//// 4. Dynamic Navbar stub
///*
//TODO: Implement a dynamic navbar. If a user is logged in, show links relevant for logged-in users (e.g., Dashboard, Logout).
//If no user is logged in, show links like Sign-In.
//You might use sessions to check if a user is logged in or not.
//*/
//
//// Sample stub (fill in the implementation)
//function createDynamicNavbar() {
//    // TODO: Check if user is logged in via sessions and output the relevant links
//}
//
//// Call the function to display the navbar
//createDynamicNavbar();


