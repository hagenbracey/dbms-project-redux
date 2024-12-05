DROP TABLE IF EXISTS Bundles CASCADE;
DROP TABLE IF EXISTS Products CASCADE;
DROP TABLE IF EXISTS Bundle_Products CASCADE;
DROP TABLE IF EXISTS Payments CASCADE;
DROP TABLE IF EXISTS Orders CASCADE;
DROP TABLE IF EXISTS Order_Products CASCADE;



CREATE TABLE Payments(
	id SERIAL PRIMARY KEY,
	cardholder TEXT NOT NULL,
	card_number TEXT NOT NULL,
	cvv TEXT NOT NULL,
	expiration_date TEXT NOT NULL,
	zip_code TEXT NOT NULL
);

/*
CREATE TABLE Users(
	id SERIAL PRIMARY KEY,
	name TEXT NOT NULL,
	password VARCHAR(255) NOT NULL,
	email TEXT NOT NULL,
	payment_id INT,
	FOREIGN KEY (payment_id) REFERENCES Payments(id)
);
*/

CREATE TABLE Bundles(
	id SERIAL PRIMARY KEY,
	name TEXT NOT NULL,
	price NUMERIC(7, 2) NOT NULL,
	description TEXT
);

CREATE TABLE Products(
	id SERIAL PRIMARY KEY,
	name TEXT NOT NULL,
	type TEXT NOT NULL,
	description TEXT,
	price NUMERIC(7,2) NOT NULL,
	manufacturer TEXT NOT NULL
);

CREATE TABLE Bundle_Products(
	bundle_id BIGINT NOT NULL,
	product_id BIGINT NOT NULL,
	PRIMARY KEY (bundle_id, product_id),
	FOREIGN KEY (bundle_id) REFERENCES Bundles(id) ON DELETE CASCADE,
	FOREIGN KEY (product_id) REFERENCES Products(id) ON DELETE CASCADE
);

CREATE TABLE Orders(
	id SERIAL PRIMARY KEY,
	customer_id BIGINT NOT NULL,
	price NUMERIC(7, 2) NOT NULL,
	date_ordered TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	status TEXT NOT NULL,
	address TEXT NOT NULL,
	tracking_number TEXT NOT NULL,
	FOREIGN KEY (customer_id) REFERENCES Users(id) ON DELETE CASCADE
);

create table Order_Products(
	order_id BIGINT NOT NULL,
	product_id BIGINT NOT NULL,
	quantity BIGINT NOT NULL,
	price NUMERIC(7, 2) NOT NULL,
	PRIMARY KEY (order_id, product_id),
	FOREIGN KEY (order_id) REFERENCES Orders(id) ON DELETE CASCADE,
	FOREIGN KEY (product_id) REFERENCES Products(id) ON DELETE CASCADE
);