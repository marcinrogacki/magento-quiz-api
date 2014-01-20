CREATE TABLE user (
  email VARCHAR(255) PRIMARY KEY NOT NULL,
  password BINARY(64) NOT NULL,
  name VARCHAR(255),
  surname VARCHAR(255) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO user VALUES('mrogacki@nexway.com', sha2('yQxTv3drRkM=no_rainbow_please', 256), 'Marcin', 'Rogacki');
INSERT INTO user VALUES('mtasak@nexway.com', sha2('AP57Jsxcy80=no_rainbow_please', 256), 'Mariusz', 'Tasak');
INSERT INTO user VALUES('gpawlik@nexway.com', sha2('ZCELT6Ah6wI=no_rainbow_please', 256), 'Grzegorz', 'Pawlik');
INSERT INTO user VALUES('madamiak@nexway.com', sha2('28kdJQxQL7M=no_rainbow_please', 256), 'Michal', 'Adamiak');
INSERT INTO user VALUES('llach@nexway.com', sha2('8xhivpJIPpA=no_rainbow_please', 256), 'Łukasz', 'Lach');
INSERT INTO user VALUES('jgautheron@nexway.com', sha2('1fidoRRrbNk=no_rainbow_please', 256), 'Jonathan', 'Gautheron');

INSERT INTO user VALUES('dduda@nexway.com', sha2('YS+0c/VyLxM=no_rainbow_please', 256), 'Damian', 'Duda');
INSERT INTO user VALUES('kgorecki@nexway.com', sha2('x48WaX7Kj/k=no_rainbow_please', 256), 'Karol', 'Górecki');
INSERT INTO user VALUES('mmaron@nexway.com', sha2('EloAa2GO6Vw=no_rainbow_please', 256), 'Mariusz', 'Maroń');

INSERT INTO user VALUES('ceble@nexway.com', sha2('A9YHanGr7Vw=no_rainbow_please', 256), 'Christophe', 'Eblé');

INSERT INTO user VALUES('api@nexway.com', sha2('yloHa2G86Vw=no_rainbow_please', 256), 'Api', 'User');
