USE arcadiadb;

CREATE TABLE horaires (
    id INT PRIMARY KEY AUTO_INCREMENT,
    day VARCHAR(255),
    open TIME,
    close TIME
);

INSERT INTO horaires (day, open, close) VALUES
('Lundi', '08:00', '19:00'),
('Mardi', '08:00', '19:00'),
('Mercredi', '08:00', '19:00'),
('Jeudi', '08:00', '19:00'),
('Vendredi', '08:00', '19:00'),
('Samedi', '08:00', '19:00'),
('Dimanche', '08:00', '19:00');