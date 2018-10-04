DROP DATABASE IF EXISTS `test` ;
CREATE DATABASE `test`;
USE `test`;

CREATE TABLE `users` (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `user` VARCHAR(32) DEFAULT NULL,
    `password` VARCHAR(32) DEFAULT NULL,
    `providedPassword` VARCHAR(32) DEFAULT NULL
);
CREATE TABLE `salts` (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `user_id` INTEGER DEFAULT NULL,
    `salt` VARCHAR(6) DEFAULT NULL,
    KEY(`user_id`)
);

DELIMITER //
CREATE PROCEDURE insertUser (IN user VARCHAR(32),IN password VARCHAR(32))
BEGIN

    SET @user       := user;
    SET @password   := password;

    INSERT INTO `users` (user,providedPassword) VALUES(@user, @password);
    SET @user_id        := (LAST_INSERT_ID());

    SET @salt           := (SELECT MD5(CONCAT(user,NOW())));
    INSERT INTO `salts`(salt,user_id) VALUES(@salt, @user_id);
    SET @id             := (LAST_INSERT_ID());

    SET @hashedPassword := (SELECT MD5(CONCAT((SELECT salt FROM `salts` WHERE id = @id), @password)));

    UPDATE `users` SET password = @hashedPassword WHERE id = @user_id;
END; //

DELIMITER ;

CALL insertUser("daniel", "a2kp09");
CALL insertUser("crillelle", "makasd0");
SELECT * FROM `users`;
SELECT * FROM `salts`;

-- Rebuild passwords from salt and provided password like this. Possible to make procedure of it.
SELECT
    `users`.user,
    `users`.providedPassword,
    (SELECT salt FROM `salts` WHERE id = `users`.id) AS usedSalt,
    (SELECT MD5(CONCAT((SELECT salt FROM `salts` WHERE id = `users`.id), providedPassword))) AS rebuiltHashedPassword
FROM
    `users`;
