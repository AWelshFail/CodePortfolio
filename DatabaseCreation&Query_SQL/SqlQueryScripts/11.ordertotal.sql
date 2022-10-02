SELECT o.OrderNo, CustomerNo, o_Date, SUM(OL_Quantity*OL_Price)TotalCost
FROM ordertable o 
INNER JOIN orderline l 
ON o.OrderNo = l.OrderNo
WHERE o.OrderNo = (SELECT max(o.OrderNo)
FROM OrderTable);