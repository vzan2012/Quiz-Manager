DELIMITER $$
DROP TRIGGER IF EXISTS before_update_sql_quiz_trg$$

CREATE TRIGGER before_update_sql_quiz_trg
BEFORE UPDATE ON sql_quiz
FOR EACH ROW
BEGIN
    DECLARE trainer_status BOOLEAN;
    SELECT is_trainer INTO trainer_status
    FROM user
	WHERE user_id = NEW.author_id;
    -- check if it is trainer --
    IF trainer_status = 0 THEN
    SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT='Author id does not refer to trainer', MYSQL_ERRNO = 3002;
    END IF;
END $$