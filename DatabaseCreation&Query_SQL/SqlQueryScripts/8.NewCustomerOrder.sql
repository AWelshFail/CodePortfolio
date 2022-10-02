INSERT INTO orderTable (O_Date, O_Status, CustomerNo)
VALUE ('2022/04/13', 'Pending', 1);

SELECT *
FROM ordertable
WHERE orderNo = (SELECT max(OrderNo) FROM OrderTable)
