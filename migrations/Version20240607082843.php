<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240607082843 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact ADD id_profile_id INT DEFAULT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6386970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
        $this->addSql('CREATE INDEX IDX_4C62E6386970926F ON contact (id_profile_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6386970926F');
        $this->addSql('DROP INDEX IDX_4C62E6386970926F ON contact');
        $this->addSql('ALTER TABLE contact DROP id_profile_id, DROP created_at');
    }
}
