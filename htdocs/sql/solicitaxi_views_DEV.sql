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
    (CASE WHEN u.status = 1 THEN 'Aprobado'
     WHEN u.status = 0 THEN 'Bloqueado' END) AS status,
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

