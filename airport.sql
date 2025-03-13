DROP DATABASE IF EXISTS Airport;
CREATE DATABASE Airport;
USE Airport;
CREATE TABLE Users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL UNIQUE,
    pass VARCHAR(255) NOT NULL
);
CREATE TABLE Flights (
    id INT PRIMARY KEY AUTO_INCREMENT,
    origin VARCHAR(100) NOT NULL,
    destination VARCHAR(100) NOT NULL,
    start_date DATE NOT NULL,
    tickets_available INT NOT NULL CHECK (tickets_available >= 0),
    price DECIMAL(10,2) NOT NULL CHECK (price >= 0),
    duration TIME NOT NULL,
    airline VARCHAR(100) NOT NULL,
    departure TIME NOT NULL,
    arrival TIME NOT NULL
);
CREATE TABLE Orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_price DECIMAL(10,2) NOT NULL CHECK (total_price >= 0),
    FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE
);
CREATE TABLE Order_Items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    flight_id INT NOT NULL,
    tickets_count INT NOT NULL CHECK (tickets_count > 0),
    price_per_ticket DECIMAL(10,2) NOT NULL CHECK (price_per_ticket >= 0),
    total_price DECIMAL(10,2) NOT NULL CHECK (total_price >= 0),
    FOREIGN KEY (order_id) REFERENCES Orders(id),
    FOREIGN KEY (flight_id) REFERENCES Flights(id)
);
INSERT INTO Flights (origin, destination, start_date, tickets_available, price, duration, airline, departure, arrival) VALUES
('KTW', 'WAW', '2025-03-10', 50, 199.99, '01:00:00', 'LOT Polish Airlines', '08:00:00', '09:00:00'),
('WAW', 'JFK', '2025-03-12', 200, 1999.99, '09:30:00', 'LOT Polish Airlines', '13:00:00', '22:30:00'),
('LAX', 'WAW', '2025-04-05', 100, 2800.00, '11:20:00', 'LOT Polish Airlines', '14:00:00', '11:20:00'),
('WAW', 'DXB', '2025-03-15', 180, 1800.00, '06:10:00', 'Emirates', '12:00:00', '18:10:00'),
('DXB', 'SYD', '2025-03-18', 170, 3200.00, '13:45:00', 'Emirates', '23:30:00', '13:15:00'),
('SYD', 'DXB', '2025-03-22', 160, 3100.00, '14:00:00', 'Emirates', '21:00:00', '11:00:00'),
('DXB', 'FRA', '2025-03-25', 140, 1500.00, '06:50:00', 'Emirates', '02:00:00', '08:50:00'),
('KTW', 'TFS', '2025-06-10', 180, 899.00, '05:50:00', 'Enter Air', '10:00:00', '15:50:00'),
('WAW', 'HER', '2025-06-12', 200, 749.99, '02:45:00', 'Enter Air', '06:00:00', '08:45:00'),
('WAW', 'PMI', '2025-07-05', 190, 799.00, '03:00:00', 'Enter Air', '12:00:00', '15:00:00'),
('GDN', 'RHO', '2025-07-15', 170, 850.00, '03:15:00', 'Enter Air', '09:00:00', '12:15:00'),
('KTW', 'LCA', '2025-06-20', 180, 899.00, '03:30:00', 'Enter Air', '10:00:00', '13:30:00'),
('WAW', 'LCA', '2025-06-25', 200, 850.00, '03:20:00', 'Enter Air', '08:00:00', '11:20:00'),
('GDN', 'LCA', '2025-07-10', 190, 870.00, '03:35:00', 'Enter Air', '12:30:00', '16:05:00'),
('WAW', 'LCA', '2025-07-15', 150, 1100.00, '03:25:00', 'LOT Polish Airlines', '14:00:00', '17:25:00'),
('LCA', 'WAW', '2025-07-22', 150, 1050.00, '03:20:00', 'LOT Polish Airlines', '18:00:00', '21:20:00'),
('WAW', 'MLE', '2025-12-01', 100, 4000.00, '09:00:00', 'LOT Polish Airlines', '14:00:00', '22:00:00'),
('DXB', 'MLE', '2025-12-05', 180, 2200.00, '08:45:00', 'Emirates', '10:00:00', '20:45:00'),
('WAW', 'FNC', '2025-10-10', 150, 1500.00, '04:00:00', 'LOT Polish Airlines', '06:00:00', '10:00:00'),
('LIS', 'FNC', '2025-10-15', 200, 600.00, '02:30:00', 'TAP Portugal', '08:00:00', '10:30:00'),
('CDG', 'PPT', '2025-11-05', 120, 3300.00, '23:00:00', 'Air Tahiti Nui', '14:00:00', '23:00:00'),
('LAX', 'PPT', '2025-11-10', 150, 3000.00, '08:00:00', 'Air France', '12:00:00', '21:00:00');
