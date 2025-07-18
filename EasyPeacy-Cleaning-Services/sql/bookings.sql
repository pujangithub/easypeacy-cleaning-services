CREATE TABLE bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(100) NOT NULL,
  last_name VARCHAR(100) NOT NULL,
  company_name VARCHAR(150),
  email VARCHAR(150) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  street1 VARCHAR(255) NOT NULL,
  street2 VARCHAR(255),
  city VARCHAR(100) NOT NULL,
  bathrooms INT NOT NULL,
  bedrooms INT,
  last_cleaned VARCHAR(255),
  available_days TEXT,
  services TEXT,
  notes_combined TEXT,
  status ENUM('pending', 'completed') DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
