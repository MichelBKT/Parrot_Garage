<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230529231900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce ADD voiture_id INT NOT NULL');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F65593E5181A8BA ON annonce (voiture_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64958C54515');
        $this->addSql('DROP INDEX UNIQ_8D93D64958C54515 ON user');
        $this->addSql('ALTER TABLE user DROP horaire_id');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F181A8BA');
        $this->addSql('DROP INDEX UNIQ_E9E2810F181A8BA ON voiture');
        $this->addSql('ALTER TABLE voiture DROP voiture_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5181A8BA');
        $this->addSql('DROP INDEX UNIQ_F65593E5181A8BA ON annonce');
        $this->addSql('ALTER TABLE annonce DROP voiture_id');
        $this->addSql('ALTER TABLE user ADD horaire_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64958C54515 FOREIGN KEY (horaire_id) REFERENCES horaire (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64958C54515 ON user (horaire_id)');
        $this->addSql('ALTER TABLE voiture ADD voiture_id INT NOT NULL');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F181A8BA FOREIGN KEY (voiture_id) REFERENCES annonce (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E9E2810F181A8BA ON voiture (voiture_id)');
    }
}
