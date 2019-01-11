DELIMITER $$
DROP TRIGGER IF EXISTS before_insert_evaluation_trg$$

CREATE TRIGGER before_insert_evaluation_trg
BEFORE INSERT ON evaluation
FOR EACH ROW
BEGIN
    -- check scheduled_at >= ending_at --
    IF NEW.scheduled_at >= NEW.ending_at THEN
    SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT='Scheduled time is past end time', MYSQL_ERRNO = 3004;
    END IF;
END $$