-- Mecanic Shop --------------------------
-- | Taller Shop DB
-- | Data Base
-- | Software Enginnering
-- | November 13 - 2024
-- | 
-- ----------------------------------------

-- PEOPLE TABLE --------------------------
CREATE TABLE people (
  people_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(100),
  surname VARCHAR(100),
  email VARCHAR(100),
  phone_number INT,
  address VARCHAR(100),
  document_type VARCHAR(100),
  document_number INT UNIQUE NOT NULL,
  people_registration DATE DEFAULT CURDATE(),
);

-- EMPLOYEE TABLE --------------------------
CREATE TABLE employee (
  employee_id INT PRIMARY KEY AUTO_INCREMENT,
  people_id INT,
  job_title VARCHAR(100),
  salary DECIMAL(10, 2),
  department VARCHAR(50),
  FOREIGN KEY (people_id) REFERENCES people(people_id)
);

-- CLIENT TABLE --------------------------
CREATE TABLE client (
  client_id INT PRIMARY KEY AUTO_INCREMENT,
  people_id INT,
  FOREIGN KEY (people_id) REFERENCES people(people_id)
);

-- VEHICLE TABLE --------------------------
CREATE TABLE vehicle (
  vehicle_id INT PRIMARY KEY AUTO_INCREMENT,
  people_id INT,
  number_plate VARCHAR(100),
  brand VARCHAR(100),
  model INT,
  color VARCHAR(20),
  vehicle_type VARCHAR(30),
  FOREIGN KEY (people_id) REFERENCES people(people_id)
);

CREATE TABLE vehicle_status (
  vehicle_status_id INT PRIMARY KEY AUTO_INCREMENT,
  vehicle_id INT,
  general_status TEXT,
  repair_description VARCHAR(255),
  date_registration DATE DEFAULT CURDATE(),
  FOREIGN KEY (vehicle_id) REFERENCES vehicle(vehicle_id)
)

