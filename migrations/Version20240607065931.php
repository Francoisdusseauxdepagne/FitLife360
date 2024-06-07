<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240607065931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, objet VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C6970926F');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF8E7581D');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF8E7581D FOREIGN KEY (id_tuto_video_id) REFERENCES tuto_video (id)');
        $this->addSql('ALTER TABLE detail_entrainement DROP FOREIGN KEY FK_BE772EEA6970926F');
        $this->addSql('ALTER TABLE detail_entrainement DROP FOREIGN KEY FK_BE772EEAE68F2E27');
        $this->addSql('ALTER TABLE detail_entrainement DROP FOREIGN KEY FK_BE772EEA26F062F1');
        $this->addSql('ALTER TABLE detail_entrainement ADD CONSTRAINT FK_BE772EEA6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE detail_entrainement ADD CONSTRAINT FK_BE772EEAE68F2E27 FOREIGN KEY (id_plan_entrainement_id) REFERENCES plan_entrainement (id)');
        $this->addSql('ALTER TABLE detail_entrainement ADD CONSTRAINT FK_BE772EEA26F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id)');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF24FFF9576');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF26970926F');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF24FFF9576 FOREIGN KEY (id_abonnement_id) REFERENCES abonnement (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF26970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE plan_entrainement DROP FOREIGN KEY FK_78E045ED26F062F1');
        $this->addSql('ALTER TABLE plan_entrainement DROP FOREIGN KEY FK_78E045ED6970926F');
        $this->addSql('ALTER TABLE plan_entrainement ADD CONSTRAINT FK_78E045ED26F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id)');
        $this->addSql('ALTER TABLE plan_entrainement ADD CONSTRAINT FK_78E045ED6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F4FFF9576');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F79F37AE5');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F26F062F1');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F4FFF9576 FOREIGN KEY (id_abonnement_id) REFERENCES abonnement (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F26F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id)');
        $this->addSql('ALTER TABLE profile_coach DROP FOREIGN KEY FK_C88DF21E79F37AE5');
        $this->addSql('ALTER TABLE profile_coach ADD CONSTRAINT FK_C88DF21E79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reporting DROP FOREIGN KEY FK_BD7CFA9F5DE3FDC4');
        $this->addSql('ALTER TABLE reporting DROP FOREIGN KEY FK_BD7CFA9F6970926F');
        $this->addSql('ALTER TABLE reporting ADD CONSTRAINT FK_BD7CFA9F5DE3FDC4 FOREIGN KEY (id_comment_id) REFERENCES comment (id)');
        $this->addSql('ALTER TABLE reporting ADD CONSTRAINT FK_BD7CFA9F6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849556970926F');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495526F062F1');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849556970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495526F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE contact');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF8E7581D');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C6970926F');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF8E7581D FOREIGN KEY (id_tuto_video_id) REFERENCES tuto_video (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detail_entrainement DROP FOREIGN KEY FK_BE772EEA26F062F1');
        $this->addSql('ALTER TABLE detail_entrainement DROP FOREIGN KEY FK_BE772EEA6970926F');
        $this->addSql('ALTER TABLE detail_entrainement DROP FOREIGN KEY FK_BE772EEAE68F2E27');
        $this->addSql('ALTER TABLE detail_entrainement ADD CONSTRAINT FK_BE772EEA26F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detail_entrainement ADD CONSTRAINT FK_BE772EEA6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detail_entrainement ADD CONSTRAINT FK_BE772EEAE68F2E27 FOREIGN KEY (id_plan_entrainement_id) REFERENCES plan_entrainement (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF24FFF9576');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF26970926F');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF24FFF9576 FOREIGN KEY (id_abonnement_id) REFERENCES abonnement (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF26970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plan_entrainement DROP FOREIGN KEY FK_78E045ED6970926F');
        $this->addSql('ALTER TABLE plan_entrainement DROP FOREIGN KEY FK_78E045ED26F062F1');
        $this->addSql('ALTER TABLE plan_entrainement ADD CONSTRAINT FK_78E045ED6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plan_entrainement ADD CONSTRAINT FK_78E045ED26F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F79F37AE5');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F4FFF9576');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F26F062F1');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F4FFF9576 FOREIGN KEY (id_abonnement_id) REFERENCES abonnement (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F26F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profile_coach DROP FOREIGN KEY FK_C88DF21E79F37AE5');
        $this->addSql('ALTER TABLE profile_coach ADD CONSTRAINT FK_C88DF21E79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reporting DROP FOREIGN KEY FK_BD7CFA9F6970926F');
        $this->addSql('ALTER TABLE reporting DROP FOREIGN KEY FK_BD7CFA9F5DE3FDC4');
        $this->addSql('ALTER TABLE reporting ADD CONSTRAINT FK_BD7CFA9F6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reporting ADD CONSTRAINT FK_BD7CFA9F5DE3FDC4 FOREIGN KEY (id_comment_id) REFERENCES comment (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849556970926F');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495526F062F1');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849556970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495526F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
