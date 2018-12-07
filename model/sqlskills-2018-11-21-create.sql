-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema sql_skills_2018_11
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS sql_skills_2018_11 ;

-- -----------------------------------------------------
-- Schema sql_skills_2018_11
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS sql_skills_2018_11 DEFAULT CHARACTER SET utf8 ;
USE sql_skills_2018_11 ;

-- -----------------------------------------------------
-- Table quiz_db
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS quiz_db (
  db_name VARCHAR(45) NOT NULL,
  diagram_path VARCHAR(255) NULL DEFAULT NULL,
  creation_script_path VARCHAR(255) NULL DEFAULT NULL,
  description TEXT NULL DEFAULT NULL,
  PRIMARY KEY (db_name))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table user
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS user (
  user_id INT(11) NOT NULL AUTO_INCREMENT,
  email VARCHAR(45) NOT NULL,
  pwd VARCHAR(255) NOT NULL,
  name VARCHAR(45) NOT NULL,
  first_name VARCHAR(45) NOT NULL,
  token VARCHAR(45) NULL DEFAULT NULL,
  created_at DATETIME NOT NULL,
  validated_at DATETIME NULL DEFAULT NULL,
  is_trainer TINYINT(1) NOT NULL,
  PRIMARY KEY (user_id),
  UNIQUE INDEX email_UNIQUE (email ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table sql_quiz
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS sql_quiz (
  quiz_id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(45) NOT NULL,
  is_public TINYINT(1) NOT NULL DEFAULT '0',
  author_id INT(11) NOT NULL,
  db_name VARCHAR(45) NOT NULL,
  PRIMARY KEY (quiz_id),
  INDEX fk_sql_quiz_trainer1_idx (author_id ASC),
  INDEX fk_sql_quiz_quiz_db1_idx (db_name ASC),
  CONSTRAINT fk_sql_quiz_quiz_db1
    FOREIGN KEY (db_name)
    REFERENCES quiz_db (db_name)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_sql_quiz_trainer1
    FOREIGN KEY (author_id)
    REFERENCES user (user_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table usergroup
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS usergroup (
  group_id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(45) NOT NULL,
  creator_id INT(11) NOT NULL,
  created_at DATETIME NULL DEFAULT NULL,
  is_closed TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (group_id),
  UNIQUE INDEX name_UNIQUE (name ASC),
  INDEX fk_usergroup_trainer1_idx (creator_id ASC),
  CONSTRAINT fk_usergroup_trainer1
    FOREIGN KEY (creator_id)
    REFERENCES user (user_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table evaluation
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS evaluation (
  evaluation_id INT(11) NOT NULL COMMENT 'evaluation IS A training, so training_id is the PK',
  group_id INT(11) NOT NULL,
  quiz_id INT(11) NOT NULL,
  scheduled_at DATETIME NOT NULL,
  ending_at DATETIME NOT NULL,
  corrected_at DATETIME NULL DEFAULT NULL COMMENT 'completely corrected by the trainer at',
  PRIMARY KEY (evaluation_id),
  INDEX fk_exam_class1_idx (group_id ASC),
  INDEX fk_evaluation_sql_quiz1_idx (quiz_id ASC),
  CONSTRAINT fk_evaluation_sql_quiz1
    FOREIGN KEY (quiz_id)
    REFERENCES sql_quiz (quiz_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_exam_class1
    FOREIGN KEY (group_id)
    REFERENCES usergroup (group_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table group_member
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS group_member (
  user_id INT(11) NOT NULL,
  group_id INT(11) NOT NULL,
  validated_at DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (user_id, group_id),
  INDEX fk_user_has_class_class1_idx (group_id ASC),
  INDEX fk_user_has_class_user1_idx (user_id ASC),
  CONSTRAINT fk_user_has_class_class1
    FOREIGN KEY (group_id)
    REFERENCES usergroup (group_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_user_has_class_user1
    FOREIGN KEY (user_id)
    REFERENCES user (user_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table sheet
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS sheet (
  trainee_id INT(20) NOT NULL,
  evaluation_id INT(11) NOT NULL,
  started_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  ended_at DATETIME NULL DEFAULT NULL COMMENT 'when the trainee terminates his sheet',
  corrected_at DATETIME NULL DEFAULT NULL COMMENT 'validated by the trainer at',
  PRIMARY KEY (trainee_id, evaluation_id),
  INDEX fk_Test_user1_idx (trainee_id ASC),
  INDEX fk_sheet_evaluation1_idx (evaluation_id ASC),
  CONSTRAINT fk_sheet_evaluation1
    FOREIGN KEY (evaluation_id)
    REFERENCES evaluation (evaluation_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Test_user1
    FOREIGN KEY (trainee_id)
    REFERENCES user (user_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table theme
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS theme (
  theme_id INT(11) NOT NULL AUTO_INCREMENT,
  label VARCHAR(255) NOT NULL,
  PRIMARY KEY (theme_id),
  UNIQUE INDEX label_UNIQUE (label ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table sql_question
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS sql_question (
  question_id INT(20) NOT NULL AUTO_INCREMENT,
  db_name VARCHAR(45) NOT NULL,
  question_text VARCHAR(255) NOT NULL,
  correct_answer TEXT NOT NULL,
  correct_result TEXT NULL DEFAULT NULL,
  is_public TINYINT(1) NOT NULL DEFAULT '0',
  theme_id INT(11) NOT NULL,
  author_id INT(11) NOT NULL,
  PRIMARY KEY (question_id),
  INDEX fk_sql_question_theme1_idx (theme_id ASC),
  INDEX fk_sql_question_quiz_db1_idx (db_name ASC),
  INDEX fk_sql_question_trainer1_idx (author_id ASC),
  CONSTRAINT fk_sql_question_quiz_db1
    FOREIGN KEY (db_name)
    REFERENCES quiz_db (db_name)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_sql_question_theme1
    FOREIGN KEY (theme_id)
    REFERENCES theme (theme_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_sql_question_trainer1
    FOREIGN KEY (author_id)
    REFERENCES user (user_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table sql_answer
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS sql_answer (
  question_id INT(20) NOT NULL,
  trainee_id INT(20) NOT NULL,
  evaluation_id INT(11) NOT NULL,
  answer TEXT NULL DEFAULT NULL COMMENT 'query written by the trainee',
  result TEXT NULL DEFAULT NULL,
  given_at DATETIME NULL,
  gives_correct_result TINYINT(1) NULL DEFAULT NULL COMMENT 'validated by the trainer (null if not yet validated or invalidated)',
  PRIMARY KEY (question_id, trainee_id, evaluation_id),
  INDEX fk_answer_question1_idx (question_id ASC),
  INDEX fk_sql_answer_sheet1_idx (evaluation_id ASC, trainee_id ASC),
  CONSTRAINT fk_answer_question1
    FOREIGN KEY (question_id)
    REFERENCES sql_question (question_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_sql_answer_sheet1
    FOREIGN KEY (evaluation_id , trainee_id)
    REFERENCES sheet (evaluation_id , trainee_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table sql_quiz_question
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS sql_quiz_question (
  question_id INT(20) NOT NULL,
  quiz_id INT(11) NOT NULL,
  rank INT(11) NOT NULL COMMENT 'rank of the question in the sql_quiz',
  PRIMARY KEY (question_id, quiz_id),
  INDEX fk_Quizz_has_Question_Question1_idx (question_id ASC),
  INDEX fk_question_quiz1_idx (quiz_id ASC),
  CONSTRAINT fk_question_quiz1
    FOREIGN KEY (quiz_id)
    REFERENCES sql_quiz (quiz_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Quizz_has_Question_Question1
    FOREIGN KEY (question_id)
    REFERENCES sql_question (question_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


CREATE USER 'sql_skills_user'@'localhost' IDENTIFIED BY 'sql_skills_pwd';
GRANT ALL ON sql_skills_2018_11.* TO 'sql_skills_user'@'localhost';
GRANT SELECT ON mysql.proc TO 'sql_skills_user'@'localhost';