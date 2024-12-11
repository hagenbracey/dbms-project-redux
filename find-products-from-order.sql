SELECT op.product_id, op.quantity
FROM orders o
JOIN order_products op ON o.id = op.order_id
WHERE o.tracking_number = '7f047720-ce40-34d8-bdee-f7a68a3f4212';
/* replace that tracking number with one you generated when seeding */