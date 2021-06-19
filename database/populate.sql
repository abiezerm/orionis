-- Populate data

-- Truncate Existing Data
SET FOREIGN_KEY_CHECKS = 0; 
TRUNCATE TABLE customer;
TRUNCATE TABLE country;
TRUNCATE TABLE state;
TRUNCATE TABLE city;
TRUNCATE TABLE address;
TRUNCATE TABLE customer_address;
SET FOREIGN_KEY_CHECKS = 1;

-- customer
INSERT INTO customer (firstname, lastname, email, phone, gender, birthdate)
VALUES ('Jean', 'Urena', 'jeanurena@test.com', '8091234567', 'M', '1999-02-16');

INSERT INTO customer (firstname, lastname, email, phone, gender, birthdate)
VALUES ('Ana', 'Reyes', 'anareyes@test.com', '8095555555', 'F', '2000-12-31');

INSERT INTO customer (firstname, lastname, email, phone, gender, birthdate)
VALUES ('Heidy', 'Rosario', 'heidyr@test.com', '8093809780', 'U', '1980-01-01');


-- country

INSERT INTO country (name, code) VALUES ('Dominican Republic', 'DO');
INSERT INTO country (name, code) VALUES ('United States', 'US');
INSERT INTO country (name, code) VALUES ('Japan', 'JP');


-- STATE OR Provinces

-- USA
INSERT INTO state (name, code, country_id) VALUES ('Alabama', 'AL', 2);
INSERT INTO state (name, code, country_id) VALUES ('Florida', 'FL', 2);


-- city

-- Alabama
INSERT INTO city (name, state_id) VALUES ('Madison', 1); 
INSERT INTO city (name, state_id) VALUES ('Florence', 1); 

-- Florida
INSERT INTO city (name, state_id) VALUES ('Doral', 2); 
INSERT INTO city (name, state_id) VALUES ('Miami', 2); 


-- address

INSERT INTO address (address_line1, address_line2, country_id, state_id, city_id, zipcode)
VALUES ('8400 N.W. 25th Street', 'SUITE 101', 2, 2, 3, '33198');

INSERT INTO address (address_line1, address_line2, country_id, state_id, city_id, zipcode)
VALUES ('8540 NW 66 Street', 'SUITE 102', 2, 2, 4, '33195');


-- customer_address pivot table

INSERT INTO customer_address (customer_id, address_id) VALUES (1, 1);
INSERT INTO customer_address (customer_id, address_id) VALUES (1, 2);

