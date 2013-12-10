
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP TABLE IF EXISTS `taxi_ride` ;
DROP TABLE IF EXISTS `ride` ;
DROP TABLE IF EXISTS `booking` ;
DROP TABLE IF EXISTS `favorites_taxi` ;
DROP TABLE IF EXISTS `favorites_company` ;
DROP TABLE IF EXISTS `taxilocation` ;
DROP TABLE IF EXISTS `address` ;
DROP TABLE IF EXISTS `destination` ;
DROP TABLE IF EXISTS `company` ;
DROP TABLE IF EXISTS `company_period` ;
DROP TABLE IF EXISTS `period` ;
DROP TABLE IF EXISTS `package` ;
DROP TABLE IF EXISTS `taxi_user` ;
DROP TABLE IF EXISTS `taxi` ;
DROP TABLE IF EXISTS `type` ;
DROP TABLE IF EXISTS `usergroup` ;
DROP TABLE IF EXISTS `user` ;
DROP TABLE IF EXISTS `country` ;
DROP TABLE IF EXISTS `city` ;
DROP TABLE IF EXISTS `profile` ;
DROP TABLE IF EXISTS `userpersistence` ;
DROP TABLE IF EXISTS `settings` ;
DROP TABLE IF EXISTS `country_iso` ;
DROP TABLE IF EXISTS `language_iso` ;
DROP TABLE IF EXISTS `language` ;
DROP TABLE IF EXISTS `checkin` ;
DROP TABLE IF EXISTS `coverage` ;
DROP TABLE IF EXISTS `points` ;
DROP TABLE IF EXISTS `prize` ;
DROP TABLE IF EXISTS `badge` ;
DROP TABLE IF EXISTS `badge_earned` ;
DROP TABLE IF EXISTS `subscription` ;


/* DROP VIEWS */
DROP VIEW IF EXISTS `v_userprofile`;
DROP VIEW IF EXISTS `v_company`;
/*DROP VIEW IF EXISTS `v_badge`;
DROP VIEW IF EXISTS `v_badge_earned`;
DROP VIEW IF EXISTS `v_ads`;
DROP VIEW IF EXISTS `v_badge_stats`;
DROP VIEW IF EXISTS `v_notification`;
DROP VIEW IF EXISTS `v_order_detail_total`;
DROP VIEW IF EXISTS `v_orders`;
DROP VIEW IF EXISTS `v_order_detail`;
DROP VIEW IF EXISTS `v_farmacorp_reportall`;
DROP VIEW IF EXISTS `v_farmacorp_credits`;
DROP VIEW IF EXISTS `v_farmacorp_inactive`;
*/
SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


-- -----------------------------------------------------
-- Table `type`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `type` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `code` VARCHAR(10) NOT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `usergroup`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `usergroup` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `homepage` VARCHAR(255) NOT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `gid` INT(11) NOT NULL ,
  `idfacebook` INT(20) NULL ,
  `username` VARCHAR(255) NOT NULL ,
  `password` VARCHAR(255) NOT NULL ,
  `activation_code` VARCHAR(255) NULL DEFAULT NULL ,
  `activation_expires` VARCHAR(255) NULL DEFAULT NULL ,
  `status` TINYINT(1) NOT NULL DEFAULT '0' ,
  `expiration` TIMESTAMP NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  INDEX `username` (`username` ASC) ,
  INDEX `fk_user_usergroup_idx` (`gid` ASC) ,
  INDEX `fk_user_idfacebook` (`idfacebook` ASC) ,
  CONSTRAINT `fk_user_usergroup`
    FOREIGN KEY (`gid` )
    REFERENCES `usergroup` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `country`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `country` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `code` VARCHAR(2) NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `cod_UNIQUE` (`code` ASC) )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `city`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `city` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `code` VARCHAR(3) NOT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  `uri` VARCHAR(100) NOT NULL ,
  `lat` DECIMAL(20,10) NOT NULL DEFAULT -17.383283,
  `lng` DECIMAL(20,10) NOT NULL DEFAULT -66.160238,
  `idcountry` INT(10) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_city_country1_idx` (`idcountry` ASC) ,
  CONSTRAINT `fk_city_country1`
    FOREIGN KEY (`idcountry` )
    REFERENCES `country` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `address`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `address` (
	`id` INT(10) NOT NULL AUTO_INCREMENT ,
	`uid` INT(11) NOT NULL ,
  	`lat` VARCHAR(255) NOT NULL ,
	`lng` VARCHAR(255) NOT NULL ,
	`address1` VARCHAR(255) NOT NULL ,
	`address2` VARCHAR(255) NULL ,
	`phone` VARCHAR(255) NULL ,
	`extension` VARCHAR(10) NULL ,
	`idcity` INT(10) NOT NULL ,
	`state` VARCHAR(255) NULL ,
	`zip` VARCHAR(255) NULL ,
	`main` SMALLINT(1) NOT NULL DEFAULT 1 COMMENT 'the first is main' ,
	`status` SMALLINT(1) NOT NULL DEFAULT 0 COMMENT '0:unverified-1:verified' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_address_user1_idx` (`uid` ASC) ,
  INDEX `fk_address_city1_idx` (`idcity` ASC) ,
  CONSTRAINT `fk_address_user1`
    FOREIGN KEY (`uid` )
    REFERENCES `user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_address_city1`
    FOREIGN KEY (`idcity` )
    REFERENCES `city` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `destination`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `destination` (
	`id` INT(10) NOT NULL AUTO_INCREMENT ,
	`uid` INT(11) NOT NULL ,
  	`lat` VARCHAR(255) NOT NULL ,
	`lng` VARCHAR(255) NOT NULL ,
	`address1` VARCHAR(255) NOT NULL ,
	`address2` VARCHAR(255) NULL ,
	`phone` VARCHAR(255) NULL ,
	`extension` VARCHAR(10) NULL ,
	`idcity` INT(10) NOT NULL ,
	`state` VARCHAR(255) NULL ,
	`zip` VARCHAR(255) NULL ,
	`status` SMALLINT(1) NOT NULL DEFAULT 0 COMMENT '0:invalid-1:valid' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_destination_user1_idx` (`uid` ASC) ,
  INDEX `fk_destination_city1_idx` (`idcity` ASC) ,
  CONSTRAINT `fk_destination_user1`
    FOREIGN KEY (`uid` )
    REFERENCES `user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_destination_city1`
    FOREIGN KEY (`idcity` )
    REFERENCES `city` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `company`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `company` (
	`id` INT(10) NOT NULL AUTO_INCREMENT ,
	`uid` INT(11) NOT NULL ,
	`cod` VARCHAR(10) NULL ,
	`name` VARCHAR(255) NOT NULL ,
	`uri` VARCHAR(255) NOT NULL ,
	`desc` VARCHAR(255) NOT NULL ,
	`slogan` VARCHAR(255) NOT NULL DEFAULT 'El Mejor RadioTaxi de la Ciudad',
	`rating` DECIMAL(10,2) NOT NULL DEFAULT 5.0 COMMENT 'rating stars' ,
	`logo` VARCHAR(255) NULL COMMENT 'logo image filename' ,
	`banner` VARCHAR(255) NULL COMMENT 'banner image filename' ,
	`status` SMALLINT(1) NULL COMMENT '0:disable-1:enable' ,
    `email` VARCHAR(255) NULL ,
	`phone` VARCHAR(255) NULL ,
	`website` VARCHAR(255) NULL ,
	`facebook` VARCHAR(255) NULL ,
	`twitter` VARCHAR(255) NULL ,
	`numtaxis` INT(11) NOT NULL DEFAULT 1,
	`internet` SMALLINT(1) NULL DEFAULT 0 COMMENT '0:no-1:yes' ,
	`contact_name` VARCHAR(255) NOT NULL ,
	`contact_email` VARCHAR(255) NULL ,
	`contact_phone` VARCHAR(255) NULL ,
	`contact_mobile` VARCHAR(255) NULL ,
	`contact_position` VARCHAR(255) NULL ,
	`idcity` INT(10) NOT NULL ,
	`lat` DECIMAL(20,10) NOT NULL DEFAULT -17.383283,
	`lng` DECIMAL(20,10) NOT NULL DEFAULT -66.160238,
  PRIMARY KEY (`id`) ,
  INDEX `fk_company_user1_idx` (`uid` ASC) ,
  INDEX `fk_company_name_idx` (`name` ASC) ,
  INDEX `fk_company_uri_idx` (`uri` ASC) ,
  INDEX `fk_company_city1_idx` (`idcity` ASC) ,
  CONSTRAINT `fk_company_city1_idx`
	FOREIGN KEY (`idcity` )
	REFERENCES `city` (`id` )
	ON DELETE NO ACTION
	ON UPDATE NO ACTION,
  CONSTRAINT `fk_company_user1_idx`
    FOREIGN KEY (`uid` )
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `taxi`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `taxi` (
	`id` INT(10) NOT NULL AUTO_INCREMENT ,
	`uid` INT(11) NOT NULL ,
	`plate` VARCHAR(255) NOT NULL ,
	`uri` VARCHAR(255) NOT NULL ,
	`desc` VARCHAR(255) NOT NULL ,
	`rating` DECIMAL(11,1) NOT NULL DEFAULT 0.0 COMMENT 'rating stars' ,
	`taxiphoto` VARCHAR(255) NULL COMMENT 'taxi photo image filename' ,
	`taxicolor` VARCHAR(255) NULL COMMENT 'taxi color' ,
	`lat` DECIMAL(20,10) NOT NULL DEFAULT -17.770511,
	`lng` DECIMAL(20,10) NOT NULL DEFAULT -63.18257,
	`idcity` INT(10) NOT NULL ,
	`status` SMALLINT(1) NULL COMMENT '0:disable-1:enable' ,
	`number` INT(10) NULL,
	`created` TIMESTAMP NULL,
	`updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) ,
  INDEX `fk_taxi_city1_idx` (`idcity` ASC) ,
  INDEX `fk_taxi_user1_idx` (`uid` ASC) ,
  CONSTRAINT `fk_taxi_city1_idx`
	FOREIGN KEY (`idcity` )
	REFERENCES `city` (`id` )
	ON DELETE NO ACTION
	ON UPDATE NO ACTION,
  CONSTRAINT `fk_taxi_user1`
    FOREIGN KEY (`uid` )
    REFERENCES `user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `taxilocation`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `taxilocation` (
	`idtaxi` INT(11) NOT NULL,
	`lat` DECIMAL(20,10) NOT NULL DEFAULT -17.383283,
	`lng` DECIMAL(20,10) NOT NULL DEFAULT -66.160238,
	`created` TIMESTAMP NULL,
	`updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `booking` Solicitud TAXI O COMPANIA
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `booking` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `idadd` INT(10) NOT NULL,
  `iddest` INT(10) NULL,
  `idcomp` INT(10) NULL,
  `idtaxi` INT(10) NULL,
  `type` SMALLINT(1) NOT NULL DEFAULT 1 COMMENT '1:taxi-2:company' ,
  `comments` TEXT NULL,
  `estimated` TIME NULL,
  `status` SMALLINT(1) NOT NULL DEFAULT 0 COMMENT '-1:canceled-0:requested-1:progress-2:attended' ,
  `created` TIMESTAMP NULL,
  `updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) ,
  INDEX `fk_booking_address_idx` (`idadd` ASC) ,
  INDEX `fk_booking_destination_idx` (`iddest` ASC) ,
  INDEX `fk_booking_company_idx` (`idcomp` ASC) ,
  INDEX `fk_booking_taxi_idx` (`idtaxi` ASC) ,
  CONSTRAINT `fk_booking_address`
    FOREIGN KEY (`idadd` )
    REFERENCES `address` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_booking_destination`
    FOREIGN KEY (`iddest` )
    REFERENCES `destination` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_booking_company`
    FOREIGN KEY (`idcomp` )
    REFERENCES `company` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_booking_taxi`
    FOREIGN KEY (`idtaxi` )
    REFERENCES `taxi` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION	)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `favorites` FAVORITOS TAXI
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `favorites_taxi` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `uid` INT(10) NULL,
  `idtaxi` INT(10) NULL,
  `created` TIMESTAMP NULL,
  `updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) ,
  INDEX `fk_favorites_taxi_idx` (`idtaxi` ASC) ,
  CONSTRAINT `fk_favorites_taxi_idx`
    FOREIGN KEY (`idtaxi` )
    REFERENCES `taxi` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION	)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `favorites` FAVORITOS RADIOTAXI
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `favorites_company` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `uid` INT(10) NULL,
  `idcomp` INT(10) NULL,
  `created` TIMESTAMP NULL,
  `updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) ,
  INDEX `fk_favorites_comp_idx` (`idcomp` ASC) ,
  CONSTRAINT `fk_favorites_comp_idx`
    FOREIGN KEY (`idcomp` )
    REFERENCES `company` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION	)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table  `ride` CARRERA
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ride` (
  `idtaxi` INT(10) NOT NULL ,
  `idbook` INT(10) NOT NULL ,
  `estimated` TIME NOT NULL DEFAULT 10 COMMENT 'estimated time of progress' ,
  `obs` TEXT NULL ,
  `price` DECIMAL(10,2) NOT NULL DEFAULT 1,
  `currency` VARCHAR(3) NOT NULL ,
  `extra_price` DECIMAL(10,2) NULL ,
  `total` DECIMAL(10,2) NULL ,
  `status` SMALLINT(1) NOT NULL DEFAULT 0 COMMENT '-1:canceled;0:accepted;1:progress;2:attended' ,
  `created` TIMESTAMP NULL,
  `updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idtaxi`, `idbook`) ,
  INDEX `fk_ride_taxi_idx` (`idtaxi` ASC) ,
  INDEX `fk_ride_booking_idx` (`idbook` ASC) ,
  CONSTRAINT `fk_ride_taxi`
    FOREIGN KEY (`idtaxi` )
    REFERENCES `taxi` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ride_booking`
    FOREIGN KEY (`idbook` )
    REFERENCES `booking` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `taxi_user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `taxi_user` (
	`idtaxi` INT(10) NOT NULL ,
	`uid` INT(10) NOT NULL ,
	`status` SMALLINT(1) NOT NULL DEFAULT 1 COMMENT '0:disable-1:enable' ,
	PRIMARY KEY (`idtaxi`,`uid`),
	INDEX `fk_taxi_user_taxi_idx` (`idtaxi` ASC) ,
	INDEX `fk_taxi_user_user_idx` (`uid` ASC) ,
  CONSTRAINT `fk_taxi_user_taxi_idx`
    FOREIGN KEY (`idtaxi` )
    REFERENCES `taxi` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_taxi_user_user_idx`
    FOREIGN KEY (`uid` )
    REFERENCES `user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
 ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `profile`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `profile` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` INT(11) NOT NULL ,
  `firstname` VARCHAR(255) NOT NULL ,
  `lastname` VARCHAR(255) NOT NULL ,
  `gender` SMALLINT(1) NULL ,
  `document` VARCHAR(100) NULL COMMENT 'number or code of ci, dni, css, etc' ,
  `typedoc` VARCHAR(50) NULL COMMENT 'ci, dni, css, etc' ,
  `email` VARCHAR(255) NOT NULL ,
  `company` VARCHAR(255) NULL DEFAULT NULL ,
  `mobile` VARCHAR(255) NULL ,
  `avatar` VARCHAR(255) NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `idcountry` INT(10) NOT NULL ,
  `idcity` INT(10) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_profile_city1_idx` (`idcity` ASC) ,
  INDEX `fk_profile_user_idx` (`uid` ASC) ,
  INDEX `fk_profile_country_idx` (`idcountry` ASC) ,
  CONSTRAINT `fk_profile_city1`
	FOREIGN KEY (`idcity` )
	REFERENCES `city` (`id` )
	ON DELETE NO ACTION
	ON UPDATE NO ACTION,
  CONSTRAINT `fk_profile_country`
    FOREIGN KEY (`idcountry` )
    REFERENCES `country` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_profile_user`
    FOREIGN KEY (`uid` )
    REFERENCES `user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `userpersistence`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `userpersistence` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` INT(11) NOT NULL ,
  `ip` VARCHAR(255) NOT NULL ,
  `unique_id` VARCHAR(255) NOT NULL ,
  `time` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_userpersistence_user_idx` (`uid` ASC) ,
  CONSTRAINT `fk_userpersistence_user`
    FOREIGN KEY (`uid` )
    REFERENCES `user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `settings`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `settings` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `admin_email` VARCHAR(255) NOT NULL ,
  `notification_email` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `country_iso`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `country_iso` (
  `name` VARCHAR(2) NOT NULL ,
  `fullname` VARCHAR(100) NULL DEFAULT NULL ,
  `prefix` VARCHAR(4) NULL DEFAULT NULL ,
  `currency` VARCHAR(3) NULL DEFAULT NULL ,
  PRIMARY KEY (`name`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `language_iso`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `language_iso` (
  `short` VARCHAR(2) NOT NULL ,
  `name` VARCHAR(255) NOT NULL ,
  `nameen` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`short`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `language`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `language` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `short` VARCHAR(2) NOT NULL ,
  `name` VARCHAR(50) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `checkin`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `checkin` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `uid` INT(11) NOT NULL ,
  `lat` DECIMAL(20,10) NOT NULL ,
  `lng` DECIMAL(20,10) NOT NULL ,
  `title` VARCHAR(255) NULL ,
  `desc` VARCHAR(255) NULL ,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_checkin_user1_idx` (`uid` ASC) ,
  CONSTRAINT `fk_checkin_user1`
    FOREIGN KEY (`uid` )
    REFERENCES `user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'checink user';

-- -----------------------------------------------------
-- Table `coverage`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `coverage` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `radio` DECIMAL(10,2) NOT NULL ,
  `idtaxi` INT(10) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_limit_taxi1_idx` (`idtaxi` ASC) ,
  CONSTRAINT `fk_limit_taxi1`
    FOREIGN KEY (`idtaxi` )
    REFERENCES `taxi` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `points`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `points` (
  `id` INT NOT NULL ,
  `uid` INT(11) NOT NULL ,
  `quantity` VARCHAR(45) NULL ,
  `expiration` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_points_user1_idx` (`uid` ASC) ,
  CONSTRAINT `fk_points_user1`
    FOREIGN KEY (`uid` )
    REFERENCES `user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `prize`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prize` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `desc` VARCHAR(255) NULL ,
  `status` SMALLINT(1) NULL ,
  `quantity` INT(11) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `badge`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `badge` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `cod` VARCHAR(10) NOT NULL ,
  `name` VARCHAR(255) NOT NULL ,
  `message` VARCHAR(255) NOT NULL ,
  `desc` VARCHAR(255) NULL ,
  `filename` VARCHAR(255) NULL ,
  `question` VARCHAR(255) NULL ,
  `status` SMALLINT(1) NOT NULL DEFAULT 1 COMMENT '1: active - 0: inactive' ,
  `created` TIMESTAMP NULL ,
  `updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `idprize` INT(10) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_badge_prizes1` (`idprize` ASC) ,
  CONSTRAINT `fk_badge_prizes1`
    FOREIGN KEY (`idprize` )
    REFERENCES `prize` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `badge_earned`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `badge_earned` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `rating` DECIMAL(10,2) NOT NULL ,
  `notes` VARCHAR(255) NULL ,
  `status` SMALLINT(1) NOT NULL COMMENT '1: unlocked - 0: locked' ,
  `idbadge` INT(10) NOT NULL ,
  `uid` INT(11) NOT NULL ,
  `created` TIMESTAMP NULL ,
  `updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_badge_earned_badge1` (`idbadge` ASC) ,
  INDEX `fk_badge_earned_user1` (`uid` ASC) ,
  CONSTRAINT `fk_badge_earned_badge1`
    FOREIGN KEY (`idbadge` )
    REFERENCES `badge` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_badge_earned_user1`
    FOREIGN KEY (`uid` )
    REFERENCES `user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `package`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `package` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `code` VARCHAR(10) NOT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  `desc` TEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `period`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `period` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `idpkg` INT(11) NOT NULL ,
  `name` VARCHAR(255) NOT NULL ,
  `qtydays` INT(10) NOT NULL DEFAULT 0,
  `pricebs` DECIMAL(10,2) NOT NULL ,
  `priceus` DECIMAL(10,2) NOT NULL ,
  `commission` DECIMAL(10,2) NULL ,
  `off` DECIMAL(10,2) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_period_package_idx` (`idpkg` ASC) ,
  CONSTRAINT `fk_period_package`
    FOREIGN KEY (`idpkg` )
    REFERENCES `package` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `company_period`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `company_period` (
  `idcomp` INT(10) NOT NULL ,
  `idper` INT(10) NOT NULL ,
  `status` SMALLINT(1) NOT NULL DEFAULT 1 COMMENT '0:disable-1:enable' ,
  PRIMARY KEY (`idcomp`, `idper`) ,
  INDEX `fk_restaurant_period_company_idx` (`idcomp` ASC) ,
  INDEX `fk_restaurant_period_period1_idx` (`idper` ASC) ,
  CONSTRAINT `fk_restaurant_period_company`
    FOREIGN KEY (`idcomp` )
    REFERENCES `company` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_restaurant_period_period1`
    FOREIGN KEY (`idper` )
    REFERENCES `period` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'period of subscription';

-- -----------------------------------------------------
-- Table `subscription`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `subscription` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(255) NOT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  `message` TEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0;
SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0;
SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'TRADITIONAL';

/*
*****************************
CREATE VIEWS
*****************************
*/

-- -----------------------------------------------------
-- View `v_usersprofile`
-- -----------------------------------------------------

CREATE OR REPLACE VIEW v_userprofile AS
  SELECT
    u.id                                   AS selected,
    p.id,
    p.uid,
    CONCAT(p.firstname, ' ', p.lastname)   AS name,
    p.email,
    c.name                                 AS country,
    p.company,
    (CASE WHEN u.activation_code = "" THEN 'Yes'
     WHEN u.activation_code IS NULL THEN 'Yes'
     ELSE 'No' END)                        AS activated,
    (CASE WHEN u.status = 1 THEN 'Approved'
     WHEN u.status = 0 THEN 'Blocked' END) AS status,
    p.created                              AS signupdate,
    u.gid                                  AS gid
  FROM profile p
    LEFT JOIN country c
      ON p.idcountry = c.id
    LEFT JOIN user u
      ON u.id = p.uid
  WHERE p.uid != 1
  GROUP BY p.uid
  ORDER BY p.id;

-- -----------------------------------------------------
-- View `v_company`
-- -----------------------------------------------------
CREATE OR REPLACE VIEW v_company AS
  SELECT
    c.id                                   AS selected,
    c.id,
    c.uid,
    c.name,
    c.uri,
    c.desc,
    c.slogan,
    c.rating,
    c.logo,
    c.numtaxis,
    c.lat,
    c.lng,
    c.email,
    (CASE WHEN c.status = 1 THEN 'Approved'
     WHEN c.status = 0 THEN 'Blocked' END) AS status
  FROM company c;

-- -----------------------------------------------------
-- View `v_booking`
-- -----------------------------------------------------
CREATE OR REPLACE VIEW v_booking AS
  SELECT
    b.id                                 AS selected,
    b.*,
    CONCAT(a.address1, ' ', a.address2)  AS fulladdress,
    a.lat                                AS addlat,
    a.lng                                AS addlng,
    CONCAT(p.lastname, ' ', p.firstname) AS fullname,
    CONCAT(d.address1, ' ', d.address2)  AS fulldestination,
    d.lat                                AS destlat,
    d.lng                                AS destlng,
    t.`number`                           AS `number`
  FROM `booking` b
    JOIN `address` a
      ON b.idadd = a.id
    JOIN `profile` p
      ON a.uid = p.uid
    LEFT JOIN `destination` d
      ON b.iddest = d.id
    LEFT JOIN `taxi` `t`
      ON `b`.`idtaxi` = `t`.`id`;

-- -----------------------------------------------------
-- View `v_taxi`
-- -----------------------------------------------------
CREATE OR REPLACE VIEW v_taxi AS
  SELECT
    t.id        AS selected,
    t.id        AS id,
    t.uid       AS uid,
    t.plate     AS plate,
    t.uri       AS uri,
    t.desc      AS 'desc',
    t.rating    AS rating,
    t.taxiphoto AS taxiphoto,
    t.taxicolor AS taxicolor,
    t.lat       AS lat,
    t.lng       AS lng,
    t.idcity    AS idcity,
    t.status    AS status,
    t.created   AS created,
    t.updated   AS updated,
    t.number    AS number
  FROM taxi t;


-- -----------------------------------------------------
-- View `v_addresstaxi`
-- -----------------------------------------------------
CREATE OR REPLACE VIEW v_addresstaxi AS
  SELECT
    t.id                                 AS selected,
    t.id                                 AS id,
    t.uid                                AS uid,
    t.plate                              AS plate,
    t.uri                                AS uri,
    t.desc                               AS description,
    t.rating                             AS rating,
    t.taxiphoto                          AS taxiphoto,
    t.taxicolor                          AS taxicolor,
    t.lat                                AS lat,
    t.lng                                AS lng,
    t.idcity                             AS idcity,
    t.status                             AS status,
    t.created                            AS created,
    t.updated                            AS updated,
    t.number                             AS number,
    CONCAT(p.lastname, ' ', p.firstname) AS fullname,
    p.avatar                             AS avatar
  FROM taxi t
    JOIN profile p
      ON p.uid = t.uid;
-- -----------------------------------------------------
-- View `v_address`
-- -----------------------------------------------------

CREATE OR REPLACE VIEW v_address AS
  SELECT
    a.id                                 AS selected,
    a.id                                 AS id1,
    a.id                                 AS id,
    a.uid                                AS uid,
    a.lat                                AS lat,
    a.lng                                AS lng,
    a.address1                           AS fulladdress,
    a.phone                              AS phone,
    a.main                               AS main,
    a.status                             AS status,
    CONCAT(p.lastname, ' ', p.firstname) AS fullname
  FROM address a
    INNER JOIN profile p
      ON a.uid = p.uid;

-- -----------------------------------------------------
-- View `v_addressbooking`
-- -----------------------------------------------------

CREATE OR REPLACE VIEW v_addressbooking AS
  SELECT
    a.id                                 AS selected,
    a.id                                 AS id1,
    a.id                                 AS id,
    a.uid                                AS uid,
    a.lat                                AS lat,
    a.lng                                AS lng,
    a.address1                           AS fulladdress,
    a.phone                              AS phone,
    a.main                               AS main,
    a.status                             AS status,
    CONCAT(p.lastname, ' ', p.firstname) AS fullname
  FROM address a
    INNER JOIN profile p
      ON a.uid = p.uid

/*
*****************************
TESTING INITIAL DATA
*****************************
*/

--
-- Dumping data for table `usergroup`
--

INSERT INTO `usergroup` (`id`, `name`, `homepage`, `created`, `updated`) VALUES
(1, 'Admin', '/admin/dashboard', NOW(), NOW()),
(2, 'Client', '/welcome', NOW(), NOW()),
(3, 'Company', '/taxi/dashboard', NOW(), NOW()),
(4, 'Driver', '/driver/dashboard', NOW(), NOW());


--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `gid`, `idfacebook`, `username`, `password`, `activation_code`, `activation_expires`, `status`, `expiration`, `created`, `updated`) VALUES
(1, 1, NULL, 'admin', 'bee9cef7c5d90536144a57bcb6fdf6be61703a414b09ae0d99', NULL, NULL, 1, NULL, '2011-05-07 10:39:03', '2011-12-07 10:39:03'),
(2, 2, NULL, 'testuser1', 'bee9cef7c5d90536144a57bcb6fdf6be61703a414b09ae0d99', NULL, NULL, 1, NULL, '2011-05-07 10:39:03', '2011-12-07 10:39:03'),
(3, 2, NULL, 'testuser2', 'bee9cef7c5d90536144a57bcb6fdf6be61703a414b09ae0d99', NULL, NULL, 1, NULL, '2011-06-17 10:39:03', '2011-12-07 10:39:03'),
(4, 3, NULL, 'jardin', 'bee9cef7c5d90536144a57bcb6fdf6be61703a414b09ae0d99', NULL, NULL, 1, NULL, '2011-12-07 10:39:03', '2011-12-07 10:39:03'),
(5, 4, NULL, 'driver', 'bee9cef7c5d90536144a57bcb6fdf6be61703a414b09ae0d99', NULL, NULL, 1, NULL, '2011-12-07 10:39:03', '2011-12-07 10:39:03');

--
-- Dumping data for table `badge`
--
INSERT INTO `prize` (`id`, `name`, `desc`, `status`, `quantity`) VALUES
(1, 'First Prize', 'First Prize', 1, 100);


--
-- Dumping data for table `country`
--
INSERT INTO `country` (`id`, `code`, `name`) VALUES
(1, 'BO', 'Bolivia');

--
-- Dumping data for table `country_iso`
--

INSERT INTO `country_iso` (`name`, `fullname`, `prefix`, `currency`) VALUES
('AD', 'Andorra', '376', 'EUR'),
('AE', 'United Arab Emirates', '971', 'AED'),
('AF', 'Afghanistan', '93', 'AFA'),
('AG', 'Antigua And Barbuda', '126', 'XCD'),
('AI', 'Anguilla', '126', 'XCD'),
('AL', 'Albania', '355', 'ALL'),
('AM', 'Armenia', '374', 'AMD'),
('AN', 'Netherlands Antilles', '599', 'ANG'),
('AO', 'Angola', '244', 'AOK'),
('AQ', 'Antarctica', '672', 'BOB'),
('AR', 'Argentina', '54', 'ARP'),
('AS', 'American Samoa', '684', 'EUR'),
('AT', 'Austria', '43', 'EUR'),
('AU', 'Australia', '61', 'AUD'),
('AW', 'Aruba', '297', 'ANG'),
('AZ', 'Azerbaijan', '994', 'AZM'),
('BA', 'Bosnia and Herzegovina', '387', 'BAK'),
('BB', 'Barbados', '124', 'BBD'),
('BD', 'Bangladesh', '880', 'BDT'),
('BE', 'Belgium', '32', 'EUR'),
('BF', 'Burkina Faso', '226', 'XOF'),
('BG', 'Bulgaria', '359', 'BGL'),
('BH', 'Bahrain', '973', 'BHD'),
('BI', 'Burundi', '257', 'BIF'),
('BJ', 'Benin', '229', 'XOF'),
('BM', 'Bermuda', '144', 'BMD'),
('BN', 'Brunei Darussalam', '673', 'BND'),
('BO', 'Bolivia', '591', 'BOB'),
('BR', 'Brazil', '55', 'BRR'),
('BS', 'Bahamas', '124', 'BSD'),
('BT', 'Bhutan', '975', 'INR'),
('BV', 'Bouvet Island', '591', 'NOK'),
('BW', 'Botswana', '267', 'BWP'),
('BZ', 'Belize', '501', 'BZD'),
('CA', 'Canada', '1', 'CAD'),
('CC', 'Cocos (Keeling) Islands', '61', 'AUD'),
('CF', 'Central African Republic', '236', 'XAF'),
('CH', 'Switzerland', '41', 'CHF'),
('CK', 'Cook Islands', '682', 'NZD'),
('CL', 'Chile', '56', 'CLP'),
('CM', 'Cameroon', '237', 'XAF'),
('CN', 'China', '86', 'CNY'),
('CO', 'Colombia', '57', 'COP'),
('CR', 'Costa Rica', '506', 'CRC'),
('CV', 'Cape Verde', '238', 'CVE'),
('CX', 'Christmas Island', '61', 'AUD'),
('CY', 'Cyprus', '357', 'CYP'),
('CZ', 'Czech Republic', '420', 'CSK'),
('DE', 'Germany', '49', 'EUR'),
('DJ', 'Djibouti', '253', 'DJF'),
('DK', 'Denmark', '45', 'DKK'),
('DM', 'Dominica', '176', 'XCD'),
('DO', 'Dominican Republic', '180', 'DOP'),
('DZ', 'Algeria', '213', 'DZD'),
('EC', 'Ecuador', '593', 'ECS'),
('EE', 'Estonia', '372', 'EEK'),
('EG', 'Egypt', '20', 'EGP'),
('EH', 'Western Sahara', '212', 'MAD'),
('ER', 'Eritrea', '291', 'ETB'),
('ES', 'Spain', '34', 'EUR'),
('ET', 'Ethiopia', '251', 'ETB'),
('FI', 'Finland', '358', 'EUR'),
('FJ', 'Fiji', '679', 'FJD'),
('FK', 'Falkland Islands (Malvinas)', '500', 'FKP'),
('FM', 'Micronesia, Federated States Of', '691', 'USD'),
('FO', 'Faroe Islands', '298', 'DKK'),
('FR', 'France', '33', 'EUR'),
('FX', 'France, Metropolitan', '591', 'BOB'),
('GA', 'Gabon', '241', 'XAF'),
('GB', 'United Kingdom', '44', 'GBP'),
('GD', 'Grenada', '147', 'XCD'),
('GE', 'Georgia', '995', 'GEL'),
('GF', 'French Guiana', '594', 'EUR'),
('GH', 'Ghana', '233', 'GHC'),
('GI', 'Gibraltar', '350', 'GIP'),
('GL', 'Greenland', '299', 'DKK'),
('GM', 'Gambia', '220', 'GMD'),
('GN', 'Guinea', '224', 'GNF'),
('GP', 'Guadeloupe', '590', 'EUR'),
('GQ', 'Equatorial Guinea', '240', 'XAF'),
('GR', 'Greece', '30', 'EUR'),
('GS', 'S. Georgia &amp; S. Sandwich Isls.', '591', 'GBP'),
('GT', 'Guatemala', '502', 'GTQ'),
('GU', 'Guam', '167', 'USD'),
('GW', 'Guinea-Bissau', '245', 'XOF'),
('GY', 'Guyana', '592', 'GYD'),
('HK', 'Hong Kong SAR, PRC', '852', 'HKD'),
('HM', 'Heard And Mc Donald Islands', '591', 'AUD'),
('HN', 'Honduras', '504', 'HNL'),
('HR', 'Croatia (Hrvatska)', '385', 'HRK'),
('HT', 'Haiti', '509', 'HTG'),
('HU', 'Hungary', '36', 'HUF'),
('ID', 'Indonesia', '62', 'IDR'),
('IE', 'Ireland', '353', 'EUR'),
('IL', 'Israel', '972', 'ILS'),
('IN', 'India', '91', 'INR'),
('IO', 'British Indian Ocean Territory', '246', 'USD'),
('IS', 'Iceland', '354', 'ISK'),
('IT', 'Italy', '39', 'EUR'),
('JM', 'Jamaica', '187', 'JMD'),
('JO', 'Jordan', '962', 'JOD'),
('JP', 'Japan', '81', 'JPY'),
('KE', 'Kenya', '254', 'KES'),
('KG', 'Kyrgyzstan', '996', 'KGS'),
('KH', 'Cambodia', '855', 'KHR'),
('KI', 'Kiribati', '686', 'AUD'),
('KM', 'Comoros', '269', 'KMF'),
('KN', 'Saint Kitts And Nevis', '186', 'XCD'),
('KR', 'Korea, Republic of', '82', 'KRW'),
('KW', 'Kuwait', '965', 'KWD'),
('KY', 'Cayman Islands', '134', 'KYD'),
('KZ', 'Kazakhstan', '7', 'KZT'),
('LA', 'Lao, People''s Dem. Rep.', '856', 'LAK'),
('LB', 'Lebanon', '961', 'LBP'),
('LC', 'Saint Lucia', '175', 'XCD'),
('LI', 'Liechtenstein', '41', 'CHF'),
('LK', 'Sri Lanka', '94', 'LKR'),
('LS', 'Lesotho', '266', 'LSL'),
('LT', 'Lithuania', '370', 'LTL'),
('LU', 'Luxembourg', '352', 'EUR'),
('LV', 'Latvia', '371', 'LVL'),
('LY', 'Libya', '218', 'LYD'),
('MA', 'Morocco', '212', 'MAD'),
('MC', 'Monaco', '377', 'EUR'),
('MD', 'Moldova, Republic Of', '373', 'MDL'),
('ME', 'Montenegro', '591', 'BOB'),
('MG', 'Madagascar', '261', 'MGF'),
('MH', 'Marshall Islands', '692', 'USD'),
('MK', 'Macedonia', '389', 'MKD'),
('ML', 'Mali', '223', 'XOF'),
('MN', 'Mongolia', '976', 'MNT'),
('MO', 'Macau', '853', 'MOP'),
('MP', 'Northern Mariana Islands', '167', 'USD'),
('MQ', 'Martinique', '596', 'EUR'),
('MR', 'Mauritania', '222', 'MRO'),
('MS', 'Montserrat', '166', 'XCD'),
('MT', 'Malta', '356', 'MTL'),
('MU', 'Mauritius', '230', 'MUR'),
('MV', 'Maldives', '960', 'MVR'),
('MW', 'Malawi', '265', 'MWK'),
('MX', 'Mexico', '52', 'MXP'),
('MY', 'Malaysia', '60', 'MYR'),
('MZ', 'Mozambique', '258', 'MZM'),
('NA', 'Namibia', '264', 'NAD'),
('NC', 'New Caledonia', '687', 'XPF'),
('NE', 'Niger', '227', 'XOF'),
('NF', 'Norfolk Island', '672', 'AUD'),
('NG', 'Nigeria', '234', 'NGN'),
('NI', 'Nicaragua', '505', 'NIO'),
('NL', 'Netherlands', '31', 'EUR'),
('NO', 'Norway', '47', 'NOK'),
('NP', 'Nepal', '977', 'NPR'),
('NR', 'Nauru', '674', 'AUD'),
('NU', 'Niue', '683', 'NZD'),
('NZ', 'New Zealand', '64', 'NZD'),
('OM', 'Oman', '968', 'OMR'),
('OT', 'Others', '591', 'BOB'),
('PA', 'Panama', '507', 'PAB'),
('PE', 'Peru', '51', 'PEN'),
('PF', 'French Polynesia', '689', 'XPF'),
('PG', 'Papua New Guinea', '675', 'PGK'),
('PH', 'Philippines', '63', 'PHP'),
('PK', 'Pakistan', '92', 'PKR'),
('PL', 'Poland', '48', 'PLZ'),
('PM', 'St. Pierre And Miquelon', '508', 'BOB'),
('PN', 'Pitcairn', '872', 'NZD'),
('PR', 'Puerto Rico', '1', 'USD'),
('PS', 'Palestine', '970', 'BOB'),
('PT', 'Portugal', '351', 'EUR'),
('PW', 'Palau', '680', 'USD'),
('PY', 'Paraguay', '595', 'PYG'),
('QA', 'Qatar', '974', 'QAR'),
('RE', 'Reunion', '262', 'EUR'),
('RO', 'Romania', '40', 'ROL'),
('RS', 'Serbia', '591', 'BOB'),
('RU', 'Russia', '7', 'RUR'),
('RW', 'Rwanda', '250', 'RWF'),
('SA', 'Saudi Arabia', '966', 'SAR'),
('SB', 'Solomon Islands', '677', 'SBD'),
('SC', 'Seychelles', '248', 'SCR'),
('SE', 'Sweden', '46', 'SEK'),
('SG', 'Singapore', '65', 'SGD'),
('SH', 'St. Helena', '290', 'BOB'),
('SI', 'Slovenia', '386', 'EUR'),
('SJ', 'Svalbard And Jan Mayen Islands', '79', 'NOK'),
('SK', 'Slovak Republic', '421', 'SKK'),
('SL', 'Sierra Leone', '232', 'SLL'),
('SM', 'San Marino', '378', 'EUR'),
('SN', 'Senegal', '221', 'XOF'),
('SO', 'Somalia', '252', 'SOS'),
('SR', 'Suriname', '597', 'SRG'),
('ST', 'Sao Tome And Principe', '239', 'STD'),
('SV', 'El Salvador', '503', 'SVC'),
('SZ', 'Swaziland', '268', 'SZL'),
('TC', 'Turks And Caicos Islands', '164', 'USD'),
('TD', 'Chad', '235', 'XAF'),
('TF', 'French Southern Territories', '591', 'EUR'),
('TG', 'Togo', '228', 'XOF'),
('TH', 'Thailand', '66', 'THB'),
('TJ', 'Tajikistan', '992', 'TJR'),
('TK', 'Tokelau', '690', 'NZD'),
('TM', 'Turkmenistan', '993', 'TMM'),
('TN', 'Tunisia', '216', 'TND'),
('TO', 'Tonga', '676', 'TOP'),
('TP', 'East Timor', '670', 'IDR'),
('TR', 'Turkey', '90', 'TRL'),
('TT', 'Trinidad And Tobago', '186', 'TTD'),
('TV', 'Tuvalu', '688', 'AUD'),
('TW', 'Taiwan', '886', 'TWD'),
('TZ', 'Tanzania, United Republic Of', '255', 'TZS'),
('UA', 'Ukraine', '380', 'UAH'),
('UG', 'Uganda', '256', 'UGX'),
('UM', 'United States Minor Outlying Islands', '808', 'USD'),
('US', 'United States', '1', 'USD'),
('UY', 'Uruguay', '598', 'UYU'),
('UZ', 'Uzbekistan', '998', 'UZS'),
('VA', 'Holy See (Vatican City State)', '379', 'EUR'),
('VC', 'Saint Vincent And the Grenadines', '178', 'XCD'),
('VE', 'Venezuela', '58', 'VEB'),
('VG', 'Virgin Islands (British)', '128', 'USD'),
('VI', 'Virgin Islands (US)', '134', 'USD'),
('VN', 'Vietnam', '84', 'VND'),
('VU', 'Vanuatu', '678', 'VUV'),
('WF', 'Wallis And Futuna Islands', '681', 'XPF'),
('WS', 'Samoa', '685', 'EUR'),
('YE', 'Yemen', '967', 'YER'),
('YT', 'Mayotte', '269', 'EUR'),
('ZA', 'South Africa', '27', 'ZAR'),
('ZM', 'Zambia', '260', 'ZMK');

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `short`, `name`) VALUES
(1, 'en', 'English'),
(2, 'es', 'Espa&ntilde;ol'),
(3, 'pt', 'Portugu&eacute;s');

--
-- Dumping data for table `language_iso`
--

INSERT INTO `language_iso` (`short`, `name`, `nameen`) VALUES
('aa', 'afar', 'afar'),
('ab', 'abjaso (o abjasiano)', 'Abkhazia (or Abkhazians)'),
('ae', 'av&eacute;stico', 'Avestan'),
('af', 'afrikaans', 'afrikaans'),
('ak', 'akano', 'Akano'),
('am', 'am&aacute;rico', 'Amharic'),
('an', 'aragon&eacute;s', 'Aragonese'),
('ar', '&aacute;rabe', 'Arabic'),
('as', 'asam&eacute;s', 'Assamese'),
('av', 'avar', 'avar'),
('ay', 'aimara', 'Aymara'),
('az', 'azer&iacute;', 'Azeri'),
('ba', 'baskir', 'Bashkir'),
('be', 'bielorruso', 'Belarus'),
('bg', 'b&uacute;lgaro', 'Bulgarian'),
('bh', 'bhojpur&iacute;', 'bhojpuri'),
('bi', 'bislama', 'bislama'),
('bm', 'bambara', 'bambara'),
('bn', 'bengal&iacute;', 'Bengali'),
('bo', 'tibetano', 'Tibetan'),
('br', 'bret&oacute;n', 'Breton'),
('bs', 'bosnio', 'Bosnian'),
('ca', 'catal&aacute;n', 'Catalan'),
('ce', 'checheno', 'Chechen'),
('ch', 'chamorro', 'chamorro'),
('co', 'corso', 'Corsican'),
('cr', 'cree', 'cree'),
('cs', 'checo', 'Czech'),
('cu', 'eslavo eclesi&aacute;stico antiguo', 'Old Church Slavonic'),
('cv', 'chuvasio', 'Chuvash'),
('cy', 'gal&eacute;s', 'Welsh'),
('da', 'dan&eacute;s', 'Danish'),
('de', 'alem&aacute;n', 'German'),
('dv', 'maldivo', 'Maldivian'),
('dz', 'dzongkha', 'dzongkha'),
('ee', 'ewe', 'ewe'),
('el', 'griego (moderno)', 'Greek (Modern)'),
('en', 'ingl&eacute;s', 'English'),
('eo', 'Esperanto', 'Esperanto'),
('es', 'Espa&ntilde;ol', 'Spanish'),
('et', 'Estonio', 'Estonian'),
('eu', 'Vascuence (o euskera)', 'Basque (or Euskera)'),
('fa', 'Persa', 'Persian'),
('ff', 'fula', 'Fula'),
('fi', 'fin&eacute;s (o finland&eacute;s)', 'Finnish (or Finnish)'),
('fj', 'fijiano (o fidji)', 'Fijians (or fidji)'),
('fo', 'fero&eacute;s', 'Faroese'),
('fr', 'franc&eacute;s', 'French'),
('fy', 'fris&oacute;n (o frisio)', 'Frisian (or Frisian)'),
('ga', 'irland&eacute;s (o ga&eacute;lico)', 'Irish (or Gaelic)'),
('gd', 'ga&eacute;lico escoc&eacute;s', 'Scottish Gaelic'),
('gl', 'gallego', 'Galician'),
('gn', 'guaran&iacute;', 'Guarani'),
('gu', 'guyarat&iacute; (o guyarat&iacute;)', 'Gujarat (or Gujarat)'),
('gv', 'man&eacute;s (ga&eacute;lico man&eacute;s o de Isla de Man)', 'Manx (Manx Gaelic or Manx)'),
('ha', 'hausa', 'hausa'),
('he', 'hebreo', 'Hebrew'),
('hi', 'hindi (o hind&uacute;)', 'Hindi (or Indian)'),
('ho', 'hiri motu', 'Hiri Motu'),
('hr', 'croata', 'Croatian'),
('ht', 'haitiano', 'Haitian'),
('hu', 'h&uacute;ngaro', 'Hungarian'),
('hy', 'armenio', 'Armenian'),
('hz', 'herero', 'herero'),
('ia', 'interlingua', 'interlingua'),
('id', 'indonesio', 'Indonesian'),
('ie', 'occidental', 'western'),
('ig', 'igbo', 'igbo'),
('ii', 'yi de Sichu&aacute;n', 'Sichuan Yi'),
('ik', 'inupiaq', 'inupiaq'),
('io', 'ido', 'gone'),
('is', 'island&eacute;s', 'Icelandic'),
('it', 'italiano', 'Italian'),
('iu', 'inuktitut', 'inuktitut'),
('ja', 'japon&eacute;s', 'Japanese'),
('jv', 'javan&eacute;s', 'Javanese'),
('ka', 'georgiano', 'Georgian'),
('kg', 'kongo', 'kongo'),
('ki', 'kikuyu', 'Kikuyu'),
('kj', 'kuanyama', 'kuanyama'),
('kk', 'kazajo (o kazajio)', 'Kazakh (or Kazakhstan)'),
('kl', 'groenland&eacute;s (o kalaallisut)', 'Greenlandic (Kalaallisut or)'),
('km', 'camboyano (o jemer)', 'Cambodian (or Khmer)'),
('kn', 'canar&eacute;s', 'Kannada'),
('ko', 'coreano', 'Korean'),
('kr', 'kanuri', 'kanuri'),
('ks', 'cachemiro', 'Kashmiri'),
('ku', 'kurdo', 'Kurdish'),
('kv', 'komi', 'komi'),
('kw', 'c&oacute;rnico', 'Cornish'),
('ky', 'kirgu&iacute;s', 'Kyrgyz'),
('la', 'lat&iacute;n', 'Latin'),
('lb', 'luxemburgu&eacute;s', 'Luxembourg'),
('lg', 'luganda', 'Luganda'),
('li', 'limburgu&eacute;s', 'Limburgs'),
('ln', 'lingala', 'lingala'),
('lo', 'lao', 'lao'),
('lt', 'lituano', 'Lithuanian'),
('lu', 'luba-katanga', 'Luba-Katanga'),
('lv', 'let&oacute;n', 'Latvian'),
('mg', 'malgache (o malagasy)', 'Malagasy (Malagasy or)'),
('mh', 'marshal&eacute;s', 'Marshallese'),
('mi', 'maor&iacute;', 'Maori'),
('mk', 'macedonio', 'Macedonian'),
('ml', 'malayalam', 'Malayalam'),
('mn', 'mongol', 'Mongolian'),
('mo', 'moldavo', 'Moldavian'),
('mr', 'marat&iacute;', 'Marathi'),
('ms', 'malayo', 'Malay'),
('mt', 'malt&eacute;s', 'Maltese'),
('my', 'birmano', 'Burmese'),
('na', 'nauruano', 'Nauruan'),
('nb', 'noruego bokmal', 'Norwegian Bokmal'),
('nd', 'ndebele del norte', 'North Ndebele'),
('ne', 'nepal&iacute;', 'Nepali'),
('ng', 'ndonga', 'ndonga'),
('nl', 'neerland&eacute;s (u holand&eacute;s)', 'Dutch (or Dutch)'),
('nn', 'nynorsk', 'Nynorsk'),
('no', 'noruego', 'Norwegian'),
('nr', 'ndebele del sur', 'South Ndebele'),
('nv', 'navajo', 'navajo'),
('ny', 'chichewa', 'Chichewa'),
('oc', 'occitano', 'Occitan'),
('oj', 'ojibwa', 'ojibwa'),
('om', 'oromo', 'Oromo'),
('or', 'oriya', 'oriya'),
('os', 'os&eacute;tico', 'Ossetian'),
('pa', 'panyab&iacute; (o penyabi)', 'Punjabi (or Punjabi)'),
('pi', 'pali', 'pali'),
('pl', 'polaco', 'Polish'),
('ps', 'past&uacute; (o pashto)', 'past&uacute; (or Pashto)'),
('pt', 'portugu&eacute;s', 'Portuguese'),
('qu', 'quechua', 'Quechua'),
('rm', 'retorrom&aacute;nico', 'Romansh'),
('rn', 'kirundi', 'Kirundi'),
('ro', 'rumano', 'Romanian'),
('ru', 'ruso', 'Russian'),
('rw', 'ruand&eacute;s', 'Rwanda'),
('sa', 's&aacute;nscrito', 'Sanskrit'),
('sc', 'sardo', 'Sardinian'),
('sd', 'sindhi', 'sindhi'),
('se', 'sami septentrional', 'northern Sami'),
('sg', 'sango', 'sango'),
('si', 'cingal&eacute;s', 'Singhalese'),
('sk', 'eslovaco', 'Slovak'),
('sl', 'esloveno', 'Slovenian'),
('sm', 'samoano', 'Samoan'),
('sn', 'shona', 'shona'),
('so', 'somal&iacute;', 'Somali'),
('sq', 'alban&eacute;s', 'Albanian'),
('sr', 'serbio', 'Serbian'),
('ss', 'suazi (swati o siSwati)', 'Swazi (Swati or siSwati)'),
('st', 'sesotho', 'Sesotho'),
('su', 'sundan&eacute;s', 'Sundanese'),
('sv', 'sueco', 'Swedish'),
('sw', 'suajili', 'Swahili'),
('ta', 'tamil', 'tamil'),
('te', 'telug&uacute;', 'Telugu'),
('tg', 'tayiko', 'Tajik'),
('th', 'tailand&eacute;s', 'Thai'),
('ti', 'tigri&ntilde;a', 'Tigrinya'),
('tk', 'turcomano', 'Turkmen'),
('tl', 'tagalo', 'Tagalog'),
('tn', 'setsuana', 'Tswana'),
('to', 'tongano', 'Tongan'),
('tr', 'turco', 'Turkish'),
('ts', 'tsonga', 'tsonga'),
('tt', 't&aacute;rtaro', 'tartar'),
('tw', 'twi', 'twi'),
('ty', 'tahitiano', 'Tahitian'),
('ug', 'uigur', 'Uigur'),
('uk', 'ucraniano', 'Ukrainian'),
('ur', 'urdu', 'urdu'),
('uz', 'uzbeko', 'Uzbek'),
('ve', 'venda', 'band'),
('vi', 'vietnamita', 'Vietnamese'),
('vo', 'volap&uuml;k', 'volap&uuml;k'),
('wa', 'val&oacute;n', 'Walloon'),
('wo', 'wolof', 'wolof'),
('xh', 'xhosa', 'xhosa'),
('yi', 'y&iacute;dish (o yiddish)', 'Yiddish (or Yiddish)'),
('yo', 'yoruba', 'yoruba'),
('za', 'chuan (o zhuang)', 'chuan (or Zhuang)'),
('zh', 'chino', 'Chinese'),
('zu', 'zul&uacute;', 'Zulu');

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `admin_email`, `notification_email`) VALUES
(1, 'info@solicitaxi.com', 'farmatestuser1@solicitaxi.com');

--
-- Dumping data for table `checkin`
--

INSERT INTO `checkin` (`id`, `uid`, `lat`, `lng`, `title`, `created`) VALUES
(1, 2,  -17.383037,-66.145357, 'Checkin Carlos Department', NOW());

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `code`, `uri`, `name`, `lat`, `lng`, `idcountry`) VALUES
(1, 'CB','cochabamba','Cochabamba',	-17.393603, -66.156946, 1),
(2, 'SC','santa-cruz','Santa Cruz', -17.783589, -63.182122, 1),
(3, 'LP','la-paz','La Paz', -16.495658, -68.133562, 1);

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `uid`, `lat`, `lng`, `address1`, `address2`, `state`, `zip`, `phone`, `extension`, `main`, `status`, `idcity`) VALUES
(1,  2,  '-17.393201','-66.162281','Avenida Heroinas #0666 Entre Tumusla y Falsuri', '', 'Cercado', '0666', '79733312', '', 1, 1, 1);




--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `uid`, `firstname`, `lastname`, `gender`, `document`, `typedoc`, `email`, `company`, `mobile`, `avatar`, `created`, `updated`, `idcountry`, `idcity`) VALUES
(1,  1,  'Admin', 'Admin', NULL, NULL, NULL, 'admin@solicitaxi.com', NULL, NULL, NULL, NOW(), NOW(), 1 , 1),
(2,  2,  'Marco','Galvez', NULL, '4918359', 'Carnet de Identidad', 'marco@solicitaxi.com', NULL, '79733312', NULL, NOW(), NOW(), 1 , 1),
(3,  3,  'Freddy','Maldonado', NULL, '564654', 'Carnet de Identidad', 'freddy@solicitaxi.com', NULL, '60737698', NULL, NOW(), NOW(), 1 , 1),
(4,  4,  'Ciudad','Jardin', NULL, NULL, NULL, 'taxi@solicitaxi.com', NULL, NULL, NULL, NOW(), NOW(), 1, 1),
(5, 5, 'Juan','Perez', NULL, '12313', 'Carnet De Identidad', 'test1@solicitaxi.com',  NULL, NULL, 'temp/user/person1.jpg', NOW(), NOW(), 1, 1);



INSERT INTO `taxi` (`id` ,`uid` ,`plate` ,`uri` ,`desc` ,`rating` ,`taxiphoto`, `taxicolor` ,`status`, `idcity` ,`lat` ,`lng` ,`created` ,`updated`, `number`) VALUES
(1 , '5', '2121-ABC', '2121-ABC', 'Taxi de Prueba', '5.0', 'temp/taxi/verde.jpg','verde', '0', '2', '-17.378826', '-66.160908', NOW() ,CURRENT_TIMESTAMP, '1');

