<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240514111341 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD id_tuto_video_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF8E7581D FOREIGN KEY (id_tuto_video_id) REFERENCES tuto_video (id)');
        $this->addSql('CREATE INDEX IDX_9474526CF8E7581D ON comment (id_tuto_video_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF8E7581D');
        $this->addSql('DROP INDEX IDX_9474526CF8E7581D ON comment');
        $this->addSql('ALTER TABLE comment DROP id_tuto_video_id');
    }
}
