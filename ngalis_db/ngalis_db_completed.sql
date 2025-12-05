-- Completed ngalis_db schema
DROP DATABASE IF EXISTS ngalis_db;
CREATE DATABASE ngalis_db;
USE ngalis_db;

CREATE TABLE categories (
  category_id INT(11) NOT NULL AUTO_INCREMENT,
  category_name VARCHAR(255) NOT NULL,
  PRIMARY KEY (category_id)
) ENGINE=InnoDB;

CREATE TABLE customers (
  customer_id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  phone VARCHAR(50) NOT NULL,
  address VARCHAR(255) NOT NULL,
  PRIMARY KEY (customer_id)
) ENGINE=InnoDB;

CREATE TABLE products (
  product_id INT(11) NOT NULL AUTO_INCREMENT,
  product_name VARCHAR(255) NOT NULL,
  category_id INT(11) DEFAULT NULL,
  price DOUBLE NOT NULL,
  stock_quantity INT(11) NOT NULL,
  expiry_date DATE,
  PRIMARY KEY (product_id),
  KEY fk_product_category (category_id),
  CONSTRAINT fk_product_category FOREIGN KEY (category_id)
    REFERENCES categories (category_id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE orders (
  order_id INT(11) NOT NULL AUTO_INCREMENT,
  order_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  customer_id INT(11) DEFAULT NULL,
  total_amount DOUBLE NOT NULL,
  PRIMARY KEY (order_id),
  KEY fk_order_customer (customer_id),
  CONSTRAINT fk_order_customer FOREIGN KEY (customer_id)
    REFERENCES customers (customer_id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE order_items (
  order_itemsid INT(11) NOT NULL AUTO_INCREMENT,
  quantity INT(11) NOT NULL,
  unit_price DOUBLE NOT NULL,
  order_id INT(11) DEFAULT NULL,
  product_id INT(11) DEFAULT NULL,
  PRIMARY KEY (order_itemsid),
  KEY fk_orderitems_order (order_id),
  KEY fk_orderitems_product (product_id),
  CONSTRAINT fk_orderitems_order FOREIGN KEY (order_id)
    REFERENCES orders (order_id) ON DELETE CASCADE,
  CONSTRAINT fk_orderitems_product FOREIGN KEY (product_id)
    REFERENCES products (product_id) ON DELETE RESTRICT
) ENGINE=InnoDB;
