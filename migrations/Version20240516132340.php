<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240516132340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plan_entrainement ADD id_profile_coach_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plan_entrainement ADD CONSTRAINT FK_78E045ED26F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id)');
        $this->addSql('CREATE INDEX IDX_78E045ED26F062F1 ON plan_entrainement (id_profile_coach_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plan_entrainement DROP FOREIGN KEY FK_78E045ED26F062F1');
        $this->addSql('DROP INDEX IDX_78E045ED26F062F1 ON plan_entrainement');
        $this->addSql('ALTER TABLE plan_entrainement DROP id_profile_coach_id');
    }
}
