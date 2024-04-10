DROP DATABASE IF EXISTS contacts_app;

CREATE DATABASE contacts_app;

USE contacts_app;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255)
);

INSERT INTO users (name, email, password) VALUES ("Ram", "ram@test.com", "1234");


CREATE TABLE contacts(
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  user_id INT NOT NULL,
  phone_number VARCHAR(255),

  Foreign Key (user_id) REFERENCES users(id)
);
