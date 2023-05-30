<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230529230525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD horaire_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64958C54515 FOREIGN KEY (horaire_id) REFERENCES horaire (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64958C54515 ON user (horaire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64958C54515');
        $this->addSql('DROP INDEX UNIQ_8D93D64958C54515 ON user');
        $this->addSql('ALTER TABLE user DROP horaire_id');
    }
}
