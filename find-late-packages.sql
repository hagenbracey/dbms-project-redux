SELECT
    o.id AS order_id,
    o.tracking_number,
    o.date_ordered,
    o.status
FROM
    orders o
WHERE
    o.status = 'late'
    AND o.date_ordered + INTERVAL '3 days' < NOW ();