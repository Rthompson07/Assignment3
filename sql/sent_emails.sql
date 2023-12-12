CREATE TABLE sent_emails (
    id SERIAL PRIMARY KEY,
    sender VARCHAR(255) NOT NULL,
    recipient VARCHAR(255) NOT NULL,
    subject VARCHAR(255),
    message TEXT,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX idx_sender ON sent_emails(sender);
CREATE INDEX idx_recipient ON sent_emails(recipient);
CREATE INDEX idx_timestamp ON sent_emails(timestamp);