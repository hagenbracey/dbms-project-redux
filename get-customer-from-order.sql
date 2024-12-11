SELECT u.name, u.email, o.address
FROM orders o
JOIN users u ON o.customer_id = u.id
WHERE o.tracking_number = '1dd20246-96bd-39b8-b8fb-3b36d0f60904';
/* replace that tracking number with one you generated when seeding */