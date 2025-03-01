<?php

const SQL_DATABASE = "
    CREATE TABLE IF NOT EXISTS Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    lastname VARCHAR(50) NOT NULL,
    firstname Varchar(50) NOT NULL,
    email VARCHAR(100),
    password VARCHAR(250),
    role ENUM('Manager', 'User') DEFAULT 'User',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);

    CREATE TABLE IF NOT EXISTS categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL UNIQUE
    );

    CREATE TABLE IF NOT EXISTS projects (
    project_id INT AUTO_INCREMENT PRIMARY KEY,
    project_name VARCHAR(255) NOT NULL,
    project_owner_id INT,
    category_id INT,
    status ENUM('Planned', 'Active', 'On Hold', 'Completed', 'Cancelled') DEFAULT 'Planned',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE SET NULL,
    FOREIGN KEY (project_owner_id) REFERENCES users(user_id) ON DELETE SET NULL
    );

    CREATE TABLE IF NOT EXISTS Tasks (
    task_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    project_id INT,
    assign_id INT,
    status ENUM('To Do', 'In Progress', 'Done') DEFAULT 'To Do',
    task_type ENUM('Simple', 'Bug', 'Feature') DEFAULT 'Simple',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(project_id),
    FOREIGN KEY (assign_id) REFERENCES Users(user_id) ON DELETE SET NULL
    );

    insert into categories(category_name) values('Frontend'),('Backend'),('UI'),('UX');

    CREATE TABLE IF NOT EXISTS TeamMembers (
    user_id INT,
    project_id INT,
    PRIMARY KEY (user_id, project_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (project_id) REFERENCES projects(project_id) ON DELETE CASCADE);

    CREATE TABLE IF NOT EXISTS Permissions (
    Permission_id INT AUTO_INCREMENT PRIMARY KEY,
    role_attr varchar(255),
    Permission varchar(255),
    PRIMARY KEY (Permission,role),
    FOREIGN KEY (role_attr) REFERENCES users(role) ON DELETE CASCADE);

";

const HOST = "localhost";
const USERNAME = "root";
const PASSWORD = "";
const DBNAME = "PROJECTS";
const SQL_TASKS = 
"SELECT 
    tasks.task_id,
    tasks.title, 
    tasks.description, 
    tasks.status, 
    tasks.task_type, 
    tasks.created_at, 
    users.lastname, 
    users.firstname, 
    users.email, 
    users.role
FROM usertasks 
INNER JOIN users ON usertasks.user_id = users.user_id 
INNER JOIN tasks ON usertasks.task_id = tasks.task_id
WHERE email = ?;
";
const TEAM =
"SELECT 
    u.user_id,
    u.firstname,
    u.lastname,
    u.email,
    p.project_id,
    p.project_name,
    p.status AS project_status
FROM 
    TeamMembers t
JOIN 
    Users u ON t.user_id = u.user_id
JOIN 
    Projects p ON t.project_id = p.project_id
WHERE p.project_id LIKE ?

ORDER BY 
    p.project_name;";