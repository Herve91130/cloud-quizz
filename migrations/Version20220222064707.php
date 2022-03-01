<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220222064707 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE jeux_quizz (id INT AUTO_INCREMENT NOT NULL, theme_quizz_id_id INT NOT NULL, jeux VARCHAR(255) NOT NULL, INDEX IDX_4F01E39E6D9687A6 (theme_quizz_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE jeux_quizz ADD CONSTRAINT FK_4F01E39E6D9687A6 FOREIGN KEY (theme_quizz_id_id) REFERENCES theme_quizz (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE jeux_quizz');
    }
}
