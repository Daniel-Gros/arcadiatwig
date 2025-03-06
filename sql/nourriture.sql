use arcadiadb;
CREATE TABLE nourrissage(
    id INT AUTO_INCREMENT PRIMARY KEY,
    date dateTime,
    quantity INT,
    nourriture_id INT NOT NULL,
    CONSTRAINT fk_nourrissage_nourriture FOREIGN KEY (nourriture_id) REFERENCES nourriture(id) ON DELETE CASCADE
)
CREATE TABLE nourriture (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    typeNourriture_id VARCHAR(50) NOT NULL,
    CONSTRAINT fk_nourriture_typeNourriture FOREIGN KEY (typeNourriture_id) REFERENCES typeNourriture(id) ON DELETE CASCADE
)

CREATE TABLE typeNourriture (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
)

INSERT INTO typeNourriture (name) VALUES
('Fruit'),
('Légume'),
('Viande'),
('Herbe'), 
('Insecte');


INSERT INTO nourriture (name, typeNourriture_id) VALUES
('Carotte', 2),
('Épinard', 2),
('Courgette', 2);

INSERT INTO nourriture (name, typeNourriture_id) VALUES
('Boeuf', 3),
('Poulet', 3),
('Agneau', 3);

INSERT INTO nourriture (name, typeNourriture_id) VALUES
('Pomme', 1),
('Banane', 1),
('Orange', 1);
INSERT INTO nourriture (name, typeNourriture_id) VALUES
('Fougère', 4),
('Herbe', 4),
('Feuille de palmier', 4);
INSERT INTO nourriture (name, typeNourriture_id) VALUES
('Grillons', 5),
('Vers de farine', 5),
('Mouches', 5);


