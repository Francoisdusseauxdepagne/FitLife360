<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240530113326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detail_entrainement DROP FOREIGN KEY FK_BE772EEA6970926F');
        $this->addSql('ALTER TABLE detail_entrainement DROP FOREIGN KEY FK_BE772EEAE68F2E27');
        $this->addSql('ALTER TABLE detail_entrainement DROP FOREIGN KEY FK_BE772EEA26F062F1');
        $this->addSql('ALTER TABLE detail_entrainement ADD CONSTRAINT FK_BE772EEA6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE detail_entrainement ADD CONSTRAINT FK_BE772EEAE68F2E27 FOREIGN KEY (id_plan_entrainement_id) REFERENCES plan_entrainement (id)');
        $this->addSql('ALTER TABLE detail_entrainement ADD CONSTRAINT FK_BE772EEA26F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id)');
        $this->addSql('ALTER TABLE plan_entrainement DROP FOREIGN KEY FK_78E045ED26F062F1');
        $this->addSql('ALTER TABLE plan_entrainement DROP FOREIGN KEY FK_78E045ED6970926F');
        $this->addSql('ALTER TABLE plan_entrainement ADD CONSTRAINT FK_78E045ED26F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id)');
        $this->addSql('ALTER TABLE plan_entrainement ADD CONSTRAINT FK_78E045ED6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger');
        $this->addSql('ALTER TABLE detail_entrainement DROP FOREIGN KEY FK_BE772EEA26F062F1');
        $this->addSql('ALTER TABLE detail_entrainement DROP FOREIGN KEY FK_BE772EEA6970926F');
        $this->addSql('ALTER TABLE detail_entrainement DROP FOREIGN KEY FK_BE772EEAE68F2E27');
        $this->addSql('ALTER TABLE detail_entrainement ADD CONSTRAINT FK_BE772EEA26F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detail_entrainement ADD CONSTRAINT FK_BE772EEA6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detail_entrainement ADD CONSTRAINT FK_BE772EEAE68F2E27 FOREIGN KEY (id_plan_entrainement_id) REFERENCES plan_entrainement (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plan_entrainement DROP FOREIGN KEY FK_78E045ED6970926F');
        $this->addSql('ALTER TABLE plan_entrainement DROP FOREIGN KEY FK_78E045ED26F062F1');
        $this->addSql('ALTER TABLE plan_entrainement ADD CONSTRAINT FK_78E045ED6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plan_entrainement ADD CONSTRAINT FK_78E045ED26F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
