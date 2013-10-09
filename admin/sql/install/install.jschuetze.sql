CREATE TABLE IF NOT EXISTS `#__jschuetze_mitglieder` ( 
    `id`                    INT NOT NULL AUTO_INCREMENT, 
    `name`                  VARCHAR(100) CHARACTER SET utf8 , 
    `vorname`               VARCHAR(100) CHARACTER SET utf8 , 
    `geburtstag`            DATE,
    `strasse`               VARCHAR(64)  CHARACTER SET utf8,
    `plz`                   INT,
    `ort`                   VARCHAR(32)  CHARACTER SET utf8,
    `tel`                   VARCHAR(32)  CHARACTER SET utf8,
    `mobile`                VARCHAR(32)  CHARACTER SET utf8,
    `email_priv`            VARCHAR(64)  CHARACTER SET utf8,
    `foto_url`              VARCHAR(255) CHARACTER SET utf8,
    `religion`              VARCHAR(8)   CHARACTER SET utf8,
    `beitritt`              DATE,
    `austritt`              DATE,
    `mitgliedsnr_bruder`    INT, 
    `beitritt_bruder`       DATE,
    `austritt_bruder`       DATE,
    `eintritt_sch_wesen`    DATE,
    `fk_status`             INT,
    `fk_funktion`           INT,
    `fk_lebenspartner`      INT,
    `ordering`              SMALLINT NOT NULL,
    `published`             SMALLINT NOT NULL,
   PRIMARY KEY (`id`) 
); 

CREATE TABLE IF NOT EXISTS `#__jschuetze_status` ( 
    `id`             INT NOT NULL AUTO_INCREMENT, 
    `name`           VARCHAR(64), 
    `ordering`       SMALLINT NOT NULL,
    `published`      SMALLINT NOT NULL,
    PRIMARY KEY (`id`)
); 

CREATE TABLE IF NOT EXISTS `#__jschuetze_titel` ( 
    `id`             INT NOT NULL AUTO_INCREMENT, 
    `name`           VARCHAR(64) CHARACTER SET utf8,
    `rank`           INT,
    `ordering`       SMALLINT NOT NULL,
    `published`      SMALLINT NOT NULL,
    PRIMARY KEY (`id`)
); 


CREATE TABLE IF NOT EXISTS `#__jschuetze_auszeichnungen` ( 
    `id`             INT NOT NULL AUTO_INCREMENT, 
    `name`           VARCHAR(32) CHARACTER SET utf8, 
    `zugkoenig`      SMALLINT DEFAULT 0,
    `corpskoenig`    SMALLINT DEFAULT 0,
    `bruderkoenig`   SMALLINT DEFAULT 0,
    `pfand`          SMALLINT DEFAULT 0,
    `ordering`       SMALLINT NOT NULL,
    `published`      SMALLINT NOT NULL,
    `icon`           varchar(255),
   PRIMARY KEY (`id`) 
); 


CREATE TABLE IF NOT EXISTS `#__jschuetze_mitgliedsausz` ( 
   `id`                    INT NOT NULL AUTO_INCREMENT, 
   `fk_mitglied`           INT , 
   `fk_auszeichnung`       INT,
   `auszeichnungsdatum`    DATE,
   `titel`                 VARCHAR(16),
   `periode`               VARCHAR(32), 
   `foto_url`              VARCHAR(255), 
   PRIMARY KEY (`id`) 
); 


CREATE TABLE IF NOT EXISTS `#__jschuetze_memberranks` ( 
    `id`                    INT NOT NULL AUTO_INCREMENT, 
    `fk_mitglied`           INT , 
    `fk_funktion`           INT,
    `funktion_seit`         DATE,
    `funktion_bis`          DATE,  
   PRIMARY KEY (`id`) 
); 

ALTER TABLE `#__jschuetze_memberranks` 
CONVERT TO CHARACTER SET utf8 COLLATE `utf8_general_ci`;

ALTER TABLE `#__jschuetze_mitgliedsausz` 
CONVERT TO CHARACTER SET utf8 COLLATE `utf8_general_ci`;

ALTER TABLE `#__jschuetze_mitglieder` 
CONVERT TO CHARACTER SET utf8 COLLATE `utf8_general_ci`;

ALTER TABLE `#__jschuetze_status` 
CONVERT TO CHARACTER SET utf8 COLLATE `utf8_general_ci`;

ALTER TABLE `#__jschuetze_titel` 
CONVERT TO CHARACTER SET utf8 COLLATE `utf8_general_ci`;

ALTER TABLE `#__jschuetze_auszeichnungen` 
CONVERT TO CHARACTER SET utf8 COLLATE `utf8_general_ci`;