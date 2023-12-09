--
-- File: users.sql
--
-- Purpose:
-- - This file defines the SQL statements required to set up the 'users' table in the database.
-- - The 'users' table will store user-related details such as id, email_address, password, and so on.
--
-- To-Do:
-- 1. Create a table named 'users'.
-- 2. Define columns as specified in the assignment.
-- 3. Implement any other constraints or indexes as deemed necessary.
--
-- Remember to:
-- - Ensure that the 'email_address' column is unique as it's serving the purpose of identification.
-- - Use appropriate data types for each column.
--

-- Step 1. Create EXTENSION
CREATE EXTENSION IF NOT EXISTS pgcrypto;

-- STEP 2
DROP SEQUENCE IF EXISTS user_id_seq CASCADE;
CREATE SEQUENCE user_id_seq START 1000;

-- Step 3. Creating 'users' table

DROP TABLE IF EXISTS users;
CREATE TABLE users (
            id INTEGER PRIMARY KEY DEFAULT nextval('user_id_seq'), -- Auto-incrementing primary key
            email_address VARCHAR(255) UNIQUE NOT NULL, -- Ensuring email_address is unique
            first_name VARCHAR(100),
            last_name VARCHAR(100),
            password VARCHAR(255) NOT NULL, -- Remember to hash passwords before storing as mentioned in the security lecture.
            created_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Setting default to the current timestamp when record is created
            last_time TIMESTAMP,
            phone_extension VARCHAR(10), -- Assuming phone extensions are not more than 10 characters
            user_type CHAR(2) -- Character data with a fixed length of 2
);

-- Add any additional constraints or indexes if required.
--4. Inserting sample users into database
INSERT INTO users (email_address, first_name, last_name, password, phone_extension, user_type);
VALUES ('barry.allen@flash.com', 'Barry', 'Allen', crypt('FlashPassword123', gen_salt('bf', 8)),'1234', 's'),
       ('bruce.banner@hulk.com', 'Bruce', 'Banner', crypt('HulkPassword456', gen_salt('bf', 8)),'5678', 's');


--SELECT * FROM users