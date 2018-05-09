CREATE DATABASE IF NOT EXISTS `project-manager-db` COLLATE utf8mb4_unicode_ci;
USE `project-manager-db`;

CREATE TABLE projects (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(128),
  start_date DATE,
  end_date DATE,
  overview VARCHAR(1000),
  is_active BOOLEAN,
  owner_id INT NOT NULL,
  FOREIGN KEY (owner_id) REFERENCES users(id)
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(128),
  email VARCHAR(50),
  password VARCHAR(128),
);

CREATE TABLE project_paticipants (
  user_id INT NOT NULL,
  project_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (project_id) REFERENCES projects(id)
);
