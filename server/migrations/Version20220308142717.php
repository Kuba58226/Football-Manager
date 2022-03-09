<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220308142717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE default_league (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE default_player (id INT AUTO_INCREMENT NOT NULL, default_team_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, age INT NOT NULL, position VARCHAR(255) NOT NULL, goalkeeper INT NOT NULL, defender INT NOT NULL, midfielder INT NOT NULL, attacker INT NOT NULL, INDEX IDX_7F487136DBE989EB (default_team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE default_team (id INT AUTO_INCREMENT NOT NULL, default_league_id INT NOT NULL, name VARCHAR(255) NOT NULL, budget BIGINT NOT NULL, INDEX IDX_81119D19C9CDEC79 (default_league_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE default_player ADD CONSTRAINT FK_7F487136DBE989EB FOREIGN KEY (default_team_id) REFERENCES default_team (id)');
        $this->addSql('ALTER TABLE default_team ADD CONSTRAINT FK_81119D19C9CDEC79 FOREIGN KEY (default_league_id) REFERENCES default_league (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE default_team DROP FOREIGN KEY FK_81119D19C9CDEC79');
        $this->addSql('ALTER TABLE default_player DROP FOREIGN KEY FK_7F487136DBE989EB');
        $this->addSql('DROP TABLE default_league');
        $this->addSql('DROP TABLE default_player');
        $this->addSql('DROP TABLE default_team');
    }
}
