<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220228164800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaires ADD jeux_quizz_id INT NOT NULL');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C49398C03C FOREIGN KEY (jeux_quizz_id) REFERENCES jeux_quizz (id)');
        $this->addSql('CREATE INDEX IDX_D9BEC0C49398C03C ON commentaires (jeux_quizz_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C49398C03C');
        $this->addSql('DROP INDEX IDX_D9BEC0C49398C03C ON commentaires');
        $this->addSql('ALTER TABLE commentaires DROP jeux_quizz_id');
    }
}
