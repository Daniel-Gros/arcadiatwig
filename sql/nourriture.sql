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
    type VARCHAR(50) NOT NULL,
    user_id INT NOT NULL,
    CONSTRAINT fk_nourriture_user FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
)

CREATE TABLE typeNourriture (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
    nourriture_id INT NOT NULL,
    CONSTRAINT fk_typeNourriture_nourriture FOREIGN KEY (nourriture_id) REFERENCES nourriture(id) ON DELETE CASCADE
)