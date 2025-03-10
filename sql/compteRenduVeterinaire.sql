USE arcadiadb;




ALTER TABLE CompteRenduVétérinaire ADD user_id INT;

ALTER TABLE CompteRenduVétérinaire ADD animal_id INT;

ALTER TABLE CompteRenduVétérinaire ADD FOREIGN KEY (user_id) REFERENCES user (id);

ALTER TABLE CompteRenduVétérinaire ADD FOREIGN KEY (animal_id) REFERENCES animal (id);