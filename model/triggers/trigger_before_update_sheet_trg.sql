DELIMITER $$
DROP TRIGGER IF EXISTS before_update_sheet_trg$$

CREATE TRIGGER before_update_sheet_trg
BEFORE UPDATE ON sheet
FOR EACH ROW
BEGIN
	DECLARE start_time DATETIME;
    DECLARE end_time DATETIME;
    SELECT scheduled_at, ending_at INTO start_time, end_time
    FROM evaluation
    WHERE evaluation_id = NEW.evaluation_id;
    -- check if we are not in time --
    IF NEW.started_at < start_time OR NEW.ended_at > end_time THEN
    SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT='Start or end time not in the scheduled dates', MYSQL_ERRNO = 3005;
	ELSEIF NEW.started_at > NEW.ended_at THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT='Started_at is greater than ended_at time', MYSQL_ERRNO = 3006;
    END IF;
END $$

