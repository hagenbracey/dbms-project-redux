SELECT * FROM payments p 
INNER JOIN users u
ON p.user_id = u.id;