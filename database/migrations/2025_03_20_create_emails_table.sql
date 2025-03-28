CREATE TABLE emails (
id INT AUTO_INCREMENT PRIMARY KEY,
`to` VARCHAR(255) NOT NULL,
subject VARCHAR(255) NOT NULL,
body TEXT NOT NULL,
status VARCHAR(50) DEFAULT 'pending',
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);