INSERT INTO shipping(ModelNo, OrderNo, Sh_Date)
VALUES ((SELECT max(SerialNo) FROM inventory WHERE OrderNo = 3 AND ModelNo = 1), '3', '2022/04/13');
DELETE FROM inventory
WHERE serialNo = (SELECT max(SerialNo) WHERE OrderNo = 3 AND ModelNo = 1);

SELECT * FROM shipping