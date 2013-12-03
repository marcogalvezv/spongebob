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
  	`lat` DECIMAL(20,10) NOT NULL ,
	`lng` DECIMAL(20,10) NOT NULL ,
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
  	`lat` DECIMAL(20,10) NOT NULL ,
	`lng` DECIMAL(20,10) NOT NULL ,
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
-- Table `booking` RESERVA TAXI O COMPANIA
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
