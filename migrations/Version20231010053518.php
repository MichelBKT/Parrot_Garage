<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231010053518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce CHANGE ct_ok ct_ok TINYINT(1) NOT NULL, CHANGE boite_vitesse_manuelle boite_vitesse_manuelle TINYINT(1) NOT NULL, CHANGE nombre_de_portes5 nombre_de_portes5 TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce CHANGE ct_ok ct_ok TINYINT(1) DEFAULT NULL, CHANGE boite_vitesse_manuelle boite_vitesse_manuelle TINYINT(1) DEFAULT NULL, CHANGE nombre_de_portes5 nombre_de_portes5 TINYINT(1) DEFAULT NULL');
    }
}
