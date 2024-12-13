SELECT
    p.id AS product_id,
    p.name,
    SUM(op.quantity) AS total_units_sold
FROM
    order_products op
    JOIN products p ON op.product_id = p.id
    JOIN orders o ON op.order_id = o.id
WHERE
    o.date_ordered >= NOW () - INTERVAL '1 year'
GROUP BY
    p.id,
    p.name
ORDER BY
    total_units_sold DESC
LIMIT
    2;