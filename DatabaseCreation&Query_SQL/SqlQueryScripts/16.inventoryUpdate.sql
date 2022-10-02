UPDATE Model
SET M_Quantity = M_Quantity + (SELECT(LP_Quantity) FROM lineprogram WHERE ModelNo = 1)
WHERE ModelNo = 1;

UPDATE Model
SET M_Quantity = M_Quantity + (SELECT(LP_Quantity) FROM lineprogram WHERE ModelNo = 3)
WHERE ModelNo = 3;

UPDATE Model
SET M_Quantity = M_Quantity + (SELECT(LP_Quantity) FROM lineprogram WHERE ModelNo = 5)
WHERE ModelNo = 5;

UPDATE Model
SET M_Quantity = M_Quantity + (SELECT(LP_Quantity) FROM lineprogram WHERE ModelNo = 11)
WHERE ModelNo = 11;

SELECT ModelNo, M_Name, M_Quantity
FROM Model 
WHERE ModelNo = 1 
OR ModelNo = 3
OR ModelNo = 5
OR ModelNo = 11