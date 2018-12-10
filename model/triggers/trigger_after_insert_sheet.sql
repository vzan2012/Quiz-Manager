DELIMITER $$
DROP TRIGGER IF EXISTS after_insert_sheet_trg$$

CREATE TRIGGER after_insert_sheet_trg
AFTER INSERT ON sheet
FOR EACH ROW
BEGIN
	DECLARE v_question_id int;
    DECLARE finished BOOLEAN DEFAULT FALSE;
	DECLARE cursor_questions CURSOR FOR
    SELECT question_id 
    FROM sql_quiz_question
	WHERE quiz_id = 
    (
		SELECT quiz_id 
		FROM evaluation
		WHERE evaluation_id = NEW.evaluation_id
    );
	OPEN cursor_questions;
	BEGIN
		-- Exit this BEGIN block when no more row
	 DECLARE EXIT HANDLER FOR NOT FOUND SET finished = TRUE;
	 REPEAT
	 FETCH cursor_questions INTO v_question_id;
	 -- Next line not executed if no data found
	 -- as EXIT HANDLER when NOT FOUND
     INSERT INTO sql_answer(question_id, trainee_id, evaluation_id)
	 VALUES(v_question_id, NEW.trainee_id, NEW.evaluation_id);
	 UNTIL finished END REPEAT;
	END;
	CLOSE cursor_questions;

END $$