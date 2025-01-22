<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250122082427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE horaires (id INT AUTO_INCREMENT NOT NULL, day VARCHAR(255) NOT NULL, open TIME NOT NULL, close TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nourrissage (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, datetime DATETIME NOT NULL, quantity INT NOT NULL, UNIQUE INDEX UNIQ_D00D80058E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nourriture (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE typenourriture (id INT AUTO_INCREMENT NOT NULL, nourriture_id INT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D1D061E98BD5834 (nourriture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nourrissage ADD CONSTRAINT FK_D00D80058E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE typenourriture ADD CONSTRAINT FK_8D1D061E98BD5834 FOREIGN KEY (nourriture_id) REFERENCES nourriture (id)');
        $this->addSql('ALTER TABLE animal ADD health VARCHAR(255) NOT NULL, DROP description, DROP image');
        $this->addSql('ALTER TABLE avis DROP date, DROP status');
        $this->addSql('ALTER TABLE user DROP password_hashed, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nourrissage DROP FOREIGN KEY FK_D00D80058E962C16');
        $this->addSql('ALTER TABLE typenourriture DROP FOREIGN KEY FK_8D1D061E98BD5834');
        $this->addSql('DROP TABLE horaires');
        $this->addSql('DROP TABLE nourrissage');
        $this->addSql('DROP TABLE nourriture');
        $this->addSql('DROP TABLE typenourriture');
        $this->addSql('ALTER TABLE animal ADD description LONGTEXT DEFAULT NULL, ADD image VARCHAR(255) DEFAULT \'NULL\', DROP health');
        $this->addSql('ALTER TABLE avis ADD date DATETIME NOT NULL, ADD status VARCHAR(20) DEFAULT \'\'\'pending\'\'\' NOT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\' COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user ADD password_hashed TINYINT(1) NOT NULL, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
