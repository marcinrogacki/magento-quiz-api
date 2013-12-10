CREATE TABLE user (
  email VARCHAR(255) PRIMARY KEY NOT NULL,
  password BINARY(64) NOT NULL,
  session VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO user VALUES('mrogacki@nexway.com', sha2('mrogacki0no_rainbow_please', 256), null);

--  FRONTEND --
