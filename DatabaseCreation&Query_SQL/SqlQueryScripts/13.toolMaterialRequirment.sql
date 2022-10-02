SELECT m.M_Name, I.I_Name, IN_Quantity
FROM itemnecessary n 
INNER JOIN items i
ON i.ItemNo = n.ItemNo
INNER JOIN Model m 
ON m.ModelNo = n.ModelNo
INNER JOIN orderline o 
ON o.ModelNo = m.ModelNo
WHERE o.ModelNo = 5