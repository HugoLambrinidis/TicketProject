SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema ticketProject
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ticketProject
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ticketProject` DEFAULT CHARACTER SET utf8 ;
USE `ticketProject` ;

-- -----------------------------------------------------
-- Table `ticketProject`.`Users_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ticketProject`.`Users_type` (
  `user_type_id` INT NOT NULL AUTO_INCREMENT,
  `user_type_type` VARCHAR(45) NULL,
  PRIMARY KEY (`user_type_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ticketProject`.`Users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ticketProject`.`Users` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(45) NULL,
  `user_lastname` VARCHAR(45) NULL,
  `user_username` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `user_user_type` VARCHAR(45) NULL,
  PRIMARY KEY (`user_id`),
  INDEX `fk_Users_Users_type_idx` (`user_user_type` ASC),
  CONSTRAINT `fk_Users_Users_type`
    FOREIGN KEY (`user_user_type`)
    REFERENCES `ticketProject`.`Users_type` (`user_type_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ticketProject`.`Messages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ticketProject`.`Messages` (
  `message_id` INT NOT NULL AUTO_INCREMENT,
  `message_date` TIMESTAMP NULL,
  `message_text` TEXT NULL,
  `message_user_id` INT NULL,
  PRIMARY KEY (`message_id`),
  INDEX `fk_Messages_Users1_idx` (`message_user_id` ASC),
  CONSTRAINT `fk_Messages_Users1`
    FOREIGN KEY (`message_user_id`)
    REFERENCES `ticketProject`.`Users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ticketProject`.`Status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ticketProject`.`Status` (
  `status_id` INT NOT NULL AUTO_INCREMENT,
  `status_type` VARCHAR(45) NULL,
  PRIMARY KEY (`status_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ticketProject`.`Tickets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ticketProject`.`Tickets` (
  `ticket_id` INT NOT NULL AUTO_INCREMENT,
  `ticket_titre` VARCHAR(45) NULL,
  `ticket_user_id` INT NULL,
  `ticket_admin_id` INT NULL,
  `ticket_status_id` INT NULL,
  `ticket_messages_id` INT NULL,
  PRIMARY KEY (`ticket_id`),
  INDEX `fk_Tickets_Users1_idx` (`ticket_user_id` ASC),
  INDEX `fk_Tickets_Users2_idx` (`ticket_admin_id` ASC),
  INDEX `fk_Tickets_Messages1_idx` (`ticket_messages_id` ASC),
  INDEX `fk_Tickets_Status1_idx` (`ticket_status_id` ASC),
  CONSTRAINT `fk_Tickets_Users1`
    FOREIGN KEY (`ticket_user_id`)
    REFERENCES `ticketProject`.`Users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tickets_Users2`
    FOREIGN KEY (`ticket_admin_id`)
    REFERENCES `ticketProject`.`Users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tickets_Messages1`
    FOREIGN KEY (`ticket_messages_id`)
    REFERENCES `ticketProject`.`Messages` (`message_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tickets_Status1`
    FOREIGN KEY (`ticket_status_id`)
    REFERENCES `ticketProject`.`Status` (`status_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
