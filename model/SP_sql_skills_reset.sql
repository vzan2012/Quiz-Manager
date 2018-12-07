CREATE DEFINER=`root`@`localhost` PROCEDURE `sql_skills_reset`()
BEGIN
	SET FOREIGN_KEY_CHECKS=0;
	TRUNCATE TABLE sql_answer;
    
	TRUNCATE TABLE sheet;
    
	TRUNCATE TABLE group_member;
    TRUNCATE TABLE evaluation;
    TRUNCATE TABLE sql_quiz_question;
    
    TRUNCATE TABLE usergroup;
    TRUNCATE TABLE sql_quiz;
    TRUNCATE TABLE sql_question;

    TRUNCATE TABLE usergroup;
    TRUNCATE TABLE sql_quiz;
    TRUNCATE TABLE sql_question;
    
    TRUNCATE TABLE sql_skills_2018_11.user;
    TRUNCATE TABLE theme;
    TRUNCATE TABLE quiz_db;
    
	SET FOREIGN_KEY_CHECKS=1;
    
    -- User Table
    insert into sql_skills_2018_11.user (user_id, email, pwd, name, first_name, token, created_at, validated_at, is_trainer)
		values (1,'kambleshan04@gmail.com','shantanu','Kamble','Shantanu','token_kamble_sh', '2018-11-23 15:21:54', CURRENT_TIMESTAMP(), false),
		 (2, 'sindhura.vegi@gmail.com','sindhura','Devi','Sindhura','token_sindhura_devi', '2018-11-23 15:25:54', CURRENT_TIMESTAMP(), false),
		 (3, 'deepak@gmail.com','deepak','Guptha','Deepak','token_abbas_2324', '2018-11-22 15:25:54', CURRENT_TIMESTAMP(), true);

        
	-- Theme Table
    insert into theme (theme_id, label) values 
    (1,'Databases');
    
    -- Quiz DB Table
	insert into quiz_db (db_name, diagram_path, creation_script_path, description) values 
    ('bank','databases/bank.png',NULL,NULL);
    
    -- sql-quiz
	INSERT INTO sql_quiz (quiz_id, title, is_public, author_id, db_name) VALUES 
    (1, 'Bank Quiz', true, '0003', 'bank');

	-- sql-question
	INSERT INTO sql_question(question_id, db_name, question_text, correct_answer, correct_result, is_public, theme_id, author_id) VALUES 
	(1, 'bank', 'Name and email of all clients', 'SELECT name, email
FROM client', NULL, 0, 1, 3),
	(2, 'bank', 'Customer assignment (to a salesperson) dates', 'SELECT set_to_at
FROM portfolio', NULL, 0, 1, 3),
	(3, 'bank', 'Customer assignment (to a salesperson) dates, without duplicate', 'SELECT DISTINCT set_to_at
FROM portfolio', NULL, 0, 1, 3),
	(4, 'bank', 'Length of client email (string function)', 'SELECT email, length(email)
FROM client', NULL, 0, 1, 3);


	 INSERT INTO usergroup (group_id, name, creator_id, created_at, is_closed) VALUES
	 (1, 'SE Spring 2018', 3, '2018-11-22 15:25:54', 1);

	-- group_member
	 INSERT INTO group_member (user_id, group_id, validated_at) VALUES
	 (1, 1, '2018-11-22 16:30:00'),
     (2, 1, '2018-11-23 10:00:00');
	 
	-- evaluation
	 INSERT INTO evaluation(evaluation_id, group_id, quiz_id, scheduled_at, ending_at, corrected_at) VALUES
	 (1, 1, 1, '2018-11-23 10:00:00', '2018-11-23 13:00:00', '2018-11-24 09:30:00');
	 
	-- sql quiz question
	 INSERT INTO sql_quiz_question (question_id, quiz_id, rank) VALUES
	 (1, 1, 1);
	 
	-- sheet
	  INSERT INTO sheet (trainee_id, evaluation_id, started_at, ended_at, corrected_at) VALUES
	 (3, 1, '2018-11-25 10:00:00', '2018-11-25 13:00:00', '2018-11-26 09:30:00');

END