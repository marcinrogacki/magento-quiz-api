CREATE TABLE user (
  email VARCHAR(255) PRIMARY KEY NOT NULL,
  password BINARY(64) NOT NULL,
  name VARCHAR(255),
  surname VARCHAR(255) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO user VALUES('mrogacki@nexway.com', sha2('mrogacki0no_rainbow_please', 256), 'Marcin', 'Rogacki');
INSERT INTO user VALUES('mtasak@nexway.com', sha2('mtasak0no_rainbow_please', 256), 'Mariusz', 'Tasak');
