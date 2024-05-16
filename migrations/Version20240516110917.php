<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240516110917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profile_coach ADD id_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE profile_coach ADD CONSTRAINT FK_C88DF21E79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C88DF21E79F37AE5 ON profile_coach (id_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profile_coach DROP FOREIGN KEY FK_C88DF21E79F37AE5');
        $this->addSql('DROP INDEX UNIQ_C88DF21E79F37AE5 ON profile_coach');
        $this->addSql('ALTER TABLE profile_coach DROP id_user_id');
    }
}
