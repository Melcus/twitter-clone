CREATE DATABASE IF NOT EXISTS application_db
    COLLATE 'utf8mb4_general_ci';
GRANT ALL PRIVILEGES ON `application_db`.* TO 'application_user'@'%' IDENTIFIED BY "secret";