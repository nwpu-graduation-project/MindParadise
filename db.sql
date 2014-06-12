SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mind_paradise` DEFAULT CHARACTER SET utf8 ;
USE `mind_paradise` ;

-- -----------------------------------------------------
-- Table `mind_paradise`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mind_paradise`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(30) NOT NULL ,
  `password` VARCHAR(100) NOT NULL ,
  `email` VARCHAR(100) NULL DEFAULT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  `lastlogin` DATETIME NULL DEFAULT NULL ,
  `role` SMALLINT(6) NOT NULL DEFAULT '1' ,
  `messages_read` INT(11) NOT NULL DEFAULT '0' ,
  `messages_unread` INT(11) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `username` (`username` ASC) ,
  UNIQUE INDEX `email` (`email` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 25
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mind_paradise`.`adminstrator_profiles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mind_paradise`.`adminstrator_profiles` (
  `id` INT(11) NOT NULL ,
  `admin_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `user_id_UNIQUE` (`admin_id` ASC) ,
  CONSTRAINT `FK_Reference_17`
    FOREIGN KEY (`admin_id` )
    REFERENCES `mind_paradise`.`users` (`id` ))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mind_paradise`.`blogrolls`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mind_paradise`.`blogrolls` (
  `id` INT(11) NOT NULL ,
  `site` VARCHAR(30) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mind_paradise`.`case_articles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mind_paradise`.`case_articles` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(50) CHARACTER SET 'gbk' NULL DEFAULT NULL ,
  `body` TEXT CHARACTER SET 'gbk' NULL DEFAULT NULL ,
  `count` INT(11) NULL DEFAULT '0' ,
  `photo` VARCHAR(255) NULL DEFAULT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  `comment_number` INT(11) NULL DEFAULT '0' ,
  `owner_id` INT(11) NULL DEFAULT NULL ,
  `abstract` VARCHAR(300) NOT NULL ,
  `source` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `owner_id` (`owner_id` ASC) ,
  CONSTRAINT `case_articles_ibfk_1`
    FOREIGN KEY (`owner_id` )
    REFERENCES `mind_paradise`.`users` (`id` ))
ENGINE = InnoDB
AUTO_INCREMENT = 43
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mind_paradise`.`case_comments`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mind_paradise`.`case_comments` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `parent_comment_id` INT(11) NULL DEFAULT NULL ,
  `case_article_id` INT(10) UNSIGNED NULL DEFAULT NULL ,
  `commentor_id` INT(11) NULL DEFAULT NULL ,
  `created` DATETIME NOT NULL ,
  `content` VARCHAR(200) NOT NULL ,
  `commentted_user_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `case_article_id` (`case_article_id` ASC) ,
  INDEX `commentted_user_id` (`commentted_user_id` ASC) ,
  CONSTRAINT `case_comments_ibfk_1`
    FOREIGN KEY (`case_article_id` )
    REFERENCES `mind_paradise`.`case_articles` (`id` ),
  CONSTRAINT `case_comments_ibfk_2`
    FOREIGN KEY (`commentted_user_id` )
    REFERENCES `mind_paradise`.`users` (`id` ))
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mind_paradise`.`cases`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mind_paradise`.`cases` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `owner_id` INT(11) NULL DEFAULT NULL ,
  `user_id` INT(11) NULL DEFAULT NULL ,
  `first_name` VARCHAR(45) NULL DEFAULT NULL ,
  `family_name` VARCHAR(45) NULL DEFAULT NULL ,
  `age` INT(11) NULL DEFAULT NULL ,
  `gender` VARCHAR(45) NULL DEFAULT NULL ,
  `birthday` VARCHAR(45) NULL DEFAULT NULL ,
  `profession` VARCHAR(45) NULL DEFAULT NULL ,
  `nationality` VARCHAR(45) NULL DEFAULT NULL ,
  `education` VARCHAR(45) NULL DEFAULT NULL ,
  `finacial_situation` VARCHAR(45) NULL DEFAULT NULL ,
  `religion` VARCHAR(45) NULL DEFAULT NULL ,
  `marital_status` VARCHAR(45) NULL DEFAULT NULL ,
  `hobby` VARCHAR(45) NULL DEFAULT NULL ,
  `health_condition` VARCHAR(45) NULL DEFAULT NULL ,
  `present_address` VARCHAR(45) NULL DEFAULT NULL ,
  `phone_number` VARCHAR(20) NULL DEFAULT NULL ,
  `qq_number` VARCHAR(20) NULL DEFAULT NULL ,
  `birthplace` VARCHAR(45) NULL DEFAULT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  `case_count` INT(11) NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_cases_users1` (`owner_id` ASC) ,
  INDEX `fk_cases_users2` (`user_id` ASC) ,
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
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mind_paradise`.`case_details`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mind_paradise`.`case_details` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `detail_order` DECIMAL(10,0) NOT NULL DEFAULT '1' ,
  `chief_compliant` VARCHAR(500) NOT NULL ,
  `diagnosis` VARCHAR(500) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  `consultant_id` INT(11) NOT NULL ,
  `user_id` INT(11) NULL DEFAULT NULL ,
  `title` VARCHAR(100) NULL DEFAULT NULL ,
  `abstract` VARCHAR(300) NULL DEFAULT NULL ,
  `f_public` VARCHAR(45) NULL DEFAULT NULL ,
  `category_id` INT(11) NULL DEFAULT NULL ,
  `case_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`, `detail_order`) ,
  INDEX `fk_case_details_users1` (`consultant_id` ASC) ,
  INDEX `user_id` (`user_id` ASC) ,
  INDEX `case_id` (`case_id` ASC) ,
  CONSTRAINT `case_details_ibfk_1`
    FOREIGN KEY (`case_id` )
    REFERENCES `mind_paradise`.`cases` (`id` ),
  CONSTRAINT `case_details_ibfk_2`
    FOREIGN KEY (`consultant_id` )
    REFERENCES `mind_paradise`.`users` (`id` ))
ENGINE = InnoDB
AUTO_INCREMENT = 13
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mind_paradise`.`categories`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mind_paradise`.`categories` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `parentid` INT(11) NULL DEFAULT '0' ,
  `name` VARCHAR(10) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Reference_2` (`parentid` ASC) ,
  CONSTRAINT `FK_Reference_2`
    FOREIGN KEY (`parentid` )
    REFERENCES `mind_paradise`.`categories` (`id` ))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mind_paradise`.`webcontents`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mind_paradise`.`webcontents` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL COMMENT 'author' ,
  `title` VARCHAR(30) NOT NULL ,
  `abstract` VARCHAR(200) NOT NULL ,
  `category` INT(11) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `comment_count` INT(11) NULL DEFAULT '0' COMMENT '璇勮?鏁' ,
  `browse_count` INT(11) NULL DEFAULT '0' COMMENT '娴忚?鏁' ,
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
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mind_paradise`.`recommend_contents`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mind_paradise`.`recommend_contents` ;

CREATE  TABLE IF NOT EXISTS `mind_paradise`.`recommend_contents` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(30) NOT NULL ,
  `abstract` VARCHAR(200) NOT NULL ,
  `picture` VARCHAR(150) NOT NULL ,
  `url` VARCHAR(255) NOT NULL ,
  `listorder` INT(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mind_paradise`.`comments`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mind_paradise`.`comments` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `parent_comment_id` INT(11) NULL DEFAULT NULL ,
  `webcontent_id` INT(11) NULL DEFAULT NULL ,
  `commentor_id` INT(11) NULL DEFAULT NULL ,
  `created` DATETIME NOT NULL ,
  `content` VARCHAR(200) NOT NULL ,
  `commentted_user_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Reference_12` (`webcontent_id` ASC) ,
  INDEX `FK_Reference_13` (`parent_comment_id` ASC) ,
  INDEX `FK_Reference_9` (`commentor_id` ASC) ,
  INDEX `fk_comments_users1` (`commentted_user_id` ASC) ,
  CONSTRAINT `fk_comments_users1`
    FOREIGN KEY (`commentted_user_id` )
    REFERENCES `mind_paradise`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Reference_12`
    FOREIGN KEY (`webcontent_id` )
    REFERENCES `mind_paradise`.`webcontents` (`id` ),
  CONSTRAINT `FK_Reference_13`
    FOREIGN KEY (`parent_comment_id` )
    REFERENCES `mind_paradise`.`comments` (`id` ),
  CONSTRAINT `FK_Reference_9`
    FOREIGN KEY (`commentor_id` )
    REFERENCES `mind_paradise`.`users` (`id` ))
ENGINE = InnoDB
AUTO_INCREMENT = 14
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mind_paradise`.`consultant_profiles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mind_paradise`.`consultant_profiles` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `alias` VARCHAR(45) CHARACTER SET 'gbk' NULL DEFAULT NULL ,
  `realname` VARCHAR(45) CHARACTER SET 'gbk' NULL DEFAULT NULL,
  `age` VARCHAR(45) CHARACTER SET 'gbk' NULL DEFAULT NULL ,
  `gender` VARCHAR(45) CHARACTER SET 'gbk' NULL DEFAULT NULL ,
  `education` VARCHAR(100) CHARACTER SET 'gbk' NULL DEFAULT NULL ,
  `phone` VARCHAR(45) CHARACTER SET 'gbk' NULL DEFAULT NULL ,
  `qq_number` VARCHAR(45) CHARACTER SET 'gbk' NULL DEFAULT NULL ,
  `microblog` VARCHAR(45) CHARACTER SET 'gbk' NULL DEFAULT NULL ,
  `blog` VARCHAR(45) CHARACTER SET 'gbk' NULL DEFAULT NULL ,
  `weixin_number` VARCHAR(45) CHARACTER SET 'gbk' NULL DEFAULT NULL ,
  `personal_information` TEXT CHARACTER SET 'gbk' NULL DEFAULT NULL ,
  `experience` TEXT CHARACTER SET 'gbk' NULL DEFAULT NULL ,
  `profession` TEXT CHARACTER SET 'gbk' NULL DEFAULT NULL ,
  `price` TEXT CHARACTER SET 'gbk' NULL DEFAULT NULL ,
  `avatar` VARCHAR(255) NULL DEFAULT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  `consultant_id` INT(11) NULL DEFAULT NULL ,
  `comment_count` INT(11) NULL DEFAULT '0' ,
  `browse_count` INT(11) NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) ,
  INDEX `consultant_id` (`consultant_id` ASC) ,
  CONSTRAINT `consultant_profiles_ibfk_1`
    FOREIGN KEY (`consultant_id` )
    REFERENCES `mind_paradise`.`users` (`id` ))
ENGINE = InnoDB
AUTO_INCREMENT = 22
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mind_paradise`.`contacts`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mind_paradise`.`contacts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `parent_comment_id` INT(11) NULL DEFAULT NULL ,
  `expert_id` INT(10) UNSIGNED NOT NULL ,
  `commentor_id` INT(11) NULL DEFAULT NULL ,
  `created` DATETIME NOT NULL ,
  `content` VARCHAR(200) NOT NULL ,
  `commentted_user_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `expert_id` (`expert_id` ASC) ,
  INDEX `commentor_id` (`commentor_id` ASC) ,
  INDEX `commentted_user_id` (`commentted_user_id` ASC) ,
  INDEX `parent_comment_id` (`parent_comment_id` ASC) ,
  CONSTRAINT `contacts_ibfk_1`
    FOREIGN KEY (`expert_id` )
    REFERENCES `mind_paradise`.`consultant_profiles` (`id` ),
  CONSTRAINT `contacts_ibfk_2`
    FOREIGN KEY (`commentor_id` )
    REFERENCES `mind_paradise`.`users` (`id` ),
  CONSTRAINT `contacts_ibfk_3`
    FOREIGN KEY (`commentted_user_id` )
    REFERENCES `mind_paradise`.`users` (`id` ),
  CONSTRAINT `contacts_ibfk_4`
    FOREIGN KEY (`parent_comment_id` )
    REFERENCES `mind_paradise`.`contacts` (`id` ))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mind_paradise`.`encyclopedia_entries`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mind_paradise`.`encyclopedia_entries` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `category_id` INT(11) NOT NULL ,
  `user_id` INT(11) NULL DEFAULT NULL COMMENT 'author' ,
  `entry` VARCHAR(10) NOT NULL ,
  `post_time` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `file_path` VARCHAR(100) NOT NULL ,
  `browser_num` INT(11) NULL DEFAULT '0' ,
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
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mind_paradise`.`messages`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mind_paradise`.`messages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL ,
  `type` INT(11) NOT NULL ,
  `abstract` VARCHAR(300) NOT NULL ,
  `link_url` TEXT NOT NULL ,
  `f_read` TINYINT(4) NOT NULL DEFAULT '0' ,
  `created` DATETIME NOT NULL ,
  `link_title` VARCHAR(45) NOT NULL ,
  `trigger_user_id` INT(11) NULL DEFAULT NULL ,
  `trigger_username` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Reference_15` (`user_id` ASC) ,
  CONSTRAINT `FK_Reference_15`
    FOREIGN KEY (`user_id` )
    REFERENCES `mind_paradise`.`users` (`id` ))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mind_paradise`.`search_indices`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mind_paradise`.`search_indices` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `type` INT(11) NOT NULL ,
  `content_id` INT(11) NOT NULL ,
  `content` TEXT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `content_id` (`content_id` ASC) ,
  FULLTEXT INDEX `content` (`content` ASC) ,
  FULLTEXT INDEX `content_2` (`content` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mind_paradise`.`tags`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mind_paradise`.`tags` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `tag` VARCHAR(10) NOT NULL ,
  `viewed_count` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `tag_UNIQUE` (`tag` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mind_paradise`.`tokens`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mind_paradise`.`tokens` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  `token` VARCHAR(32) NULL DEFAULT NULL ,
  `data` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `token` (`token` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mind_paradise`.`user_profiles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mind_paradise`.`user_profiles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL ,
  `avatar` VARCHAR(255) NULL DEFAULT NULL COMMENT '头像' ,
  `first_name` VARCHAR(45) NULL DEFAULT NULL COMMENT '名' ,
  `family_name` VARCHAR(45) NULL DEFAULT NULL COMMENT '姓' ,
  `age` INT(11) NULL DEFAULT NULL COMMENT '年龄' ,
  `gender` TINYINT(4) NULL DEFAULT NULL COMMENT '性别' ,
  `birthplace` VARCHAR(45) NULL DEFAULT NULL COMMENT '出生地点' ,
  `birthday` DATE NULL DEFAULT NULL COMMENT '出生日期' ,
  `profession` VARCHAR(45) NULL DEFAULT NULL COMMENT '职业' ,
  `nationality` VARCHAR(45) NULL DEFAULT NULL COMMENT '民族' ,
  `education` VARCHAR(45) NULL DEFAULT NULL COMMENT '学历' ,
  `finacial_situation` VARCHAR(45) NULL DEFAULT NULL COMMENT '经济状况' ,
  `religion` VARCHAR(45) NULL DEFAULT NULL COMMENT '宗教' ,
  `marital_status` VARCHAR(45) NULL DEFAULT NULL COMMENT '婚姻状况' ,
  `hobby` VARCHAR(45) NULL DEFAULT NULL COMMENT '业余爱好' ,
  `health_condition` VARCHAR(45) NULL DEFAULT NULL COMMENT '健康状况' ,
  `present_address` VARCHAR(45) NULL DEFAULT NULL COMMENT '现住址' ,
  `phone_number` VARCHAR(20) NULL DEFAULT NULL COMMENT '电话号码' ,
  `qq_number` VARCHAR(20) NULL DEFAULT NULL COMMENT 'qq号码' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC) ,
  CONSTRAINT `FK_Reference_18`
    FOREIGN KEY (`user_id` )
    REFERENCES `mind_paradise`.`users` (`id` ))
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mind_paradise`.`webcontents_tags`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mind_paradise`.`webcontents_tags` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `tag_id` INT(11) NOT NULL ,
  `webcontent_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_Reference_11` (`webcontent_id` ASC) ,
  INDEX `FK_Reference_10` (`tag_id` ASC) ,
  CONSTRAINT `FK_Reference_10`
    FOREIGN KEY (`tag_id` )
    REFERENCES `mind_paradise`.`tags` (`id` ),
  CONSTRAINT `FK_Reference_11`
    FOREIGN KEY (`webcontent_id` )
    REFERENCES `mind_paradise`.`webcontents` (`id` ))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
