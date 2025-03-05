USE arcadiadb;

CREATE TABLE service (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    user_id INT NOT NULL,
    CONSTRAINT fk_service_user FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
);

ALTER TABLE service ADD COLUMN image VARCHAR(255) NULL;