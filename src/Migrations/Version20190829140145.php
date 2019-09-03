<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190829140145 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cinema (id INT AUTO_INCREMENT NOT NULL, code_cinema VARCHAR(250) DEFAULT NULL, chaine_cinema VARCHAR(100) DEFAULT NULL, nom_cinema VARCHAR(100) NOT NULL, adresse VARCHAR(100) NOT NULL, code_postal VARCHAR(100) NOT NULL, ville VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_user (id INT AUTO_INCREMENT NOT NULL, seance_id INT NOT NULL, cinema VARCHAR(50) NOT NULL, adresse VARCHAR(255) NOT NULL, heure TIME NOT NULL, info_comp VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_user_user (event_user_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_7187A4BD22397A3A (event_user_id), INDEX IDX_7187A4BDA76ED395 (user_id), PRIMARY KEY(event_user_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(100) NOT NULL, titre VARCHAR(100) NOT NULL, image VARCHAR(100) DEFAULT NULL, date_sortie DATETIME DEFAULT NULL, lien_film VARCHAR(100) DEFAULT NULL, genre VARCHAR(100) NOT NULL, directeurs LONGTEXT DEFAULT NULL, restriction VARCHAR(100) DEFAULT NULL, fresh TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seance (id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, film_id INT DEFAULT NULL, date DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_DF7DFD0E71F7E88B (event_id), INDEX IDX_DF7DFD0E567F5183 (film_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, statut INT DEFAULT NULL, nom VARCHAR(100) DEFAULT NULL, prenom VARCHAR(100) DEFAULT NULL, email VARCHAR(100) NOT NULL, date_naissance DATETIME DEFAULT NULL, description LONGTEXT DEFAULT NULL, photo VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_user_user ADD CONSTRAINT FK_7187A4BD22397A3A FOREIGN KEY (event_user_id) REFERENCES event_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user_user ADD CONSTRAINT FK_7187A4BDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0E71F7E88B FOREIGN KEY (event_id) REFERENCES event_user (id)');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0E567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE event_user_user DROP FOREIGN KEY FK_7187A4BD22397A3A');
        $this->addSql('ALTER TABLE seance DROP FOREIGN KEY FK_DF7DFD0E71F7E88B');
        $this->addSql('ALTER TABLE seance DROP FOREIGN KEY FK_DF7DFD0E567F5183');
        $this->addSql('ALTER TABLE event_user_user DROP FOREIGN KEY FK_7187A4BDA76ED395');
        $this->addSql('DROP TABLE cinema');
        $this->addSql('DROP TABLE event_user');
        $this->addSql('DROP TABLE event_user_user');
        $this->addSql('DROP TABLE film');
        $this->addSql('DROP TABLE seance');
        $this->addSql('DROP TABLE user');
    }
}
