SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `mind_paradise` ;
CREATE SCHEMA IF NOT EXISTS `mind_paradise` DEFAULT CHARACTER SET utf8 ;
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
  `role` SMALLINT(6) NOT NULL DEFAULT 1 ,
  `messages_read` INT NOT NULL DEFAULT 0 ,
  `messages_unread` INT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `username` (`username` ASC) ,
  UNIQUE INDEX `email` (`email` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 6;


-- -----------------------------------------------------
-- Table `mind_paradise`.`adminstrator_profiles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`adminstrator_profiles` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`adminstrator_profiles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `admin_id` INT(11) NOT NULL ,
  `avatar` VARCHAR(255) NULL COMMENT '头像' ,
  `first_name` VARCHAR(45) NULL COMMENT '名' ,
  `family_name` VARCHAR(45) NULL COMMENT '姓' ,
  `age` INT NULL COMMENT '年龄' ,
  `gender` TINYINT NULL COMMENT '性别' ,
  `phone_number` VARCHAR(20) NULL COMMENT '电话号码' ,
  `qq_number` VARCHAR(20) NULL COMMENT 'qq号码' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `user_id_UNIQUE` (`admin_id` ASC) ,
  CONSTRAINT `FK_Reference_17`
    FOREIGN KEY (`admin_id` )
    REFERENCES `mind_paradise`.`users` (`id` ))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mind_paradise`.`blogrolls`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`blogrolls` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`blogrolls` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `url` VARCHAR(255) NOT NULL ,
  `title` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mind_paradise`.`categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`categories` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`categories` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `parent_id` INT(11) NULL DEFAULT NULL ,
  `name` VARCHAR(10) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Reference_2` (`parent_id` ASC) ,
  CONSTRAINT `FK_Reference_2`
    FOREIGN KEY (`parent_id` )
    REFERENCES `mind_paradise`.`categories` (`id` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mind_paradise`.`cases`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`cases` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`cases` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(100) NOT NULL ,
  `abstract` VARCHAR(300) NOT NULL ,
  `f_public` TINYINT(4) NULL DEFAULT NULL ,
  `category_id` INT(11) NULL DEFAULT NULL ,
  `owner_id` INT(11) NULL ,
  `user_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Reference_3` (`category_id` ASC) ,
  INDEX `fk_cases_users1` (`owner_id` ASC) ,
  INDEX `fk_cases_users2` (`user_id` ASC) ,
  CONSTRAINT `FK_Reference_3`
    FOREIGN KEY (`category_id` )
    REFERENCES `mind_paradise`.`categories` (`id` ),
  CONSTRAINT `fk_cases_users1`
    FOREIGN KEY (`owner_id` )
    REFERENCES `mind_paradise`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cases_users2`
    FOREIGN KEY (`user_id` )
    REFERENCES `mind_paradise`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mind_paradise`.`case_details`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`case_details` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`case_details` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `detail_order` DECIMAL(10,0) NOT NULL DEFAULT '1' ,
  `chief_compliant` VARCHAR(500) NOT NULL ,
  `diagnosis` VARCHAR(500) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  `consultant_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`, `detail_order`) ,
  INDEX `fk_case_details_users1` (`consultant_id` ASC) ,
  CONSTRAINT `FK_Reference_7`
    FOREIGN KEY (`id` )
    REFERENCES `mind_paradise`.`cases` (`id` ),
  CONSTRAINT `fk_case_details_users1`
    FOREIGN KEY (`consultant_id` )
    REFERENCES `mind_paradise`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mind_paradise`.`webcontents`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`webcontents` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`webcontents` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL COMMENT 'author' ,
  `title` VARCHAR(30) NOT NULL ,
  `abstract` VARCHAR(200) NOT NULL ,
  `category` INT NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `comment_count` INT(11) NULL DEFAULT '0' COMMENT '评论数' ,
  `browse_count` INT(11) NULL DEFAULT '0' COMMENT '浏览数' ,
  `path` VARCHAR(150) NOT NULL ,
  `f_public` TINYINT(4) NULL DEFAULT NULL ,
  `f_visible` TINYINT(4) NULL DEFAULT NULL ,
  `f_top` TINYINT(4) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Reference_14` (`user_id` ASC) ,
  CONSTRAINT `FK_Reference_14`
    FOREIGN KEY (`user_id` )
    REFERENCES `mind_paradise`.`users` (`id` ))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mind_paradise`.`comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`comments` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`comments` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `parent_comment_id` INT(11) NULL DEFAULT NULL ,
  `webcontent_id` INT(11) NOT NULL ,
  `commentor_id` INT(11) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `content` VARCHAR(200) NOT NULL ,
  `commentted_user_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Reference_12` (`webcontent_id` ASC) ,
  INDEX `FK_Reference_13` (`parent_comment_id` ASC) ,
  INDEX `FK_Reference_9` (`commentor_id` ASC) ,
  INDEX `fk_comments_users1` (`commentted_user_id` ASC) ,
  CONSTRAINT `FK_Reference_12`
    FOREIGN KEY (`webcontent_id` )
    REFERENCES `mind_paradise`.`webcontents` (`id` ),
  CONSTRAINT `FK_Reference_13`
    FOREIGN KEY (`parent_comment_id` )
    REFERENCES `mind_paradise`.`comments` (`id` ),
  CONSTRAINT `FK_Reference_9`
    FOREIGN KEY (`commentor_id` )
    REFERENCES `mind_paradise`.`users` (`id` ),
  CONSTRAINT `fk_comments_users1`
    FOREIGN KEY (`commentted_user_id` )
    REFERENCES `mind_paradise`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mind_paradise`.`consultant_profiles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `consultant_profiles`;

CREATE TABLE `consultant_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(45) DEFAULT NULL,
  `realname` varchar(45) NOT NULL,
  `age` varchar(45) DEFAULT NULL,
  `gender` varchar(45) NOT NULL,
  `education` varchar(100) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `qq_number` varchar(45) DEFAULT NULL,
  `microblog` varchar(45) DEFAULT NULL,
  `blog` varchar(45) DEFAULT NULL,
  `weixin_number` varchar(45) DEFAULT NULL,
  `personal_information` text NOT NULL,
  `experience` text NOT NULL,
  `profession` text NOT NULL,
  `price` text NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_time` datetime NOT NULL,
  `modified_time` datetime DEFAULT NULL,
  `consultant_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `consultant_id` (`consultant_id`),
  CONSTRAINT `consultant_profiles_ibfk_1` FOREIGN KEY (`consultant_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB ;


-- -----------------------------------------------------
-- Table `mind_paradise`.`encyclopedia_entries`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`encyclopedia_entries` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`encyclopedia_entries` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `category_id` INT(11) NOT NULL ,
  `user_id` INT(11) NULL DEFAULT NULL COMMENT 'author' ,
  `entry` VARCHAR(10) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `path` VARCHAR(150) NOT NULL ,
  `browse_count` INT(11) NULL DEFAULT 0,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Reference_1` (`category_id` ASC) ,
  INDEX `FK_Reference_4` (`user_id` ASC) ,
  CONSTRAINT `FK_Reference_1`
    FOREIGN KEY (`category_id` )
    REFERENCES `mind_paradise`.`categories` (`id` ),
  CONSTRAINT `FK_Reference_4`
    FOREIGN KEY (`user_id` )
    REFERENCES `mind_paradise`.`users` (`id` ))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mind_paradise`.`messages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`messages` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`messages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL ,
  `type` INT(11) NOT NULL ,
  `abstract` VARCHAR(300) NOT NULL ,
  `link_url` TEXT NOT NULL ,
  `f_read` TINYINT(4) NOT NULL DEFAULT 0 ,
  `created` DATETIME NOT NULL ,
  `link_title` VARCHAR(45) NOT NULL ,
  `trigger_user_id` INT(11) NULL ,
  `trigger_username` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Reference_15` (`user_id` ASC) ,
  CONSTRAINT `FK_Reference_15`
    FOREIGN KEY (`user_id` )
    REFERENCES `mind_paradise`.`users` (`id` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mind_paradise`.`tags`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`tags` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`tags` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `tag` VARCHAR(10) NOT NULL ,
  `viewed_count` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `tag_UNIQUE` (`tag` ASC) )
ENGINE = InnoDB;


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
AUTO_INCREMENT = 2;

-- -----------------------------------------------------
-- Table `mind_paradise`.`user_profiles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`user_profiles` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`user_profiles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL ,
  `avatar` VARCHAR(255) NULL COMMENT '头像' ,
  `first_name` VARCHAR(45) NULL COMMENT '名' ,
  `family_name` VARCHAR(45) NULL COMMENT '姓' ,
  `age` INT NULL COMMENT '年龄' ,
  `gender` TINYINT NULL COMMENT '性别' ,
  `birthplace` VARCHAR(45) NULL COMMENT '出生地点' ,
  `birthday` DATE NULL COMMENT '出生日期' ,
  `profession` VARCHAR(45) NULL COMMENT '职业' ,
  `nationality` VARCHAR(45) NULL COMMENT '民族' ,
  `education` VARCHAR(45) NULL COMMENT '学历' ,
  `finacial_situation` VARCHAR(45) NULL COMMENT '经济状况' ,
  `religion` VARCHAR(45) NULL COMMENT '宗教' ,
  `marital_status` VARCHAR(45) NULL COMMENT '婚姻状况' ,
  `hobby` VARCHAR(45) NULL COMMENT '业余爱好' ,
  `health_condition` VARCHAR(45) NULL COMMENT '健康状况' ,
  `present_address` VARCHAR(45) NULL COMMENT '现住址' ,
  `phone_number` VARCHAR(20) NULL COMMENT '电话号码' ,
  `qq_number` VARCHAR(20) NULL COMMENT 'qq号码' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC) ,
  CONSTRAINT `FK_Reference_18`
    FOREIGN KEY (`user_id` )
    REFERENCES `mind_paradise`.`users` (`id` ))
ENGINE = InnoDB ;

DROP TABLE IF EXISTS `case_articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `case_articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `body` text,
  `count` int(11) DEFAULT '0',
  `photo` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `comment_number` int(11) DEFAULT '0',
  `owner_id` int(11) DEFAULT NULL,
  `abstract` varchar(300) NOT NULL,
  `source` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`)
) ENGINE=InnoDB ;



-- -----------------------------------------------------
-- Table `mind_paradise`.`webcontents_tags`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`webcontents_tags` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`webcontents_tags` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `tag_id` INT(11) NOT NULL ,
  `webcontent_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Reference_11` (`webcontent_id` ASC) ,
  CONSTRAINT `FK_Reference_10`
    FOREIGN KEY (`tag_id` )
    REFERENCES `mind_paradise`.`tags` (`id` ),
  CONSTRAINT `FK_Reference_11`
    FOREIGN KEY (`webcontent_id` )
    REFERENCES `mind_paradise`.`webcontents` (`id` ))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mind_paradise`.`search_indices`
-- -----------------------------------------------------
DROP TABLE IF EXISTS search_indices;

CREATE TABLE search_indices(
    id      INT(11) AUTO_INCREMENT,
    type    int NOT NULL,
    content_id    INT(11) NOT NULL,
    content       TEXT NOT NULL,
    PRIMARY KEY (`id`),
    FULLTEXT(content)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET = latin1;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
