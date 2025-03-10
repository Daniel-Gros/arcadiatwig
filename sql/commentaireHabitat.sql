USE arcadiadb;

CREATE TABLE
    IF NOT EXISTS CommentaireHabitat (
        id INT AUTO_INCREMENT PRIMARY KEY,
        message TEXT NOT NULL,
        improvement BOOLEAN NOT NULL
    );

ALTER TABLE CommentaireHabitat ADD user_id INT;

ALTER TABLE CommentaireHabitat ADD habitat_id INT;

ALTER TABLE CommentaireHabitat ADD FOREIGN KEY (user_id) REFERENCES user (id);

ALTER TABLE CommentaireHabitat ADD FOREIGN KEY (habitat_id) REFERENCES habitat (id);