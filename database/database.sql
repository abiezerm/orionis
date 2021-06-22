-- Script to create database
CREATE DATABASE IF NOT EXISTS orionis;
USE orionis;

-- Creating tables

CREATE TABLE IF NOT EXISTS customer (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  firstname VARCHAR(255),
  lastname VARCHAR(255),
  email VARCHAR(255),
  phone VARCHAR(20),
  birthdate DATE,
  gender CHAR(1),
  creation_date DATETIME DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS country (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(100),
  code VARCHAR(5)
);

CREATE TABLE IF NOT EXISTS state (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(100),
  code VARCHAR(5),
  country_id int,
  FOREIGN KEY (country_id) REFERENCES country(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- we will be used a simple varchar for this instead. it's to complex to maintain the database updated
-- CREATE TABLE IF NOT EXISTS city (
--   id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
--   name VARCHAR (100),
--   state_id int,
--   FOREIGN KEY (state_id) REFERENCES state(id) ON DELETE CASCADE ON UPDATE CASCADE
-- );


CREATE TABLE IF NOT EXISTS address (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  address_line1 VARCHAR(255),
  address_line2 VARCHAR(255),
  country_id int,
  state_id int,
  city varchar(250), -- city is now a varchar because there are too many cities and keep the database updated is hard for this
  zipcode VARCHAR(10),
  FOREIGN KEY (country_id) REFERENCES country(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (state_id) REFERENCES state(id) ON DELETE CASCADE ON UPDATE CASCADE
-- FOREIGN KEY (city_id) REFERENCES city(id) ON DELETE CASCADE ON UPDATE CASCADE
);


-- many to many pivot table to store many address for a customer
CREATE TABLE IF NOT EXISTS customer_address (
  customer_id int,
  address_id int,
  PRIMARY KEY (customer_id, address_id),
  FOREIGN KEY (customer_id) REFERENCES customer(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (address_id) REFERENCES address(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Version 1
-- CREATE TABLE IF NOT EXISTS address (
--   id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
--   address_line1 VARCHAR(255),
--   address_line2 VARCHAR(255),
--   country VARCHAR(255),
--   city VARCHAR(255),
--   state VARCHAR(255),
--   zipcode VARCHAR(10)
-- );
