<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220222103515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE question_quizz (id INT AUTO_INCREMENT NOT NULL, jeux_quizz_id INT NOT NULL, question VARCHAR(255) NOT NULL, choix1 VARCHAR(255) NOT NULL, choix2 VARCHAR(255) NOT NULL, choix3 VARCHAR(255) NOT NULL, choix4 VARCHAR(255) NOT NULL, reponse VARCHAR(255) NOT NULL, INDEX IDX_4C9C86399398C03C (jeux_quizz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE question_quizz ADD CONSTRAINT FK_4C9C86399398C03C FOREIGN KEY (jeux_quizz_id) REFERENCES jeux_quizz (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE question_quizz');
    }
}
