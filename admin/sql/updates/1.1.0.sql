CREATE TABLE IF NOT EXISTS `#__jschuetze_statistics` ( 
    `id`             INT NOT NULL AUTO_INCREMENT, 
	`viewname`   	 VARCHAR(128),
	`hits`           INT,
    PRIMARY KEY (`id`)
); 
ALTER TABLE `#__jschuetze_statistics` 
CONVERT TO CHARACTER SET utf8 COLLATE `utf8_general_ci`;
