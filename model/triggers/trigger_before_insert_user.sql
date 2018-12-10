DELIMITER $$
DROP TRIGGER IF EXISTS before_insert_user_trg $$
CREATE TRIGGER before_insert_user_trg
BEFORE INSERT ON user
FOR EACH ROW
BEGIN
	SET NEW.name = TRIM(UPPER(NEW.name));
    SET NEW.first_name = TRIM(UPPER(NEW.first_name));
    SET NEW.email = TRIM(NEW.email);

END $$