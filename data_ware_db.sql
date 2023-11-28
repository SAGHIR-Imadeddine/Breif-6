CREATE DATABASE data_ware;
USE data_ware;

CREATE TABLE teams(
	team_id INT PRIMARY KEY AUTO_INCREMENT,
	scrum_master INT,
	name VARCHAR(20),
	statut VARCHAR(20) DEFAULT 'active',
	project_id INT 

);

CREATE TABLE projects(
		project_id INT PRIMARY KEY AUTO_INCREMENT,
		name VARCHAR(20),
    	description VARCHAR(1000),
    	product_owner INT,
    	statut VARCHAR(20) DEFAULT 'to do',
    	start_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    	deadline DATE
);


CREATE TABLE users(
	usr_id INT PRIMARY KEY AUTO_INCREMENT,
	nom VARCHAR(25) ,
	prenom VARCHAR(25),
	email VARCHAR(25) UNIQUE,
	usr_password VARCHAR(26),
	role VARCHAR(20) DEFAULT NULL,
	team int DEFAULT NULL,
	joining_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE users ADD FOREIGN KEY (team) REFERENCES teams(team_id);
ALTER TABLE projects ADD FOREIGN KEY (product_owner) REFERENCES users(usr_id);
ALTER TABLE teams ADD FOREIGN KEY (scrum_master) REFERENCES users(usr_id);
ALTER TABLE teams ADD FOREIGN KEY (project_id) REFERENCES projects(project_id);


ALTER TABLE users
MODIFY COLUMN role ENUM('admin', 'product owner', 'scrum master', 'user') DEFAULT 'user';

usr_id	nom	prenom	email	usr_password	role	team	joining_date	

INSERT INTO users (nom , prenom , email , usr_password , role) 
VALUES ("cj" , "imad" , "imad.cj@mail.com" , "dataceo123" , "admin");
