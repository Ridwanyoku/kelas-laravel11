

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Masukkan user contoh
INSERT INTO users (username, password) 
VALUES 
('admin', MD5('admin123')),
('user', MD5('user123'));
