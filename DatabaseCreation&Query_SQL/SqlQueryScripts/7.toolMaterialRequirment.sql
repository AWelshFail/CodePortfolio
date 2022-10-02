SELECT M_Name, I_Description, IN_Quantity
FROM itemnecessary n
INNER JOIN items i
ON n.ItemNo = i.ItemNo
INNER JOIN model m 
ON m.ModelNo = n.ModelNo
WHERE m.ModelNo = 6;
