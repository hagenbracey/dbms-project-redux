SELECT u.id AS customer_id, u.name, SUM(o.price) AS dollars_spent
FROM orders o
JOIN users u ON o.customer_id = u.id
WHERE o.date_ordered >= NOW() - INTERVAL '1 year'
GROUP BY u.id, u.name
ORDER BY dollars_spent DESC
LIMIT 1;