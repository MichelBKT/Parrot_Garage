<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230529223826 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, titre VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_F65593E5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis_client (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, libelle LONGTEXT NOT NULL, note INT NOT NULL, auteur VARCHAR(50) NOT NULL, INDEX IDX_708E90EFA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caracteristique (id INT AUTO_INCREMENT NOT NULL, boite_vitesse_manuelle TINYINT(1) NOT NULL, nb_portes_5 TINYINT(1) NOT NULL, puissance_fisc INT NOT NULL, puissance_din DOUBLE PRECISION NOT NULL, co2 VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE couleur (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poste (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, poste_id INT DEFAULT NULL, id_poste_id INT NOT NULL, id_user_id_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, role_admin TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649A0905086 (poste_id), INDEX IDX_8D93D649F04BBC13 (id_poste_id), UNIQUE INDEX UNIQ_8D93D649380CE5D8 (id_user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voiture (id INT AUTO_INCREMENT NOT NULL, couleur_id INT NOT NULL, voiture_id INT NOT NULL, marque VARCHAR(100) NOT NULL, modele VARCHAR(100) NOT NULL, annee DATETIME NOT NULL, energie VARCHAR(50) NOT NULL, ct_ok TINYINT(1) NOT NULL, photos VARCHAR(255) NOT NULL, INDEX IDX_E9E2810FC31BA576 (couleur_id), UNIQUE INDEX UNIQ_E9E2810F181A8BA (voiture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE avis_client ADD CONSTRAINT FK_708E90EFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A0905086 FOREIGN KEY (poste_id) REFERENCES poste (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F04BBC13 FOREIGN KEY (id_poste_id) REFERENCES poste (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649380CE5D8 FOREIGN KEY (id_user_id_id) REFERENCES horaire (id)');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FC31BA576 FOREIGN KEY (couleur_id) REFERENCES couleur (id)');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F181A8BA FOREIGN KEY (voiture_id) REFERENCES annonce (id)');
        $this->addSql('DROP TABLE caracteristique_voiture_caracteristique');
        $this->addSql('ALTER TABLE caracteristique_caracteristique_voiture ADD CONSTRAINT FK_E48BD0C51704EEB7 FOREIGN KEY (caracteristique_id) REFERENCES caracteristique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE caracteristique_caracteristique_voiture ADD CONSTRAINT FK_E48BD0C56DA9EBC7 FOREIGN KEY (caracteristique_voiture_id) REFERENCES caracteristique_voiture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voiture_caracteristique_voiture ADD CONSTRAINT FK_79C5D622181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voiture_caracteristique_voiture ADD CONSTRAINT FK_79C5D6226DA9EBC7 FOREIGN KEY (caracteristique_voiture_id) REFERENCES caracteristique_voiture (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE caracteristique_caracteristique_voiture DROP FOREIGN KEY FK_E48BD0C51704EEB7');
        $this->addSql('ALTER TABLE voiture_caracteristique_voiture DROP FOREIGN KEY FK_79C5D622181A8BA');
        $this->addSql('CREATE TABLE caracteristique_voiture_caracteristique (caracteristique_voiture_id INT NOT NULL, caracteristique_id INT NOT NULL, INDEX IDX_5F6FB75F6DA9EBC7 (caracteristique_voiture_id), INDEX IDX_5F6FB75F1704EEB7 (caracteristique_id), PRIMARY KEY(caracteristique_voiture_id, caracteristique_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5A76ED395');
        $this->addSql('ALTER TABLE avis_client DROP FOREIGN KEY FK_708E90EFA76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A0905086');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F04BBC13');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649380CE5D8');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FC31BA576');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F181A8BA');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE avis_client');
        $this->addSql('DROP TABLE caracteristique');
        $this->addSql('DROP TABLE couleur');
        $this->addSql('DROP TABLE poste');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE voiture');
        $this->addSql('ALTER TABLE caracteristique_caracteristique_voiture DROP FOREIGN KEY FK_E48BD0C56DA9EBC7');
        $this->addSql('ALTER TABLE voiture_caracteristique_voiture DROP FOREIGN KEY FK_79C5D6226DA9EBC7');
    }
}
