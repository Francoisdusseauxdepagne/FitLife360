<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240607084504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6386970926F');
        $this->addSql('ALTER TABLE contact ADD name VARCHAR(255) DEFAULT NULL, ADD first_name VARCHAR(255) DEFAULT NULL, ADD email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6386970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6386970926F');
        $this->addSql('ALTER TABLE contact DROP name, DROP first_name, DROP email');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6386970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
