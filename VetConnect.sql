DROP DATABASE IF EXISTS VET_CONNECT;
CREATE DATABASE VET_CONNECT; 
USE VET_CONNECT;
 
 
 DROP TABLE IF EXISTS User;
 CREATE TABLE User
 (
 id int(11) NOT NULL AUTO_INCREMENT,
 name varchar(25),
 password char(25),
 email varchar(100) NOT NULL,
 address varchar(25),
 type varchar(25),
 PRIMARY KEY (id)
 );
 
 DROP TABLE IF EXISTS Client;
 CREATE TABLE Client
 (
 Client_id int NOT NULL,
 username varchar(25),
 password char(25),
 address varchar(25),
 PRIMARY KEY (Client_id)
 );
 
 DROP TABLE IF EXISTS Admin;
 CREATE TABLE Admin
 (
 admin_id int NOT NULL,
 username varchar(25),
 password char(25),
 PRIMARY KEY (admin_id)
 );

 DROP TABLE IF EXISTS Vet;
 CREATE TABLE Vet
 (
 vet_id int NOT NULL,
 username varchar(25),
 password char(25),
 PRIMARY KEY (vet_id)
 );

 DROP TABLE IF EXISTS time_availibility;
 CREATE TABLE time_availibility
 (
 vet_id int NOT NULL,
 available_time varchar(25),
 PRIMARY KEY (vet_id),
 FOREIGN KEY (vet_id) references Vet(vet_id) on UPDATE CASCADE
 );

 DROP TABLE IF EXISTS Appointment;
 CREATE TABLE Appointment
 (
 vet_id int NOT NULL,
 client_id int NOT NULL,
 pet_id int,
 time varchar(25),
 vetComment varchar(25),
 clientComment varchar(25),
 PRIMARY KEY (vet_id, client_id),
 FOREIGN KEY (vet_id) references Vet(vet_id) on Update CASCADE,
 FOREIGN KEY (client_id) references Client(client_id) on Update CASCADE
 );
 
 DROP TABLE IF EXISTS Pets;
 CREATE TABLE Pets
 (
 pet_id int NOT NULL,
 client_id int NOT NULL,
 name varchar(25),
 species varchar(25),
 PRIMARY KEY (pet_id),
 FOREIGN KEY (client_id) references Client(client_id) on Update CASCADE
 );
