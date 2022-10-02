create table ProductType(
	ToolModelNo int not null,
	ToolName varchar(45) not null,
    Size varchar(45),
    material varchar(45),
	Price decimal(5,2),
    quantityOnHand int not null,
    primary key(ToolModelNo)
    
    );
    
create table CustomerDetails(
	customerId int not null,
    name varchar(90) not null,
    address varchar(90) not null,
    phone varchar(11) not null,
    email varchar(50) default null,
    contactFirst varchar(45) DEFAULT NULL,
    contactLast varchar(45) default null,
    
    primary key(customerId)
	);

create table CustomerOrder(
	orderId int not null,
    customerId int not null,
    orderDate timestamp not null,
    primary key (orderId),
    foreign key (customerId) references CustomerDetails(customerId)
	);

create table OrderSummary(
	orderId int not null,
    toolModelNo int not null,
    totalQuantityOrdered int not null,
    primary key (orderId, toolModelNo),
    foreign key (toolModelNo) references ProductType(toolModelNo),
    foreign key (orderId) references CustomerOrder(orderId)
    );

create table SpecificProduct(
	serialNo decimal(5,1),
	toolModelNo int not null,
	orderId int not null,
    primary key(serialNo),
    Foreign key(toolModelNo) references ProductType(toolModelNo),
    foreign key(orderId) references ordersummary(orderId)
    
    );




    
create table ProductReturn(
	returnId int not null,
    orderId int not null,
    customerId int not null,
    returnDate date not null,
    returnDescription varchar(150),
    
    primary key(returnId),
    foreign key (orderId) references CustomerOrder(orderId),
    foreign key (customerId) references CustomerDetails(customerId)
	);
    
create table OrderShipping(
	orderShippingId int not null,
    orderId int not null,
    deliveryAddress varchar(45) not null,
    deliveryName varchar(45) not null,
    shipDate date not null,
    primary key(orderShippingId),
    foreign key (orderId) references CustomerOrder(orderId)
	);
    
create table Fault(
	problemId int not null,
    faultDescription varchar(150),
    primary key (problemId)
	);
    
create table FaultReport(
	faultId int not null,
    toolModelNo int not null,
    problemId int not null,
    customerId int not null,
    primary key (faultId),
    foreign key (toolModelNo) references ProductType(toolModelNo),
    foreign key (problemId) references Fault(problemId),
    foreign key (customerId) references CustomerDetails(customerId)
	);



create table Test(
	testId int not null,
    testDescription varchar(150),
    primary key (testId)
	);

create table TestReport(
	testDate date not null,
	time time not null,
    testId int not null,
	serialNo decimal not null,
    testResultsAndComments varchar(150) default null,
    location varchar(80) not null,
    primary key(testDate, time), 
    
    Foreign key (testId) references Test(testId),
    Foreign key (serialNo) references SpecificProduct(serialNo)
    );

create table RawMaterial(
	rawMaterialNo int not null,
    materialsDescription varchar(150) not null,
    quantityOnHand varchar(50) not null,
    
    primary key(rawMaterialNo)
	);

create table Supplier(
	supplierId int not null,
    supplierName varchar(50) not null,
    supplierAddress varchar(150),
    phoneNumber varchar(11) not null,
    primary key(supplierId)
	);

create table MaterialShipping(
	MaterialShippingId int not null,
	rawMaterialNo int not null,
	supplierId int not null,
    shippedQuantity varchar(50) not null,
    unitCost int not null,
    shipDate date not null,
    primary key(MaterialShippingId), 
    Foreign key (supplierId) references Supplier(supplierId),
    Foreign key (rawMaterialNo) references rawmaterial(rawMaterialNo)
    );



create table SupervisorsRequest(
	rawMaterialNo int not null,
	quantity int not null,
	
    primary key(rawMaterialNo), 
    Foreign key (rawMaterialNo) references rawmaterial(rawMaterialNo)
    
    );

create table LineSchedule(
	lineNo int not null,
    toolModelNo int not null,
    finishDate date not null,
    quantityProduced int not null,
    primary key(lineNo),
    Foreign key (toolModelNo) references producttype(toolModelNo)
    
	);

    create table ManufacturingOrder(
		manufacturingId int not null,
        toolModelNo int not null,
        quantityRequired varchar(45) not null,
        manufacturingDate date not null,
        quantityOnHand int,
        primary key (manufacturingId),
        Foreign key (toolModelNo) references producttype(toolModelNo)
        );
        
	create table ManufacturingSchedule(
		manufacturingId int not null,
        lineNo int not null,
       
        
        primary key (manufacturingId, lineNo),
        foreign key (manufacturingId) references ManufacturingOrder(manufacturingId),
        foreign key (lineNo) references LineSchedule(lineNo)
        );
        
create table MaterialQuantityRequirment(
	rawMaterialNo int not null,
    toolModelNo int not null,
    quantityRequired varchar(50) not null,
    primary key (rawMaterialNo, toolModelNo),
	Foreign key (rawMaterialNo) references rawmaterial(rawMaterialNo),
    Foreign key (toolModelNo) references producttype(toolModelNo)
);