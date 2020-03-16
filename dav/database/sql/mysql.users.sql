CREATE TABLE users (
    id INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARBINARY(50),
    digesta1 VARBINARY(32),
    email VARBINARY(50),
    api_token VARBINARY(50),
    UNIQUE(username),
    UNIQUE(email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO users (username,digesta1,email,api_token) VALUES
('admin',  'c6e1ec7e1a26dbac76577dab1f301dec', 'tientp@flomail.net','1045');
