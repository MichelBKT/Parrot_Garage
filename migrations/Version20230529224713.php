<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230529224713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649380CE5D8');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F04BBC13');
        $this->addSql('DROP INDEX IDX_8D93D649F04BBC13 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649380CE5D8 ON user');
        $this->addSql('ALTER TABLE user DROP id_poste_id, DROP id_user_id_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD id_poste_id INT NOT NULL, ADD id_user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649380CE5D8 FOREIGN KEY (id_user_id_id) REFERENCES horaire (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F04BBC13 FOREIGN KEY (id_poste_id) REFERENCES poste (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649F04BBC13 ON user (id_poste_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649380CE5D8 ON user (id_user_id_id)');
    }
}
