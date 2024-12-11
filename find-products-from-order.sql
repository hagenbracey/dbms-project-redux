SELECT op.product_id, op.quantity
FROM orders o
JOIN order_products op ON o.id = op.order_id
WHERE o.tracking_number = '1dd20246-96bd-39b8-b8fb-3b36d0f60904';
/* replace that tracking number with one you generated when seeding */