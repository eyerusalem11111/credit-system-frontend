-- Create database
CREATE DATABASE credit_system;
USE credit_system;

-- Users table: shop owners and customers
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  role ENUM('owner','customer') NOT NULL,
  phone VARCHAR(20) UNIQUE,
  email VARCHAR(100) UNIQUE,
  credit_limit DECIMAL(10,2) DEFAULT 0.00,
  password VARCHAR(255) NOT NULL
);

-- Transactions table: credits and repayments
CREATE TABLE transactions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  type ENUM('credit','repayment') NOT NULL,
  amount DECIMAL(10,2) NOT NULL,
  date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
ALTER TABLE users ADD COLUMN profile_image VARCHAR(255) NULL;


-- Reminders table: scheduled notifications
CREATE TABLE reminders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  message VARCHAR(255),
  due_date DATE NOT NULL,
  status ENUM('pending','sent') DEFAULT 'pending',
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Sample shop owner
INSERT INTO users (name, role, phone, email, credit_limit, password)
VALUES ('Admin Shop', 'owner', '0912345678', 'admin@shop.com', 0.00, 'admin123');

-- Sample customers
INSERT INTO users (name, role, phone, email, credit_limit, password)
VALUES 
('Customer One', 'customer', '0923456789', 'cust1@mail.com', 1000.00, 'pass1'),
('Customer Two', 'customer', '0934567890', 'cust2@mail.com', 500.00, 'pass2');

-- Sample transactions
INSERT INTO transactions (user_id, type, amount)
VALUES 
(2, 'credit', 200.00),
(2, 'repayment', 50.00),
(3, 'credit', 300.00);

-- Sample reminders
INSERT INTO reminders (user_id, message, due_date)
VALUES 
(2, 'Payment due soon', '2026-05-10'),
(3, 'Outstanding balance reminder', '2026-05-12');
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  role VARCHAR(20)
);

INSERT INTO users (name, email, password, role)
VALUES ('Queen', 'queen@example.com', PASSWORD('12345'), 'owner');
UPDATE users SET password = PASSWORD('admin123') WHERE email='admin@shop.com';
UPDATE users SET password = PASSWORD('pass1') WHERE email='cust1@mail.com';
UPDATE users SET password = PASSWORD('pass2') WHERE email='cust2@mail.com';
