USE arcadiadb;
CREATE TABLE IF NOT EXISTS animal (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    breed VARCHAR(50) NOT NULL,
    diet VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255),;
);
ALTER TABLE animal
ADD user_id INT;
ALTER TABLE animal
ADD FOREIGN KEY (user_id) REFERENCES user (id);
ALTER TABLE animal
ADD habitat_id INT;
ALTER TABLE animal
ADD FOREIGN KEY (habitat_id) REFERENCES habitat (id);

