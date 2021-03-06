CREATE TABLE answer (
  id INT(10) AUTO_INCREMENT,
  question_id int(10) NOT NULL, 
  value TEXT NOT NULL,
  is_valid TINYINT(1),
  PRIMARY KEY (id),
  CONSTRAINT FK_ANSWER_QUESTION FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
