CREATE TABLE transactions(
                             txn_id VARCHAR(255) PRIMARY KEY,
                             payment_status VARCHAR(255) NOT NULL,
                             item_name VARCHAR(255) NOT NULL,
                             payment_amount VARCHAR(255) NOT NULL,
                             payer_email VARCHAR(255) NOT NULL
);