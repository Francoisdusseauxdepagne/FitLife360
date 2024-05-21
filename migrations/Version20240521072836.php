<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521072836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_entrainement ADD id_profile_coach_id INT DEFAULT NULL, ADD id_profile_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail_entrainement ADD CONSTRAINT FK_BE772EEA26F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id)');
        $this->addSql('ALTER TABLE detail_entrainement ADD CONSTRAINT FK_BE772EEA6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
        $this->addSql('CREATE INDEX IDX_BE772EEA26F062F1 ON detail_entrainement (id_profile_coach_id)');
        $this->addSql('CREATE INDEX IDX_BE772EEA6970926F ON detail_entrainement (id_profile_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_entrainement DROP FOREIGN KEY FK_BE772EEA26F062F1');
        $this->addSql('ALTER TABLE detail_entrainement DROP FOREIGN KEY FK_BE772EEA6970926F');
        $this->addSql('DROP INDEX IDX_BE772EEA26F062F1 ON detail_entrainement');
        $this->addSql('DROP INDEX IDX_BE772EEA6970926F ON detail_entrainement');
        $this->addSql('ALTER TABLE detail_entrainement DROP id_profile_coach_id, DROP id_profile_id');
    }
}
