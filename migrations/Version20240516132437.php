<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240516132437 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plan_alimentaire ADD id_profile_coach_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plan_alimentaire ADD CONSTRAINT FK_7DFEE31926F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id)');
        $this->addSql('CREATE INDEX IDX_7DFEE31926F062F1 ON plan_alimentaire (id_profile_coach_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plan_alimentaire DROP FOREIGN KEY FK_7DFEE31926F062F1');
        $this->addSql('DROP INDEX IDX_7DFEE31926F062F1 ON plan_alimentaire');
        $this->addSql('ALTER TABLE plan_alimentaire DROP id_profile_coach_id');
    }
}
