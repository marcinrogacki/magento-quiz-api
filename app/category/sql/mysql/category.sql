CREATE TABLE category (
  id INT(10) PRIMARY KEY AUTO_INCREMENT,
  parent_id INT(10),
  category TEXT NOT NULL,
  CONSTRAINT FK_CATEGORY_CATEGORY FOREIGN KEY (parent_id) REFERENCES category (id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO category VALUES(1, 'Back-end', null);
INSERT INTO category VALUES(2, 'Front-end', null);

--  BACKEND --
INSERT INTO category VALUES(3, 'Basics', 1);
INSERT INTO category VALUES(4, 'Request flow', 1);
INSERT INTO category VALUES(5, 'Rendering', 1);
INSERT INTO category VALUES(6, 'Working with Database in Magento', 1);
INSERT INTO category VALUES(7, 'EAV', 1);
INSERT INTO category VALUES(8, 'Adminhtml', 1);
INSERT INTO category VALUES(9, 'Catalog', 1)t
INSERT INTO category VALUES(10, 'Checkout', 1);
INSERT INTO category VALUES(11, 'Sales and Customers', 1);
INSERT INTO category VALUES(12, 'Advanced features', 1);
INSERT INTO category VALUES(13, 'Enterprise edition', 1);

--  FRONTEND --
