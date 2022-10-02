SELECT o.OrderNo, CustomerNo, O_Date, l.ModelNo, l.OL_Quantity, (OL_Quantity*OL_Price)TotalCost
FROM ordertable o 
INNER JOIN orderline l
on o.OrderNo = l.OrderNo
WHERE o.OrderNo = (SELECT max(o.OrderNo)
FROM OrderTable);