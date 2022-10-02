INSERT INTO itemorder(ItemOrderNo, SupplierNo, IO_Date)
VALUES ((SELECT (max(ItemOrderNo)+1) FROM itemorderline), '2', '2022/04/11');

INSERT INTO itemorder(ItemOrderNo, SupplierNo, IO_Date)
VALUES ((SELECT (max(ItemOrderNo)) FROM itemorder), '1', '15 meters', '500');

SELECT l.ItemOrderNo, ItemNo, IOL_Quantity, i.SupplierNo
FROM itemorderline l
INNER JOIN itemorder i 
ON l.ItemOrderNo = i.ItemOrderNo
WHERE l.ItemOrderNo =(SELECT (max(ItemOrderNo)) FROM itemorder);