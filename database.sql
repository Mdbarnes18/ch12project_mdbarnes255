CREATE DATABASE IF NOT EXISTS taus_data;

USE taus_data;

CREATE TABLE IF NOT EXISTS tbl_student (
    studentID INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(100) NOT NULL,
    lastName VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE
);

-- Sample records for testing the email search.
INSERT IGNORE INTO tbl_student (firstName, lastName, email)
VALUES
    ('Alex', 'Morgan', 'alex.morgan@example.com'),
    ('Jordan', 'Taylor', 'jordan.taylor@example.com'),
    ('Casey', 'Rivera', 'casey.rivera@example.com');
