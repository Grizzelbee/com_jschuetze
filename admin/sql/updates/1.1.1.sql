ALTER TABLE `#__jschuetze_mitglieder` 
ADD COLUMN  `scet_mail_notification` SMALLINT NOT NULL;

UPDATE `#__jschuetze_mitglieder` 
SET    scet_mail_notification = 0;

