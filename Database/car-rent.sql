-- Создаем базу данных
CREATE DATABASE Car_Parking_Management_System;
USE Car_Parking_Management_System;

-- Создаем таблицу пользователей
CREATE TABLE Users(
    UserID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
    UserName varchar(50) NOT NULL UNIQUE,
    FirstName varchar(50) NOT NULL,
    LastName varchar(50) NOT NULL,
    Password varchar(50) NOT NULL,
    PhoneNumber varchar(50) NOT NULL UNIQUE,
    LicenceNumber varchar(50) NOT NULL,
    NIDNumber varchar(50) NOT NULL,
    Gender varchar(10) NOT NULL,
    UserType varchar(50) NOT NULL,
    Images LONGBLOB NOT NULL
);

-- Создаем таблицу владельцев
CREATE TABLE Owner(
    OwnerId int AUTO_INCREMENT NOT NULL PRIMARY KEY,
    UserName varchar(50) NOT NULL UNIQUE,
    FirstName varchar(50) NOT NULL,
    LastName varchar(50) NOT NULL,
    Password varchar(50) NOT NULL,
    PhoneNumber varchar(50) NOT NULL UNIQUE,
    NIDNumber varchar(50) NOT NULL,
    Gender varchar(10) NOT NULL,
    ParkingSlots int NOT NULL,
    Price int NOT NULL,
    Images LONGBLOB NOT NULL
);

-- Создаем таблицу адресов владельцев
CREATE TABLE OwnersAddress(
    OwnerId int NOT NULL,
    AddressId int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    Area VARCHAR(50) NOT NULL,
    Sector VARCHAR(50) NOT NULL,
    RodeNumber VARCHAR(50) NOT NULL,
    HouseNumber VARCHAR(50) NOT NULL,
    CONSTRAINT FK_Owner_Address FOREIGN KEY (OwnerId) REFERENCES Owner(OwnerId)
);

-- Создаем таблицу парковочных мест
CREATE TABLE ParkingSlot(
    OwnerId int NOT NULL,
    SlotId int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    PhoneNumber varchar(11) NOT NULL,
    StartingTime varchar(50) NULL,
    Duration varchar(10) NULL,
    Reserved int NOT NULL DEFAULT 0,
    Price decimal(10,2) NULL,
    EndingTime varchar(50) NULL,
    TotalBill decimal(10,2) NULL,
    CONSTRAINT FK_Owner_Slot FOREIGN KEY (OwnerId) REFERENCES Owner(OwnerId)
);

-- Создаем таблицу использования парковочных мест
CREATE TABLE Uses(
    SlotId int NOT NULL,
    UserID int NOT NULL,
    OwnerId int NOT NULL,
    StartingTime varchar(50) NULL,
    EndingTime varchar(50) NULL,
    Duration int NULL,
    TotalBill decimal(10,2) NULL,
    CONSTRAINT FK_Uses_Slot FOREIGN KEY (SlotId) REFERENCES ParkingSlot(SlotId),
    CONSTRAINT FK_Uses_User FOREIGN KEY (UserID) REFERENCES Users(UserID),
    CONSTRAINT FK_Uses_Owner FOREIGN KEY (OwnerId) REFERENCES Owner(OwnerId)
);

-- Пример вставки данных в таблицу ParkingSlot
INSERT INTO ParkingSlot (OwnerId, PhoneNumber, Reserved, Price)
VALUES (2001, '014897249', 0, 10);

-- Обновление информации о парковочном месте
UPDATE ParkingSlot
SET StartingTime = NULL, Duration = NULL, EndingTime = NULL, Reserved = 0, TotalBill = 0
WHERE PhoneNumber = '01734089033';

-- Выборка для истории использования
SELECT Owner.FirstName, Uses.StartingTime, Uses.EndingTime, Uses.Duration, Uses.TotalBill
FROM Uses
FULL JOIN Owner ON Owner.OwnerId = Uses.OwnerId
WHERE Uses.UserID = 1001;
