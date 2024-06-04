<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240530113515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE messenger ADD id_profile_id INT DEFAULT NULL, ADD id_profile_coach_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE messenger ADD CONSTRAINT FK_E22A43016970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE messenger ADD CONSTRAINT FK_E22A430126F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id)');
        $this->addSql('CREATE INDEX IDX_E22A43016970926F ON messenger (id_profile_id)');
        $this->addSql('CREATE INDEX IDX_E22A430126F062F1 ON messenger (id_profile_coach_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE messenger DROP FOREIGN KEY FK_E22A43016970926F');
        $this->addSql('ALTER TABLE messenger DROP FOREIGN KEY FK_E22A430126F062F1');
        $this->addSql('DROP INDEX IDX_E22A43016970926F ON messenger');
        $this->addSql('DROP INDEX IDX_E22A430126F062F1 ON messenger');
        $this->addSql('ALTER TABLE messenger DROP id_profile_id, DROP id_profile_coach_id');
    }
}
