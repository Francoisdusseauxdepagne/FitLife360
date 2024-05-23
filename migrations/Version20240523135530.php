<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240523135530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reporting (id INT AUTO_INCREMENT NOT NULL, id_profile_id INT DEFAULT NULL, id_comment_id INT DEFAULT NULL, comment LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_BD7CFA9F6970926F (id_profile_id), INDEX IDX_BD7CFA9F5DE3FDC4 (id_comment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reporting ADD CONSTRAINT FK_BD7CFA9F6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE reporting ADD CONSTRAINT FK_BD7CFA9F5DE3FDC4 FOREIGN KEY (id_comment_id) REFERENCES comment (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reporting DROP FOREIGN KEY FK_BD7CFA9F6970926F');
        $this->addSql('ALTER TABLE reporting DROP FOREIGN KEY FK_BD7CFA9F5DE3FDC4');
        $this->addSql('DROP TABLE reporting');
    }
}
