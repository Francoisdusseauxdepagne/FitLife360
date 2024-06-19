<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240619122311 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_event DROP FOREIGN KEY FK_16841AA8212C041E');
        $this->addSql('ALTER TABLE contact_event DROP FOREIGN KEY FK_16841AA86970926F');
        $this->addSql('ALTER TABLE contact_event ADD CONSTRAINT FK_16841AA8212C041E FOREIGN KEY (id_event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE contact_event ADD CONSTRAINT FK_16841AA86970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA726F062F1');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA726F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_event DROP FOREIGN KEY FK_16841AA8212C041E');
        $this->addSql('ALTER TABLE contact_event DROP FOREIGN KEY FK_16841AA86970926F');
        $this->addSql('ALTER TABLE contact_event ADD CONSTRAINT FK_16841AA8212C041E FOREIGN KEY (id_event_id) REFERENCES event (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact_event ADD CONSTRAINT FK_16841AA86970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA726F062F1');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA726F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
