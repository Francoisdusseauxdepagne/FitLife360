<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240618134004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact_event (id INT AUTO_INCREMENT NOT NULL, id_event_id INT DEFAULT NULL, id_profile_id INT DEFAULT NULL, content VARCHAR(255) NOT NULL, INDEX IDX_16841AA8212C041E (id_event_id), INDEX IDX_16841AA86970926F (id_profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact_event ADD CONSTRAINT FK_16841AA8212C041E FOREIGN KEY (id_event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE contact_event ADD CONSTRAINT FK_16841AA86970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_event DROP FOREIGN KEY FK_16841AA8212C041E');
        $this->addSql('ALTER TABLE contact_event DROP FOREIGN KEY FK_16841AA86970926F');
        $this->addSql('DROP TABLE contact_event');
    }
}
