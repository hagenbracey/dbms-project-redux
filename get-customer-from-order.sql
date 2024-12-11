SELECT u.name, u.email, o.address
FROM orders o
JOIN users u ON o.customer_id = u.id
WHERE o.tracking_number = '7f047720-ce40-34d8-bdee-f7a68a3f4212';
/* replace that tracking number with one you generated when seeding */