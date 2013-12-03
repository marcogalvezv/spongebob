SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

/*
*****************************
CREATE VIEWS
*****************************
*/

-- -----------------------------------------------------
-- View `v_usersprofile`
-- -----------------------------------------------------

CREATE OR REPLACE VIEW v_userprofile AS
SELECT u.id as selected, p.id, p.uid, CONCAT(p.firstname, ' ', p.lastname) as name, p.email, c.name as country, p.company,
(CASE WHEN u.activation_code = "" THEN 'Yes' WHEN u.activation_code IS NULL THEN 'Yes' ELSE 'No' END) as activated,
(CASE WHEN u.status = 1 THEN 'Approved' WHEN u.status = 0 THEN 'Blocked' END) as status,
p.created as signupdate,
u.gid as gid
FROM profile p
LEFT JOIN country c ON p.idcountry = c.id
LEFT JOIN user u ON u.id = p.uid
WHERE p.uid != 1
GROUP BY p.uid
ORDER BY p.id;

-- -----------------------------------------------------
-- View `v_company`
-- -----------------------------------------------------
CREATE OR REPLACE VIEW v_company AS
SELECT c.id as selected, c.id, c.uid, c.name, c.uri, c.desc, c.slogan, c.rating, c.logo, c.numtaxis, c.lat, c.lng, c.email,
(CASE WHEN c.status = 1 THEN 'Approved' WHEN c.status = 0 THEN 'Blocked' END) as status
FROM company c;

-- -----------------------------------------------------
-- View `v_booking`
-- -----------------------------------------------------
CREATE OR REPLACE VIEW v_booking AS
SELECT b.id as selected,b.*,
CONCAT(a.address1,' ',a.address2) AS fulladdress, a.lat AS addlat, a.lng AS addlng,
CONCAT(p.lastname,' ',p.firstname) AS fullname,
CONCAT(d.address1,' ',d.address2) AS fulldestination, d.lat AS destlat, d.lng AS destlng
FROM `booking` b
JOIN `address` a ON b.idadd = a.id
JOIN `profile` p ON a.uid = p.uid
LEFT JOIN `destination` d ON b.iddest = d.id;

-- -----------------------------------------------------
-- View `v_badge`
-- -----------------------------------------------------
-- CREATE OR REPLACE VIEW v_badge AS
-- SELECT b.id, b.cod, b.name, b.message, b.question, b.filename, b.status, COUNT(be.id) AS badge_earned
-- FROM `badge` b
-- LEFT JOIN `badge_earned` be ON b.id = be.idbadge
-- GROUP BY b.id, b.cod, b.name, b.filename;

-- -----------------------------------------------------
-- View `v_badge_stats`
-- -----------------------------------------------------
-- CREATE OR REPLACE VIEW v_badge_stats AS
-- SELECT b.id, b.cod, b.name, DATE_FORMAT(be.created,'%Y-%m-%d') AS date_earned, COUNT(be.id) AS badge_earned
-- FROM `badge` b
-- LEFT JOIN `badge_earned` be ON b.id = be.idbadge
-- GROUP BY b.id, b.cod, b.name, DATE_FORMAT(be.created,'%Y-%m-%d');

-- -----------------------------------------------------
-- View `v_badge_assign`
-- -----------------------------------------------------
-- CREATE OR REPLACE VIEW v_badge_earned AS
-- SELECT b.id, b.idbadge, b.created, b.rating, b.notes, b.status, b.uid, b.updated,  bt.cod, bt.name, u.username, CONCAT(p.firstname,' ',p.lastname) AS fullname, p.email
-- FROM `badge_earned` b
-- LEFT JOIN `badge` bt ON bt.id = b.idbadge
-- LEFT JOIN `user` u ON u.id = b.uid
-- LEFT JOIN `profile` p ON p.uid = u.id;
--
-- SET SQL_MODE=@OLD_SQL_MODE;
-- SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
-- SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;