<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240516105225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE profile_coach (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, dob DATE NOT NULL, diplome VARCHAR(255) NOT NULL, experience LONGTEXT DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, genre VARCHAR(255) NOT NULL, bio LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF26970926F');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF24FFF9576');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF26970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF24FFF9576 FOREIGN KEY (id_abonnement_id) REFERENCES abonnement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE profile_coach');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF24FFF9576');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF26970926F');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF24FFF9576 FOREIGN KEY (id_abonnement_id) REFERENCES abonnement (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF26970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
