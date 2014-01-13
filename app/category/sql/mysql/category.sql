CREATE TABLE category (
  id INT(10) PRIMARY KEY AUTO_INCREMENT,
  parent_id INT(10),
  category TEXT NOT NULL,
  CONSTRAINT FK_CATEGORY_CATEGORY FOREIGN KEY (parent_id) REFERENCES category (id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO category VALUES(1, null, 'Back-end');
INSERT INTO category VALUES(2, null, 'Front-end');

INSERT INTO category VALUES(3, 1, 'Basics');
INSERT INTO category VALUES(4, 1, 'Request flow');
INSERT INTO category VALUES(5, 1, 'Rendering');
INSERT INTO category VALUES(6, 1, 'Working with Database in Magento');
INSERT INTO category VALUES(7, 1, 'EAV');
INSERT INTO category VALUES(8, 1, 'Adminhtml');
INSERT INTO category VALUES(9, 1, 'Catalog');
INSERT INTO category VALUES(10, 1, 'Checkout');
INSERT INTO category VALUES(11, 1, 'Sales and Customers');
INSERT INTO category VALUES(12, 1, 'Advanced features');
INSERT INTO category VALUES(13, 1, 'Enterprise edition');

INSERT INTO category VALUES(14, 2, 'Use the Magento Design Fallback System');
INSERT INTO category VALUES(15, 2, 'Use Layout XML to Customize a Theme');
INSERT INTO category VALUES(16, 2, 'Create and Customize Template Files');
INSERT INTO category VALUES(17, 2, 'Effectively Use the Magento Block-Template Design System');
INSERT INTO category VALUES(18, 2, 'Identify Where to Locate Files and Create New Files in the Theming-related Directory Structure');
INSERT INTO category VALUES(19, 2, 'Customize and Create JavaScript Within the Magento Framework');
INSERT INTO category VALUES(20, 2, 'Use CSS Effectively to Customize Magento Look and Feel');
INSERT INTO category VALUES(21, 2, 'Customize the Look and Feel of Specific Magento Pages');
INSERT INTO category VALUES(22, 2, 'Correctly Use the Admin Configuration Scopes');
INSERT INTO category VALUES(23, 2, 'Implement Internationalization of Frontend Pages');
