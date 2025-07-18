CREATE TABLE booking_services (
  id INT AUTO_INCREMENT PRIMARY KEY,
  booking_id INT NOT NULL,
  service_name VARCHAR(100) NOT NULL,
  FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE
);
