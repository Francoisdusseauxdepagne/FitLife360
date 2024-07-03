<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240703094754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact_coach (id INT AUTO_INCREMENT NOT NULL, id_profile_coach_id INT DEFAULT NULL, id_profile_id INT DEFAULT NULL, objet VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_12737DC326F062F1 (id_profile_coach_id), INDEX IDX_12737DC36970926F (id_profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact_coach ADD CONSTRAINT FK_12737DC326F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id)');
        $this->addSql('ALTER TABLE contact_coach ADD CONSTRAINT FK_12737DC36970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_coach DROP FOREIGN KEY FK_12737DC326F062F1');
        $this->addSql('ALTER TABLE contact_coach DROP FOREIGN KEY FK_12737DC36970926F');
        $this->addSql('DROP TABLE contact_coach');
    }
}
