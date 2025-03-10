USE arcadiadb;
CREATE TABLE IF NOT EXISTS habitat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT NOT NULL
);
ALTER TABLE habitat
ADD user_id INT;
ALTER TABLE habitat
ADD animal_id INT;
ALTER TABLE habitat
ADD FOREIGN KEY (animal_id) REFERENCES animal (id);
ALTER TABLE habitat
ADD FOREIGN KEY (user_id) REFERENCES user (id);

ALTER TABLE habitat ADD COLUMN image VARCHAR(255);
