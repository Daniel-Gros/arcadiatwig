USE arcadiadb;

CREATE TABLE
    IF NOT EXISTS avis (
        id INT AUTO_INCREMENT PRIMARY KEY,
        note INT NOT NULL,
        message TEXT NOT NULL,
        validation BOOLEAN NOT NULL
    );

ALTER TABLE avis ADD user_id INT;

ALTER TABLE avis ADD FOREIGN KEY (user_id) REFERENCES user (id);