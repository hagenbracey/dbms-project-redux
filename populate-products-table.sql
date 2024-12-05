TRUNCATE Products CASCADE;


INSERT INTO Products(name, type, description, price, manufacturer)
VALUES (
	'Mouse',
	'PC Accessories',
	'This mouse will help you click all around the page!',
	'4.99',
	'Bracey Co.'
);

INSERT INTO Products(name, type, description, price, manufacturer) 
VALUES (
	'Keyboard',
	'PC Accessories',
	'Introducing a one-of-a-kind keyboard! Type something.',
	'14.99',
	'Bracey Co.'
);

INSERT INTO Products(name, type, description, price, manufacturer) 
VALUES (
	'Better Keyboard',
	'PC Accessories',
	'This keyboard is so much better! The keys light up - hence the price. Type faster guaranteed.',
	'84.99',
	'Bracey Co.'
);

INSERT INTO Products(name, type, description, price, manufacturer) 
VALUES (
	'Small Monitor',
	'Displays',
	'This is a small monitor. Not too big at all!',
	'24.99',
	'Bracey Co.'
);

INSERT INTO Products(name, type, description, price, manufacturer) 
VALUES (
	'Medium Monitor',
	'Displays',
	'This is a medium monitor. Not too big or small!',
	'49.99',
	'Bracey Co.'
);

INSERT INTO Products(name, type, description, price, manufacturer) 
VALUES (
	'Large Monitor',
	'Displays',
	'This is a large monitor. Not too small at all!',
	'74.99',
	'Bracey Co.'
);

SELECT * FROM Products;