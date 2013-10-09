CREATE TABLE IF NOT EXISTS `#__jschuetze_fundus` ( 
    `id`             INT NOT NULL AUTO_INCREMENT, 
    `name`           VARCHAR(128), 
	`anzahl`		 SMALLINT NOT NULL,
	`bestand`  		 SMALLINT NOT NULL,
    `ordering`       SMALLINT NOT NULL,
    `published`      SMALLINT NOT NULL,
    PRIMARY KEY (`id`)
); 
ALTER TABLE `#__jschuetze_fundus` 
CONVERT TO CHARACTER SET utf8 COLLATE `utf8_general_ci`;


CREATE TABLE IF NOT EXISTS `#__jschuetze_lending` ( 
    `id`             INT NOT NULL AUTO_INCREMENT, 
	`fk_schuetze`	 SMALLINT NOT NULL,
	`fk_fundus`      SMALLINT NOT NULL,
	`anzahl_aus`	 SMALLINT NOT NULL,
	`ausgabe`		 DATE,
	`anzahl_rueck`	 SMALLINT NOT NULL,
	`rueckgabe`		 DATE,
    `ordering`       SMALLINT NOT NULL,
    `published`      SMALLINT NOT NULL,
    PRIMARY KEY (`id`)
); 
ALTER TABLE `#__jschuetze_lending` 
CONVERT TO CHARACTER SET utf8 COLLATE `utf8_general_ci`;
