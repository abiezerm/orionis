use orionis;
select * from customer;
SELECT * from address;
select * from state;
select * from city;
SELECT * FROM customer_address;

INSERT INTO customer_address (customer_id, address_id) VALUES (10, 10);


SELECT 
	customer.id,
    customer.firstname, 
    customer.lastname,
    address.address_line1,
    address.address_line2,
    country.name as country_name,
    state.name as state_name,
    city.name as city_name
FROM customer_address
INNER JOIN customer ON customer.id = customer_address.customer_id
INNER JOIN address ON address.id = customer_address.address_id
INNER JOIN country ON country.id = address.country_id
INNER JOIN state ON state.id = address.state_id
INNER JOIN city ON city.id = address.city_id
WHERE customer_address.customer_id = 1;
