DELIMITER $$
DROP TRIGGER IF EXISTS before_insert_group_member_trg$$

CREATE TRIGGER before_insert_group_member_trg
BEFORE INSERT ON group_member
FOR EACH ROW
BEGIN
    DECLARE group_status BOOLEAN;
    SELECT is_closed INTO group_status
    FROM usergroup
	WHERE group_id = NEW.group_id;
    -- check group is closed --
    IF group_status = 1 THEN
    SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT='Group is closed', MYSQL_ERRNO = 3001;
    END IF;
END $$