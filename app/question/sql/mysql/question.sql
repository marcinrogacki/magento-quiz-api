CREATE TABLE question (
  id INT(10) PRIMARY KEY AUTO_INCREMENT,
  category_id int(10) DEFAULT NULL,
  question TEXT NOT NULL,
  CONSTRAINT FK_QUESTION_CATEGORY FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;