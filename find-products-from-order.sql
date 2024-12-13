SELECT
    op.product_id,
    op.quantity
FROM
    orders o
    JOIN order_products op ON o.id = op.order_id
WHERE
    o.tracking_number = '123456';