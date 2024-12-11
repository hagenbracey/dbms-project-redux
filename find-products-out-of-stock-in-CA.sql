SELECT p.id, p.name
FROM products p
JOIN inventories i ON i.product_id = p.id
JOIN stores s ON s.id = i.store_id
WHERE s.state = 'CA'
  AND i.quantity = 0
GROUP BY p.id, p.name;
