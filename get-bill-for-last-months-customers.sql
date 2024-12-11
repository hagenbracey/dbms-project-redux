SELECT 
    u.id AS customer_id,
    u.name AS customer_name,
    SUM(o.price) AS total_spent,
    COUNT(o.id) AS total_orders,
    MIN(o.date_ordered) AS first_order_date,
    MAX(o.date_ordered) AS last_order_date
FROM users u
JOIN orders o ON u.id = o.customer_id
WHERE o.date_ordered >= NOW() - INTERVAL '1 MONTH'
GROUP BY u.id, u.name
ORDER BY total_spent DESC;
