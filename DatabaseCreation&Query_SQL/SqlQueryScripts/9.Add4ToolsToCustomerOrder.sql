INSERT INTO orderline (OrderNo, ModelNo, OL_Quantity, OL_Price, OL_Status) 
values
((SELECT max(OrderNo) FROM OrderTable), '3', '1', '15.75', 'pending'),
((SELECT max(OrderNo) FROM OrderTable), '5', '2', '8.40', 'pending'),
((SELECT max(OrderNo) FROM OrderTable), '1', '1', '13.75', 'pending'),
((SELECT max(OrderNo) FROM OrderTable), '11', '3', '1.50', 'pending');