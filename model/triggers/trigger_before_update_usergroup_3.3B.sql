DELIMITER $$
DROP TRIGGER IF EXISTS before_update_usergroup_trg$$

CREATE TRIGGER before_update_usergroup_trg
BEFORE UPDATE ON usergroup
FOR EACH ROW
BEGIN
    DECLARE trainer_status BOOLEAN;
    SELECT is_trainer INTO trainer_status
    FROM user
	WHERE user_id = NEW.creator_id;
    -- check if it is trainer --
    IF trainer_status = 0 THEN
    SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT='Creator id does not refer to trainer', MYSQL_ERRNO = 3003;
    END IF;
END $$