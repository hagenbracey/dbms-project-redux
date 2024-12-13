SELECT
    u.name,
    u.email,
    o.address
FROM
    orders o
    JOIN users u ON o.customer_id = u.id
WHERE
    o.tracking_number = '123456';