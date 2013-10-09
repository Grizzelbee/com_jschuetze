ALTER TABLE `#__jschuetze_auszeichnungen` 
ADD COLUMN  `memberfiles` SMALLINT DEFAULT 0,
DROP COLUMN `zugkoenig`,
DROP COLUMN `corpskoenig`,
DROP COLUMN `bruderkoenig`;

UPDATE `#__jschuetze_auszeichnungen` 
SET    memberfiles = 0;

ALTER TABLE `#__jschuetze_mitglieder` 
ADD COLUMN  `fk_juser`   SMALLINT;