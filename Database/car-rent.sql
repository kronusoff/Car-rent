CREATE TABLE cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    make VARCHAR(50),
    model VARCHAR(50),
    year INT,
    fuel_consumption VARCHAR(20),
    engine_volume DECIMAL(3,1),
    seating_capacity INT,
    transmission VARCHAR(50),
    child_seat VARCHAR(50),
    charger VARCHAR(50),
    color VARCHAR(20),
    type VARCHAR(20),
    description TEXT,
    image1 VARCHAR(255),
    image2 VARCHAR(255),
    image3 VARCHAR(255)
);
