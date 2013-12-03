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
-- Table `commission`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `commission` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `percent` DECIMAL(10,2) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `pretaxi`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `pretaxi` (
	`id` INT(10) NOT NULL AUTO_INCREMENT ,
	`name` VARCHAR(255) NOT NULL ,
  	`email` VARCHAR(255) NULL ,
  	`phone` VARCHAR(255) NULL ,
  	`website` VARCHAR(255) NULL ,
	`facebook` VARCHAR(255) NULL ,
	`twitter` VARCHAR(255) NULL ,
	`address` VARCHAR(255) NULL ,
	`numcabs` INT(11) NULL DEFAULT 1,
	`internet` VARCHAR(255) NULL ,
	`contact_name` VARCHAR(255) NOT NULL ,
  	`contact_email` VARCHAR(255) NULL ,
  	`contact_phone` VARCHAR(255) NULL ,
  	`contact_mobile` VARCHAR(255) NULL ,
	`contact_position` VARCHAR(255) NULL ,
	`email_subject` VARCHAR(255) NULL ,
	`email_message` TEXT NULL ,
	PRIMARY KEY (`id`)
) CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB;
 
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
-- Table `farmacorp`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `farmacorp` (
	`id` INT(10) NOT NULL AUTO_INCREMENT ,
	`name` VARCHAR(255) NULL ,
	`uri` VARCHAR(150) NOT NULL ,
	`description` VARCHAR(255) NULL ,
	`phone` VARCHAR(255) NULL ,
	`schedule` VARCHAR(255) NULL ,
	`lat` DECIMAL(20,10) NOT NULL ,
	`lng` DECIMAL(20,10) NOT NULL ,
	`address1` VARCHAR(255) NULL ,
	`address2` VARCHAR(255) NULL ,
	`idcity` INT(10) NOT NULL ,
	`status` SMALLINT(1) NULL DEFAULT 0 COMMENT '0:disabled-1:enabled' ,
	PRIMARY KEY (`id`) ,
	INDEX `fk_farmacorpbranch_city1_idx` (`idcity` ASC) ,
	CONSTRAINT `fk_farmacorpbranch_city1_idx`
		FOREIGN KEY (`idcity` )
		REFERENCES `city` (`id` )
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
) CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `restaurant_branch`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `user_farmacorp` (
	`uid` INT(10) NOT NULL ,
	`idfarma` INT(10) NOT NULL
) ENGINE = InnoDB;

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
-- Table `ride` CARRERA O VIAJE
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ride` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `cod` VARCHAR(255) NULL,
  `date_reg` DATETIME NOT NULL ,
  `idadd` INT(10) NULL ,
  `total` DECIMAL(10,2) NULL ,
  `status` SMALLINT(1) NOT NULL DEFAULT 0  COMMENT '0:unattended-1:in progress-2:attended' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_ride_address1_idx` (`idadd` ASC) ,
  UNIQUE INDEX `cod_UNIQUE` (`cod` ASC) ,
  CONSTRAINT `fk_ride_address1_idx`
    FOREIGN KEY (`idadd` )
    REFERENCES `address` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `item`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `item` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `code` VARCHAR(20) NOT NULL ,
  `name` VARCHAR(150) NOT NULL ,
  `description` TEXT NULL ,
  `prev_price` DECIMAL(10,2) NULL ,
  `price` DECIMAL(10,2) NOT NULL ,
  `currency` VARCHAR(3) NOT NULL ,
  `ride_time` TIME NULL COMMENT 'Estimated ride time' ,
  `image` VARCHAR(255) NULL DEFAULT NULL ,
  `status` SMALLINT(1) NOT NULL DEFAULT 1 COMMENT '0:disabled-1:enabled' ,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ride_detail`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ride_detail` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `idride` INT(10) NOT NULL ,
  `iditem` INT(10) NOT NULL ,
  `quantity` INT(5) NOT NULL ,
  `price` DECIMAL(10,2) NOT NULL ,
  `currency` VARCHAR(3) NOT NULL ,
  `extra_price` DECIMAL(10,2) NULL ,
  `obs` TEXT NULL ,
  `obstaxi` TEXT NULL COMMENT 'Taxi explanation about extra_price' ,
  `commission` DECIMAL(10,2) NULL ,
  `estimated` TIME NOT NULL ,
  `status` SMALLINT(1) NOT NULL DEFAULT 1  COMMENT '0:deleted or canceled-1:active' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_ride_detail_item1_idx` (`iditem` ASC) ,
  INDEX `fk_ride_detail_rides1_idx` (`idride` ASC) ,
  CONSTRAINT `fk_ride_detail_item1_idx`
    FOREIGN KEY (`iditem` )
    REFERENCES `item` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ride_detail_rides1_idx`
    FOREIGN KEY (`idride` )
    REFERENCES `ride` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `profile`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `profile` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` INT(11) NOT NULL ,
  `type` VARCHAR(255) NOT NULL ,
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
-- Table `credit`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `credit` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` INT(11) NOT NULL ,
  `amount` DECIMAL(10,2) NULL DEFAULT 0.00,
  `debit_note` VARCHAR(255) NULL DEFAULT NULL ,
  `activation_code` VARCHAR(255) NULL DEFAULT NULL ,
  `uidactivate` INT(11) NOT NULL ,
  `activation_date` DATETIME NOT NULL ,
  `uidrevert` INT(11) NULL,
  `revert_date` DATETIME NULL ,
  `status` TINYINT(1) NOT NULL DEFAULT '0' ,
  `expiration` TIMESTAMP NULL DEFAULT NULL ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_usercredit_user_idx` (`uid` ASC) ,
  CONSTRAINT `fk_usercredit_user_idx`
    FOREIGN KEY (`uid` )
    REFERENCES `user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `debit`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `debit` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `uid` INT(11) NOT NULL ,
  `amount` DECIMAL(10,2) NULL DEFAULT 0.00,
  `status` TINYINT(1) NOT NULL DEFAULT '0' ,
  `created` TIMESTAMP NULL DEFAULT NULL ,
  `updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_debit_user_idx` (`uid` ASC) ,
  CONSTRAINT `fk_debit_user_idx`
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
-- Table `time`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `time` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `hour_ini` TIME NOT NULL ,
  `hour_end` TIME NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `shift`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `shift` (
  `day` SMALLINT(1) NOT NULL COMMENT '1:sunday-2:monday-7:saturday' ,
  `idtime` INT(10) NOT NULL ,
  `idrest` INT(10) NOT NULL ,
  `status` SMALLINT(1) NOT NULL DEFAULT 1 ,
  INDEX `fk_rest_time_time1_idx` (`idtime` ASC) ,
  PRIMARY KEY (`day`, `idtime`, `idrest`) ,
  INDEX `fk_business_time_restaurant1_idx` (`idrest` ASC) ,
  CONSTRAINT `fk_rest_time_time1`
    FOREIGN KEY (`idtime` )
    REFERENCES `time` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_business_time_restaurant1`
    FOREIGN KEY (`idrest` )
    REFERENCES `restaurant` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'business hours on days of the week';

-- -----------------------------------------------------
-- Table `payment_type`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `payment_type` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `code` VARCHAR(10) NOT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  `description` VARCHAR(255) NULL ,
  `logo` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `cod_UNIQUE` (`code` ASC) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB
COMMENT = 'payment types accepted on the service subscription';

-- -----------------------------------------------------
-- Table `cart`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cart` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `uid` INT(11) NULL ,
  `iditem` INT(10) NOT NULL ,
  `quantity` INT(10) NOT NULL ,
  `extra_price` DECIMAL(10,2) NULL ,
  `obs` TEXT NULL COMMENT 'Clarifications, which can generate extra costs' ,
  `obstaxi` TEXT NULL COMMENT 'Explication from taxu by extra_price' ,
  `session` VARCHAR(255) NULL ,
  `estimated` TIME NOT NULL ,
  `status` SMALLINT(1) NOT NULL DEFAULT 0 COMMENT '0:in cart-1:verifying availability-2:confirmed-3:attended' ,
  `created` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sale_detail_item1` (`iditem` ASC) ,
  INDEX `fk_cart_user1_idx` (`uid` ASC) ,
  CONSTRAINT `fk_sale_detail_item10`
    FOREIGN KEY (`iditem` )
    REFERENCES `item` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cart_user1`
    FOREIGN KEY (`uid` )
    REFERENCES `user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
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
  `description` VARCHAR(255) NULL ,
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
  `description` VARCHAR(255) NULL ,
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
  `description` VARCHAR(255) NULL ,
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
  `description` TEXT NULL ,
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
  `branch_extra` DECIMAL(10,2) NULL ,
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
-- Table `subscription`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `subscription` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `taxi`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `taxi` (
	`id` INT(10) NOT NULL AUTO_INCREMENT ,
	`uid` INT(11) NOT NULL ,
	`name` VARCHAR(255) NOT NULL ,
	`uri` VARCHAR(255) NOT NULL ,
	`description` VARCHAR(255) NOT NULL ,
	`slogan` VARCHAR(255) NOT NULL DEFAULT 'El Mejor Radio Taxi de la Ciudad',
	`rating` DECIMAL(10,2) NOT NULL DEFAULT 5.0 COMMENT 'rating stars' ,
	`logo` VARCHAR(255) NULL COMMENT 'logo image filename' ,
	`banner` VARCHAR(255) NULL COMMENT 'banner image filename' ,
	`status` SMALLINT(1) NULL COMMENT '0:disable-1:enable' ,
    `email` VARCHAR(255) NULL ,
	`phone` VARCHAR(255) NULL ,
	`qty_taxis` INT(11) NULL DEFAULT 1,
	`internet` SMALLINT(1) NULL DEFAULT 0 COMMENT '0:no-1:yes' ,
	`contact_name` VARCHAR(255) NOT NULL ,
	`contact_email` VARCHAR(255) NULL ,
	`contact_phone` VARCHAR(255) NULL ,
	`contact_mobile` VARCHAR(255) NULL ,
	`contact_position` VARCHAR(255) NULL ,
	`lat` DECIMAL(20,10) NOT NULL DEFAULT -17.383283,
	`lng` DECIMAL(20,10) NOT NULL DEFAULT -66.160238,
  PRIMARY KEY (`id`) ,
  INDEX `fk_dealer_user1_idx` (`uid` ASC) ,
  CONSTRAINT `fk_dealer_user1`
    FOREIGN KEY (`uid` )
    REFERENCES `user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table  `ride_taxi` => `order_dealer`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ride_taxi` (
  `idride` INT(10) NOT NULL ,
  `idtaxi` INT(10) NOT NULL ,
  `date_reg` DATETIME NOT NULL,
  `code_taxi` VARCHAR(20) NULL ,
  `price` DECIMAL(10,2) NOT NULL DEFAULT 1,
  `trans_time` TIME NOT NULL DEFAULT 30 COMMENT 'Estimated transportation time' ,
  `obs` TEXT NULL ,
  `status` SMALLINT(1) NOT NULL DEFAULT 1 COMMENT '0:disable-1:enable' ,
  PRIMARY KEY (`idride`, `idtaxi`) ,
  INDEX `fk_ride_taxi_rides_idx` (`idride` ASC) ,
  INDEX `fk_ride_taxi_taxis_idx` (`idtaxi` ASC) ,
  CONSTRAINT `fk_ride_taxi_rides_idx`
    FOREIGN KEY (`idride` )
    REFERENCES `ride` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ride_taxi_taxis_idx`
    FOREIGN KEY (`idtaxi` )
    REFERENCES `taxi` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'attending an order assigning an agent';

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
-- Table `voucher`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `voucher` (
	`id` INT(10) NOT NULL AUTO_INCREMENT ,
	`idride` INT(10) NOT NULL ,
	`cod` VARCHAR(255) NULL ,
	`name` VARCHAR(255) NOT NULL ,
	`nit` VARCHAR(255) NOT NULL ,
	PRIMARY KEY (`id`),
	INDEX `fk_voucher_ride_idx` (`idride` ASC) ,
  CONSTRAINT `fk_voucher_rides`
    FOREIGN KEY (`idride` )
    REFERENCES `ride` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
 ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `exchange`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `exchange` (
`id` INT(11) NOT NULL AUTO_INCREMENT ,
`csymbol` VARCHAR(3) NOT NULL ,
`cname` VARCHAR(255) NOT NULL ,
`crate` DECIMAL(20,10) NOT NULL ,
`cinverse` DECIMAL(20,10) NOT NULL ,
`datetime` DATETIME NOT NULL ,
PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
