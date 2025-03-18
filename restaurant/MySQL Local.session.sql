CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    person INT NOT NULL,
    reservation_date DATE NOT NULL,
    time VARCHAR(10) NOT NULL,
    message TEXT
);

