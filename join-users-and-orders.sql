SELECT name FROM users u
INNER JOIN orders o
ON o.customer_id = u.id;