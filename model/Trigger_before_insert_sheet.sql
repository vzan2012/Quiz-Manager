DELIMITER $$
DROP TRIGGER sheet_before_insert_trg$$
CREATE TRIGGER sheet_before_insert_trg
BEFORE INSERT ON sheet
FOR EACH ROW
BEGIN
	DECLARE finished BOOLEAN;
    DECLARE v_user_id int; 
	DECLARE c_users CURSOR FOR 
    SELECT user_id 
	FROM group_member
	WHERE group_id = new.trainee_id;

	-- INSERT the sheets
    SET finished = FALSE;
    OPEN c_users;
	BEGIN
		 -- Exit this BEGIN block when no more row
		 DECLARE EXIT HANDLER FOR NOT FOUND SET finished = TRUE;
		 REPEAT
		 FETCH c_users INTO v_user_id;
		 INSERT INTO sheet(trainee_id, evaluation_id, started_at) 
         VALUES (v_user_id, new.evaluation_id, NULL);
		UNTIL finished END REPEAT;
	 END;
	 CLOSE c_users;
END $$
