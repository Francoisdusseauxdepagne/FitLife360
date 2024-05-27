<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240527065620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C6970926F');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF8E7581D');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF8E7581D FOREIGN KEY (id_tuto_video_id) REFERENCES tuto_video (id)');
        $this->addSql('ALTER TABLE panier ADD validated TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE reporting DROP FOREIGN KEY FK_BD7CFA9F5DE3FDC4');
        $this->addSql('ALTER TABLE reporting DROP FOREIGN KEY FK_BD7CFA9F6970926F');
        $this->addSql('ALTER TABLE reporting ADD CONSTRAINT FK_BD7CFA9F5DE3FDC4 FOREIGN KEY (id_comment_id) REFERENCES comment (id)');
        $this->addSql('ALTER TABLE reporting ADD CONSTRAINT FK_BD7CFA9F6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF8E7581D');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C6970926F');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF8E7581D FOREIGN KEY (id_tuto_video_id) REFERENCES tuto_video (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier DROP validated');
        $this->addSql('ALTER TABLE reporting DROP FOREIGN KEY FK_BD7CFA9F6970926F');
        $this->addSql('ALTER TABLE reporting DROP FOREIGN KEY FK_BD7CFA9F5DE3FDC4');
        $this->addSql('ALTER TABLE reporting ADD CONSTRAINT FK_BD7CFA9F6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reporting ADD CONSTRAINT FK_BD7CFA9F5DE3FDC4 FOREIGN KEY (id_comment_id) REFERENCES comment (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
