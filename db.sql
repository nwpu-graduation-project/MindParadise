SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mind_paradise` DEFAULT CHARACTER SET latin1 ;
USE `mind_paradise` ;

-- -----------------------------------------------------
-- Table `mind_paradise`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`users` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(30) NOT NULL ,
  `password` VARCHAR(100) NOT NULL ,
  `email` VARCHAR(100) NULL DEFAULT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  `lastlogin` DATETIME NULL DEFAULT NULL ,
  `role` SMALLINT(6) NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `username` (`username` ASC) ,
  UNIQUE INDEX `email` (`email` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mind_paradise`.`adminstrator_profiles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`adminstrator_profiles` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`adminstrator_profiles` (
  `id` INT(11) NOT NULL ,
  `admin_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `user_id_UNIQUE` (`admin_id` ASC) ,
  CONSTRAINT `FK_Reference_17`
    FOREIGN KEY (`admin_id` )
    REFERENCES `mind_paradise`.`users` (`id` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mind_paradise`.`blogrolls`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`blogrolls` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`blogrolls` (
  `id` INT(11) NOT NULL ,
  `site` VARCHAR(30) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mind_paradise`.`categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`categories` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`categories` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `parentid` INT(11) NULL DEFAULT 0 ,
  `name` VARCHAR(10) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Reference_2` (`parentid` ASC) ,
  CONSTRAINT `FK_Reference_2`
    FOREIGN KEY (`parentid` )
    REFERENCES `mind_paradise`.`categories` (`id` ))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mind_paradise`.`user_profiles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`user_profiles` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`user_profiles` (
  `id` INT(11) NOT NULL ,
  `user_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC) ,
  CONSTRAINT `FK_Reference_18`
    FOREIGN KEY (`user_id` )
    REFERENCES `mind_paradise`.`users` (`id` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mind_paradise`.`consultant_profiles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`consultant_profiles` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`consultant_profiles` (
  `consultant_id` INT(11) NOT NULL ,
  `id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `consultant_id_UNIQUE` (`consultant_id` ASC) ,
  CONSTRAINT `FK_Reference_16`
    FOREIGN KEY (`consultant_id` )
    REFERENCES `mind_paradise`.`users` (`id` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mind_paradise`.`cases`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`cases` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`cases` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(100) NOT NULL ,
  `abstract` VARCHAR(300) NOT NULL ,
  `f_public` TINYINT(4) NULL DEFAULT NULL ,
  `owner_id` INT(11) NOT NULL ,
  `user_id` INT(11) NOT NULL ,
  `category_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Reference_3` (`category_id` ASC) ,
  INDEX `FK_Reference_5` (`user_id` ASC) ,
  INDEX `FK_Reference_6` (`owner_id` ASC) ,
  CONSTRAINT `FK_Reference_3`
    FOREIGN KEY (`category_id` )
    REFERENCES `mind_paradise`.`categories` (`id` ),
  CONSTRAINT `FK_Reference_5`
    FOREIGN KEY (`user_id` )
    REFERENCES `mind_paradise`.`user_profiles` (`id` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `FK_Reference_6`
    FOREIGN KEY (`owner_id` )
    REFERENCES `mind_paradise`.`consultant_profiles` (`consultant_id` ))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mind_paradise`.`case_details`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`case_details` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`case_details` (
  `id` INT(11) NOT NULL ,
  `detail_order` DECIMAL(10,0) NOT NULL DEFAULT 1 ,
  `chief_compliant` VARCHAR(500) NOT NULL ,
  `diagnosis` VARCHAR(500) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  `consultant_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`, `detail_order`) ,
  INDEX `fk_case_details_consultant_profiles1` (`consultant_id` ASC) ,
  CONSTRAINT `FK_Reference_7`
    FOREIGN KEY (`id` )
    REFERENCES `mind_paradise`.`cases` (`id` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `fk_case_details_consultant_profiles1`
    FOREIGN KEY (`consultant_id` )
    REFERENCES `mind_paradise`.`consultant_profiles` (`consultant_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mind_paradise`.`webcontents`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`webcontents` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`webcontents` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL COMMENT 'author' ,
  `title` VARCHAR(30) NOT NULL ,
  `abstract` VARCHAR(200) NOT NULL ,
  `category` VARCHAR(4) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `comment_num` INT(11) NULL DEFAULT 0 COMMENT '评论数' ,
  `browser_num` INT(11) NULL DEFAULT 0 COMMENT '浏览数' ,
  `path` VARCHAR(100) NOT NULL ,
  `f_public` TINYINT(4) NULL DEFAULT NULL ,
  `f_visible` TINYINT(4) NULL DEFAULT NULL ,
  `f_top` TINYINT(4) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Reference_14` (`user_id` ASC) ,
  CONSTRAINT `FK_Reference_14`
    FOREIGN KEY (`user_id` )
    REFERENCES `mind_paradise`.`users` (`id` ))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mind_paradise`.`comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`comments` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`comments` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `on_comment_id` INT(11) NULL DEFAULT NULL ,
  `webcontent_id` INT(11) NOT NULL ,
  `commentor_id` INT(11) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `content` VARCHAR(200) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Reference_12` (`webcontent_id` ASC) ,
  INDEX `FK_Reference_13` (`on_comment_id` ASC) ,
  INDEX `FK_Reference_9` (`commentor_id` ASC) ,
  CONSTRAINT `FK_Reference_12`
    FOREIGN KEY (`webcontent_id` )
    REFERENCES `mind_paradise`.`webcontents` (`id` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `FK_Reference_13`
    FOREIGN KEY (`on_comment_id` )
    REFERENCES `mind_paradise`.`comments` (`id` ),
  CONSTRAINT `FK_Reference_9`
    FOREIGN KEY (`commentor_id` )
    REFERENCES `mind_paradise`.`users` (`id` ))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mind_paradise`.`encyclopedia_entries`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`encyclopedia_entries` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`encyclopedia_entries` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `category_id` INT(11) NOT NULL ,
  `user_id` INT(11) NULL DEFAULT NULL COMMENT 'author' ,
  `entry` VARCHAR(10) NOT NULL ,
  `post_time` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `file_path` VARCHAR(100) NOT NULL ,
  `browser_num` INT(11) NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Reference_1` (`category_id` ASC) ,
  INDEX `FK_Reference_4` (`user_id` ASC) ,
  CONSTRAINT `FK_Reference_1`
    FOREIGN KEY (`category_id` )
    REFERENCES `mind_paradise`.`categories` (`id` ),
  CONSTRAINT `FK_Reference_4`
    FOREIGN KEY (`user_id` )
    REFERENCES `mind_paradise`.`users` (`id` ))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mind_paradise`.`notifications`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`notifications` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`notifications` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL ,
  `type` INT(11) NOT NULL ,
  `abstract` VARCHAR(300) NOT NULL ,
  `link_route` TEXT NOT NULL ,
  `f_read` TINYINT(4) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Reference_15` (`user_id` ASC) ,
  CONSTRAINT `FK_Reference_15`
    FOREIGN KEY (`user_id` )
    REFERENCES `mind_paradise`.`users` (`id` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mind_paradise`.`tags`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`tags` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`tags` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `tag` VARCHAR(10) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mind_paradise`.`tokens`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`tokens` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`tokens` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  `token` VARCHAR(32) NULL DEFAULT NULL ,
  `data` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `token` (`token` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mind_paradise`.`webcontents_tags`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`webcontents_tags` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`webcontents_tags` (
  `tag_id` INT(11) NOT NULL ,
  `webcontent_id` INT(11) NOT NULL ,
  PRIMARY KEY (`tag_id`, `webcontent_id`) ,
  INDEX `FK_Reference_11` (`webcontent_id` ASC) ,
  CONSTRAINT `FK_Reference_10`
    FOREIGN KEY (`tag_id` )
    REFERENCES `mind_paradise`.`tags` (`id` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `FK_Reference_11`
    FOREIGN KEY (`webcontent_id` )
    REFERENCES `mind_paradise`.`webcontents` (`id` ))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
