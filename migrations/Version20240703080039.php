<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240703080039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE session_coaching DROP FOREIGN KEY FK_411268A6C57A3720');
        $this->addSql('DROP INDEX IDX_411268A6C57A3720 ON session_coaching');
        $this->addSql('ALTER TABLE session_coaching CHANGE profile_coach_id id_profile_coach_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE session_coaching ADD CONSTRAINT FK_411268A626F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id)');
        $this->addSql('CREATE INDEX IDX_411268A626F062F1 ON session_coaching (id_profile_coach_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE session_coaching DROP FOREIGN KEY FK_411268A626F062F1');
        $this->addSql('DROP INDEX IDX_411268A626F062F1 ON session_coaching');
        $this->addSql('ALTER TABLE session_coaching CHANGE id_profile_coach_id profile_coach_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE session_coaching ADD CONSTRAINT FK_411268A6C57A3720 FOREIGN KEY (profile_coach_id) REFERENCES profile_coach (id)');
        $this->addSql('CREATE INDEX IDX_411268A6C57A3720 ON session_coaching (profile_coach_id)');
    }
}
