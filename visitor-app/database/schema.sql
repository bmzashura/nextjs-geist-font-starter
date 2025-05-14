-- MySQL schema for visitors table

CREATE TABLE visitors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    institution VARCHAR(255) NOT NULL,
    department VARCHAR(255) NOT NULL,
    datetime_in DATETIME NOT NULL,
    datetime_out DATETIME DEFAULT NULL,
    signature LONGTEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
