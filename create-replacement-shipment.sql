WITH original_order AS (
    SELECT o.customer_id, o.payment_id, o.address
    FROM orders o
    WHERE o.tracking_number = '1dd20246-96bd-39b8-b8fb-3b36d0f60904'
	/* replace that tracking number with one you generated when seeding */
),
new_order AS (
    INSERT INTO orders (customer_id, payment_id, price, date_ordered, status, address, tracking_number, created_at, updated_at)
    SELECT customer_id, payment_id, 0, NOW(), 'pending', address, 'new_tracking_number', NOW(), NOW()
    FROM original_order
    RETURNING id
)
INSERT INTO order_products (order_id, product_id, quantity, price)
SELECT new_order.id, op.product_id, op.quantity, op.price
FROM order_products op
JOIN orders o ON op.order_id = o.id
JOIN new_order ON TRUE
WHERE o.tracking_number = '1dd20246-96bd-39b8-b8fb-3b36d0f60904';
/* replace that tracking number with one you generated when seeding */