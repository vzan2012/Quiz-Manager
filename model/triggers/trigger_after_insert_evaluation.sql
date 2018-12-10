DELIMITER $$
DROP TRIGGER IF EXISTS after_insert_evaluation_trg$$

CREATE TRIGGER after_insert_evaluation_trg
AFTER INSERT ON evaluation
FOR EACH ROW
BEGIN
	DECLARE v_user_id int;
    DECLARE finished BOOLEAN DEFAULT FALSE;
	DECLARE c_users CURSOR FOR
    SELECT user_id 
    FROM group_member
	WHERE group_id = NEW.group_id;
	OPEN c_users;
	BEGIN
		-- Exit this BEGIN block when no more row
	 DECLARE EXIT HANDLER FOR NOT FOUND SET finished = TRUE;
	 REPEAT
	 FETCH c_users INTO v_user_id;
	 -- Next line not executed if no data found
	 -- as EXIT HANDLER when NOT FOUND
	 INSERT INTO sheet(trainee_id, evaluation_id)
	 VALUES(v_user_id, NEW.evaluation_id);
	 UNTIL finished END REPEAT;
	END;
	CLOSE c_users;

END $$