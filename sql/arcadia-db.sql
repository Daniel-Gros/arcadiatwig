-- Création de la base de données arcadiadb
CREATE DATABASE IF NOT EXISTS arcadiadb;

USE arcadiadb;

-- Création des tables

CREATE TABLE
    IF NOT EXISTS user (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        password VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL,
    );

CREATE TABLE
    IF NOT EXISTS animal (
        id INT AUTO_INCREMENT PRIMARY KEY,
        firstName VARCHAR(50) NOT NULL,
        breed VARCHAR(50) NOT NULL,
        diet VARCHAR(50) NOT NULL,
    );

CREATE TABLE
    IF NOT EXISTS service (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        description TEXT NOT NULL,
    );

CREATE TABLE
    IF NOT EXISTS habitat (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        description TEXT NOT NULL,
    );

CREATE TABLE
    IF NOT EXISTS CompteRenduVétérinaire (
        id INT AUTO_INCREMENT PRIMARY KEY,
        date DATE NOT NULL,
        message TEXT NOT NULL,
    );

CREATE TABLE
    IF NOT EXISTS avis (
        id INT AUTO_INCREMENT PRIMARY KEY,
        note INT NOT NULL,
        message TEXT NOT NULL,
        validation BOOLEAN NOT NULL,
    );

CREATE TABLE
    IF NOT EXISTS CommentaireHabitat (
        id INT AUTO_INCREMENT PRIMARY KEY,
        message TEXT NOT NULL,
        imrovemment BOOLEAN NOT NULL,
    );

-- Création des clés étrangères

ALTER TABLE animals
    ADD FOREIGN KEY (user_id) REFERENCES user(id);
    ADD FOREIGN KEY (habitat_id) REFERENCES habitat(id);

ALTER TABLE service
    ADD FOREIGN KEY (user_id) REFERENCES user(id);

ALTER TABLE habitat
    ADD FOREIGN KEY (user_id) REFERENCES user(id);

ALTER TABLE CompteRenduVétérinaire
    ADD FOREIGN KEY (user_id) REFERENCES user(id);
    ADD FOREIGN KEY (animal_id) REFERENCES animal(id);

ALTER TABLE avis
    ADD FOREIGN KEY (user_id) REFERENCES user(id);
    
ALTER TABLE CommentaireHabitat
    ADD FOREIGN KEY (user_id) REFERENCES user(id);
    ADD FOREIGN KEY (habitat_id) REFERENCES habitat(id);

-- Insertion des données

INSERT INTO admin (name, password, email) VALUES ('admin', 'admin', 'josearcadiapersonnefictive@gmail.com');