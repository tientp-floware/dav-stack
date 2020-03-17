
ALTER TABLE `users` ADD `username` VARBINARY(50) NOT NULL AFTER `remember_token`, ADD UNIQUE `username` (`username`);
ALTER TABLE `users` ADD `digesta1` VARBINARY(50) NOT NULL AFTER `username`;
ALTER TABLE `users` ADD `api_token` VARCHAR(50) NOT NULL AFTER `digesta1`;

INSERT INTO `users` (username,digesta1,email,api_token) VALUES
('admin',  '87fd274b7b6c01e48d7c2f965da8ddf7', 'tientp@flomail.net','1');
