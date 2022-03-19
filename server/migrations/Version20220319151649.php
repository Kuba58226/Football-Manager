<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220319151649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE match_result (id INT AUTO_INCREMENT NOT NULL, league_id INT NOT NULL, home_team_id INT NOT NULL, away_team_id INT NOT NULL, date DATETIME NOT NULL, state VARCHAR(255) NOT NULL, home_team_goals INT DEFAULT NULL, away_team_goals INT DEFAULT NULL, INDEX IDX_B205381258AFC4DE (league_id), INDEX IDX_B20538129C4C13F6 (home_team_id), INDEX IDX_B205381245185D02 (away_team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE match_result ADD CONSTRAINT FK_B205381258AFC4DE FOREIGN KEY (league_id) REFERENCES league (id)');
        $this->addSql('ALTER TABLE match_result ADD CONSTRAINT FK_B20538129C4C13F6 FOREIGN KEY (home_team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE match_result ADD CONSTRAINT FK_B205381245185D02 FOREIGN KEY (away_team_id) REFERENCES team (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE match_result');
    }
}
