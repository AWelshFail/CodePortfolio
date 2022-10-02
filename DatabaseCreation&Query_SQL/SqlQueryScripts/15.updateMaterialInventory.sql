UPDATE items
SET I_Quantity = I_Quantity + (SELECT(IOL_Quantity) FROM itemorderline WHERE ItemOrderNo = 4)
WHERE ItemNo = 1;

SELECT ItemNo, I_Name, I_Quantity
FROM items
WHERE ItemNo = 1;