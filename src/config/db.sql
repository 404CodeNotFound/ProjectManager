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
  username VARCHAR(50),
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

CREATE TABLE sprints (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50),
  project_id INT NOT NULL,
  start_date DATE,
  end_date DATE,
  FOREIGN KEY (project_id) REFERENCES projects(id)
);

CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  status VARCHAR,
  title VARCHAR(200),
  description VARCHAR(500),
  priority INT,
  story_points INT,
  sprint_id INT,
  assigned_to INT,
  FOREIGN KEY (sprint_id) REFERENCES sprints(id),
  FOREIGN KEY (assigned_to) REFERENCES users(id)
);

