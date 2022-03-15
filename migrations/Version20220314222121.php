<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220314222121 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jeux_quizz DROP FOREIGN KEY FK_4F01E39E6D9687A6');
        $this->addSql('DROP INDEX IDX_4F01E39E6D9687A6 ON jeux_quizz');
        $this->addSql('ALTER TABLE jeux_quizz ADD titre_couleur VARCHAR(255) NOT NULL, DROP lien, DROP lien_forum, CHANGE theme_quizz_id_id theme_quizz_id INT NOT NULL');
        $this->addSql('ALTER TABLE jeux_quizz ADD CONSTRAINT FK_4F01E39E18AD59BA FOREIGN KEY (theme_quizz_id) REFERENCES theme_quizz (id)');
        $this->addSql('CREATE INDEX IDX_4F01E39E18AD59BA ON jeux_quizz (theme_quizz_id)');
        $this->addSql('ALTER TABLE theme_quizz DROP lien');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jeux_quizz DROP FOREIGN KEY FK_4F01E39E18AD59BA');
        $this->addSql('DROP INDEX IDX_4F01E39E18AD59BA ON jeux_quizz');
        $this->addSql('ALTER TABLE jeux_quizz ADD lien_forum VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE theme_quizz_id theme_quizz_id_id INT NOT NULL, CHANGE titre_couleur lien VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE jeux_quizz ADD CONSTRAINT FK_4F01E39E6D9687A6 FOREIGN KEY (theme_quizz_id_id) REFERENCES theme_quizz (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_4F01E39E6D9687A6 ON jeux_quizz (theme_quizz_id_id)');
        $this->addSql('ALTER TABLE theme_quizz ADD lien VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
