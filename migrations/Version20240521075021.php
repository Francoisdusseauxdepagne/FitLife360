<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521075021 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_entrainement ADD id_plan_entrainement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail_entrainement ADD CONSTRAINT FK_BE772EEAE68F2E27 FOREIGN KEY (id_plan_entrainement_id) REFERENCES plan_entrainement (id)');
        $this->addSql('CREATE INDEX IDX_BE772EEAE68F2E27 ON detail_entrainement (id_plan_entrainement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_entrainement DROP FOREIGN KEY FK_BE772EEAE68F2E27');
        $this->addSql('DROP INDEX IDX_BE772EEAE68F2E27 ON detail_entrainement');
        $this->addSql('ALTER TABLE detail_entrainement DROP id_plan_entrainement_id');
    }
}
