create table if not exists Model(
	ModelNo int AUTO_INCREMENT Primary Key,
    M_Name VARCHAR(30) Not null,
    M_Description VARCHAR(100),
    M_Material VARCHAR(100),
    M_Price DECIMAL(10,2) not null,
    M_Size VARCHAR(30),
    M_Quantity int
);

create table if not exists Items(
	ItemNo int AUTO_INCREMENT Primary Key,
    I_Name VARCHAR(30) Not null,
    I_Description VARCHAR(100),
    I_Quantity int not null,
    I_Quantity_Unit VARCHAR(45)
);

create table if not exists ItemNecessary(
	ItemNo int not null,
    ModelNo int not null,
    IN_Quantity int not null,
    FOREIGN KEY (ItemNo)
		REFERENCES Items(ItemNo),
	FOREIGN KEY (ModelNo)
		REFERENCES Model(ModelNo),
	PRIMARY KEY(ItemNo, ModelNo)
);

create table if not exists TestingTypes(
	TestingTypeNo int,
    TT_Description varchar(100)
);

create table if not exists TestingReports(
	ModelNo int not null,
    FOREIGN KEY(ModelNo)
		REFERENCES Model(ModelNo),
    TR_Date DATE not null,
    PRIMARY KEY(ModelNo, TR_Date),
    TR_TestTypeNo int not null,
    foreign key(TR_TestTypeNo)
		references TestingTypes(TR_TestTypeNo),
    
    TR_Location VARCHAR(30),
    
    TR_TestDescription VARCHAR(100),
    TR_TestResultsAndComments VARCHAR(200)
);

create table if not exists AssemblyLine(
	AssemblyLineNo int AUTO_INCREMENT primary key,
    AL_Status VARCHAR(30)
);

create table if not exists LineProgram(
	AssemblyLineNo int,
	Foreign key(AssemblyLineNo)
		references AssemblyLine(AssemblyLineNo),
	LP_Date DATE not null,
    Primary key(AssemblyLineNo, LP_Date),
    ModelNo int,
    Foreign key(ModelNo)
		references Model(ModelNo),
	LP_Quantity int not null
);

create table if not exists Supplier(
	SupplierNo int AUTO_INCREMENT primary key,
    S_FirstName VARCHAR(20) not null,
    S_LastName VARCHAR(20),
    S_Email VARCHAR(30) not null,
    S_PhoneNo VARCHAR(15) not null
);

create table if not exists ItemOrder(
	ItemOrderNo int primary key,
    SupplierNo int,
    Foreign key(SupplierNo)
		references Supplier(SupplierNo),
	IO_Quantity varchar(45),
	IO_Date DATE
);

create table if not exists ItemOrderLine(
	ItemOrderNo int,
    ItemNo int,
    foreign key(ItemOrderNo)
		references ItemOrder(ItemOrderNo),
	foreign key(ItemNo)
		references Items(ItemNo),
	Primary key(ItemOrderNo, ItemNo),
    IOL_Quantity int not null,
    IOL_Price DECIMAL(10,2) not null
);

create table if not exists Customer(
	CustomerNo int AUTO_INCREMENT primary key,
    C_Name VARCHAR(30) Not null,
    C_Address VARCHAR(30) not null,
    C_PostCode Varchar(10) not null,
    C_PhoneNo VARCHAR(15) not null,
    C_Email VARCHAR(30) not null,
    Corporate VARCHAR(10) not null,
    DateAccountOpened DATE not null,
    CP_FirstName VARCHAR(30),
    CP_LastName VARCHAR(30)
);

create table if not exists OrderTable(
	OrderNo int AUTO_INCREMENT primary key,
    O_Date DATE not null,
    O_Status VARCHAR(10) not null,
    CustomerNo int,
    foreign key (CustomerNo)
		references Customer(CustomerNo)
);

create table if not exists Inventory(
	SerialNumber int,
    ModelNo int,
    foreign key(ModelNo)
		references Model(ModelNo),
    primary key(SerialNumber, ModelNo),
	DateOfManufacture Date not null,
    In_Status VARCHAR(20),
    Sh_Date Date,
    OrderNo int,
    foreign key (OrderNo)
		references OrderTable(OrderNo)
);

create table if not exists OrderLine(
	OrderNo int,
    foreign key(OrderNo)
		references OrderTable(OrderNo),
	ModelNo int,
    foreign key(ModelNo)
		references Model(ModelNo),
	primary key(OrderNo, ModelNo),
    OL_Quantity int not null,
    OL_Price decimal(10,2) not null,
    OL_Status VARCHAR(20) not null
);

create table if not exists FaultType(
	FaultTypeNo int Auto_Increment primary key,
    FT_Description VARCHAR(100)
);

create table if not exists Shipping(
	ShippingId int AUTO_INCREMENT primary key,
    ModelNo int,
    foreign key(ModelNo)
		references Model(ModelNo),
	Sh_Quantity int not null,
    Sh_Date Date not null
);

create table if not exists FaultReport(
	FR_Date Date,
    SerialNo int,
    foreign key(SerialNo)
		references Inventory(SerialNo),
	primary key (FR_Date, SerialNo),
    ModelNo int,
    foreign key(ModelNo)
		references Model(ModelNo),
    OrderNo int,
    foreign key(OrderNo)
		references OrderTable(OrderNo),
	FaultTypeNo int,
    foreign key(FaultTypeNo)
		references FaultType(FaultTypeNo),
	CustomerNo int,
    foreign key(CustomerNo)
		references Customer(CustomerNo),
	FR_Description VARCHAR(100),
    FR_Time date
      
);








