INSERT INTO manufactureRequest (ModelNo, ManufactureDate, MO_Quantity, MO_Status)
SELECT ModelNo, current_date(), OL_Quantity, 'In Progress'
FROM orderline where OrderNo = 3;

SELECT * FROM manufactureRequest WHERE manufactureDate = current_date();