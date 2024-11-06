-- Création de la base de données arcadiad
CREATE DATABASE IF NOT EXISTS arcadiadb;

USE arcadiadb;

-- Création des tables
CREATE TABLE
    IF NOT EXISTS user (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        password VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL
    );

CREATE TABLE
    IF NOT EXISTS animal (
        id INT AUTO_INCREMENT PRIMARY KEY,
        firstName VARCHAR(50) NOT NULL,
        breed VARCHAR(50) NOT NULL,
        diet VARCHAR(50) NOT NULL
    );

CREATE TABLE
    IF NOT EXISTS service (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        description TEXT NOT NULL
    );

CREATE TABLE
    IF NOT EXISTS habitat (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        description TEXT NOT NULL
    );

CREATE TABLE
    IF NOT EXISTS CompteRenduVétérinaire (
        id INT AUTO_INCREMENT PRIMARY KEY,
        date DATE NOT NULL,
        message TEXT NOT NULL
    );

CREATE TABLE
    IF NOT EXISTS avis (
        id INT AUTO_INCREMENT PRIMARY KEY,
        note INT NOT NULL,
        message TEXT NOT NULL,
        validation BOOLEAN NOT NULL
    );

CREATE TABLE
    IF NOT EXISTS CommentaireHabitat (
        id INT AUTO_INCREMENT PRIMARY KEY,
        message TEXT NOT NULL,
        improvement BOOLEAN NOT NULL
    );

-- Création des clés étrangères
USE arcadiadb;

ALTER TABLE animal ADD user_id INT;

ALTER TABLE animal ADD FOREIGN KEY (user_id) REFERENCES user (id);

ALTER TABLE animal ADD habitat_id INT;

ALTER TABLE animal ADD FOREIGN KEY (habitat_id) REFERENCES habitat (id);

ALTER TABLE service
ADD COLUMN user_id INT;

ALTER TABLE service ADD FOREIGN KEY (user_id) REFERENCES user (id);

ALTER TABLE habitat ADD user_id INT;

ALTER TABLE habitat ADD FOREIGN KEY (user_id) REFERENCES user (id);

ALTER TABLE CompteRenduVétérinaire ADD user_id INT;

ALTER TABLE CompteRenduVétérinaire ADD animal_id INT;

ALTER TABLE CompteRenduVétérinaire ADD FOREIGN KEY (user_id) REFERENCES user (id);

ALTER TABLE CompteRenduVétérinaire ADD FOREIGN KEY (animal_id) REFERENCES animal (id);

ALTER TABLE avis ADD user_id INT;

ALTER TABLE avis ADD FOREIGN KEY (user_id) REFERENCES user (id);

ALTER TABLE CommentaireHabitat ADD user_id INT;

ALTER TABLE CommentaireHabitat ADD habitat_id INT;

ALTER TABLE CommentaireHabitat ADD FOREIGN KEY (user_id) REFERENCES user (id);

ALTER TABLE CommentaireHabitat ADD FOREIGN KEY (habitat_id) REFERENCES habitat (id);

-- Insertion des données
INSERT INTO user
    (name, password, email)
VALUES
    (
        'admin',
        'admin',
        'josearcadiapersonnefictive@gmail.com'
    );