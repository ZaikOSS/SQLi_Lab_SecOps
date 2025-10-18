CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    flag VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password, flag) VALUES
('alice', 'password123', 'SECOPS{FLAG1}'),
('bob', 'qwerty', 'SECOPS{FLAG2}'),
('charlie', '123456', 'SECOPS{FLAG3}'),
('dave', 'letmein', 'SECOPS{FLAG4}'),
('eve', 'trustno1', 'SECOPS{FLAG5}');
