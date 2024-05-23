<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240522132539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, id_profile_id INT DEFAULT NULL, id_profile_coach_id INT DEFAULT NULL, date DATE NOT NULL, start_time TIME NOT NULL, INDEX IDX_42C849556970926F (id_profile_id), INDEX IDX_42C8495526F062F1 (id_profile_coach_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849556970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495526F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849556970926F');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495526F062F1');
        $this->addSql('DROP TABLE reservation');
    }
}
