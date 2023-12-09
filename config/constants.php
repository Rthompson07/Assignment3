<?php
/*
-------------------------------------
File: constants.php
-------------------------------------
Purpose:
- To store constant values that will be frequently used across the application.
- This file should contain values such as the database connection details (host, username, password, database name).
- By keeping them as constants, it ensures that these values remain unchanged throughout the application and can be
- easily managed from a single location.

To-Do:
1. Define constants for the database connection (DB_HOST, DB_USER, DB_PASS, DB_NAME).
2. If there are other application-wide constants, like API keys or directory paths, define them here.

Methods/Components to incorporate:
- `const`: This is used to set a constant with a name and value.

Note:
- Be extremely careful about not sharing or exposing sensitive information like passwords or API keys.
- If you use version control, consider using environment variables or other methods to keep sensitive details out
- of the codebase.

Remember to:
- Avoid redefining constants. Once a constant is set, it cannot be changed or undefined.
- Use uppercase letters for constant names for clarity and convention.
*/

// 1. Database connection constants (Replace with actual values)
const DB_HOST = "postgres-php";
const DB_USER = "admin";
const DB_PASS = "password";
const DB_NAME = "INFT2100-F2023";
const DB_PORT = "5432";

const NGROK_URL = " https://68ce-76-69-152-23.ngrok-free.app";

const COOKIE_LIFESPAN = "2592000"; // 1 month: min:60 x sec:60 x day: 24 * day/month: 30

const ADMIN = 's';

const AGENT = 'a';

const CLIENT = 'c';

const PENDING = 'p';

const DISABLED = 'd';

const Villain = 'v';

// 2. Other application-wide constants can be defined below

// e.g., API keys, directory paths, etc.


