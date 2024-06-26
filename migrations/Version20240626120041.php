<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240626120041 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_event DROP FOREIGN KEY FK_16841AA8212C041E');
        $this->addSql('ALTER TABLE contact_event DROP FOREIGN KEY FK_16841AA86970926F');
        $this->addSql('ALTER TABLE contact_event ADD CONSTRAINT FK_16841AA8212C041E FOREIGN KEY (id_event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE contact_event ADD CONSTRAINT FK_16841AA86970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE detail_entrainement DROP FOREIGN KEY FK_BE772EEA26F062F1');
        $this->addSql('ALTER TABLE detail_entrainement DROP FOREIGN KEY FK_BE772EEA6970926F');
        $this->addSql('ALTER TABLE detail_entrainement DROP FOREIGN KEY FK_BE772EEAE68F2E27');
        $this->addSql('ALTER TABLE detail_entrainement ADD CONSTRAINT FK_BE772EEA26F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id)');
        $this->addSql('ALTER TABLE detail_entrainement ADD CONSTRAINT FK_BE772EEA6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE detail_entrainement ADD CONSTRAINT FK_BE772EEAE68F2E27 FOREIGN KEY (id_plan_entrainement_id) REFERENCES plan_entrainement (id)');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA726F062F1');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA726F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id)');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_9065174477482E5B');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_9065174477482E5B FOREIGN KEY (id_panier_id) REFERENCES panier (id)');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF26970926F');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF24FFF9576');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF26970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF24FFF9576 FOREIGN KEY (id_abonnement_id) REFERENCES abonnement (id)');
        $this->addSql('ALTER TABLE plan_entrainement DROP FOREIGN KEY FK_78E045ED26F062F1');
        $this->addSql('ALTER TABLE plan_entrainement DROP FOREIGN KEY FK_78E045ED6970926F');
        $this->addSql('ALTER TABLE plan_entrainement ADD CONSTRAINT FK_78E045ED26F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id)');
        $this->addSql('ALTER TABLE plan_entrainement ADD CONSTRAINT FK_78E045ED6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F26F062F1');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F4FFF9576');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F79F37AE5');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F26F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F4FFF9576 FOREIGN KEY (id_abonnement_id) REFERENCES abonnement (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE profile_coach ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE reporting DROP FOREIGN KEY FK_BD7CFA9F6970926F');
        $this->addSql('ALTER TABLE reporting DROP FOREIGN KEY FK_BD7CFA9F5DE3FDC4');
        $this->addSql('ALTER TABLE reporting ADD CONSTRAINT FK_BD7CFA9F6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE reporting ADD CONSTRAINT FK_BD7CFA9F5DE3FDC4 FOREIGN KEY (id_comment_id) REFERENCES comment (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_event DROP FOREIGN KEY FK_16841AA8212C041E');
        $this->addSql('ALTER TABLE contact_event DROP FOREIGN KEY FK_16841AA86970926F');
        $this->addSql('ALTER TABLE contact_event ADD CONSTRAINT FK_16841AA8212C041E FOREIGN KEY (id_event_id) REFERENCES event (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact_event ADD CONSTRAINT FK_16841AA86970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detail_entrainement DROP FOREIGN KEY FK_BE772EEA26F062F1');
        $this->addSql('ALTER TABLE detail_entrainement DROP FOREIGN KEY FK_BE772EEA6970926F');
        $this->addSql('ALTER TABLE detail_entrainement DROP FOREIGN KEY FK_BE772EEAE68F2E27');
        $this->addSql('ALTER TABLE detail_entrainement ADD CONSTRAINT FK_BE772EEA26F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detail_entrainement ADD CONSTRAINT FK_BE772EEA6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detail_entrainement ADD CONSTRAINT FK_BE772EEAE68F2E27 FOREIGN KEY (id_plan_entrainement_id) REFERENCES plan_entrainement (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA726F062F1');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA726F062F1 FOREIGN KEY (id_profile_coach_id) REFERENCES profile_coach (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_9065174477482E5B');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_9065174477482E5B FOREIGN KEY (id_panier_id) REFERENCES panier (id) ON UPDATE CASCADE ON DELETE CASCADE');
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
        $this->addSql('ALTER TABLE profile_coach DROP updated_at');
        $this->addSql('ALTER TABLE reporting DROP FOREIGN KEY FK_BD7CFA9F6970926F');
        $this->addSql('ALTER TABLE reporting DROP FOREIGN KEY FK_BD7CFA9F5DE3FDC4');
        $this->addSql('ALTER TABLE reporting ADD CONSTRAINT FK_BD7CFA9F6970926F FOREIGN KEY (id_profile_id) REFERENCES profile (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reporting ADD CONSTRAINT FK_BD7CFA9F5DE3FDC4 FOREIGN KEY (id_comment_id) REFERENCES comment (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
