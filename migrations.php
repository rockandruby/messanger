<?php
require_once 'config/db.php';
require_once 'core/Database.php';

$connection = \Core\Database::connect(false);

$connection->query("CREATE SCHEMA IF NOT EXISTS `".\DbConfig\DATABASE."`");

$connection->query("CREATE TABLE IF NOT EXISTS `".\DbConfig\DATABASE."`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `active` TINYINT(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
");

$connection->query("CREATE TABLE IF NOT EXISTS `".\DbConfig\DATABASE."`.`admins` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
");

$connection->query("CREATE TABLE IF NOT EXISTS `".\DbConfig\DATABASE."`.`dialogs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `current_user_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_current_user_idx` (`current_user_id` ASC),
  INDEX `fk_dialogs_1_idx` (`user_id` ASC),
  UNIQUE INDEX `dialog_1` (`current_user_id` ASC, `user_id` ASC),
  UNIQUE INDEX `dialog_2` (`user_id` ASC, `current_user_id` ASC),
  CONSTRAINT `fk_current_user`
    FOREIGN KEY (`current_user_id`)
    REFERENCES `messanger`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dialogs_1`
    FOREIGN KEY (`user_id`)
    REFERENCES `messanger`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION);
");

$connection->query("CREATE TABLE IF NOT EXISTS `messanger`.`messages` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `text` TEXT NOT NULL,
  `user_id` INT NOT NULL,
  `dialog_id` INT NULL,
  `is_read` TINYINT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `user_idx` (`user_id` ASC),
  INDEX `fk_dialog_idx` (`dialog_id` ASC),
  INDEX `new_messages` (`dialog_id` ASC, `user_id` ASC, `is_read`),
  CONSTRAINT `fk_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `messanger`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dialog`
    FOREIGN KEY (`dialog_id`)
    REFERENCES `messanger`.`dialogs` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION);
");