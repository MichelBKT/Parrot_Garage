<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230529234027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voiture_caracteristique_voiture DROP FOREIGN KEY FK_79C5D6226DA9EBC7');
        $this->addSql('CREATE TABLE voiture_caracteristique (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voiture_caracteristique_caracteristique (voiture_caracteristique_id INT NOT NULL, caracteristique_id INT NOT NULL, INDEX IDX_9EE10CAB10F60D5B (voiture_caracteristique_id), INDEX IDX_9EE10CAB1704EEB7 (caracteristique_id), PRIMARY KEY(voiture_caracteristique_id, caracteristique_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE voiture_caracteristique_caracteristique ADD CONSTRAINT FK_9EE10CAB10F60D5B FOREIGN KEY (voiture_caracteristique_id) REFERENCES voiture_caracteristique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voiture_caracteristique_caracteristique ADD CONSTRAINT FK_9EE10CAB1704EEB7 FOREIGN KEY (caracteristique_id) REFERENCES caracteristique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE caracteristique_caracteristique_voiture DROP FOREIGN KEY FK_E48BD0C56DA9EBC7');
        $this->addSql('ALTER TABLE caracteristique_caracteristique_voiture DROP FOREIGN KEY FK_E48BD0C51704EEB7');
        $this->addSql('DROP TABLE caracteristique_caracteristique_voiture');
        $this->addSql('DROP TABLE caracteristique_voiture');
        $this->addSql('DROP INDEX IDX_79C5D6226DA9EBC7 ON voiture_caracteristique_voiture');
        $this->addSql('DROP INDEX `primary` ON voiture_caracteristique_voiture');
        $this->addSql('ALTER TABLE voiture_caracteristique_voiture CHANGE caracteristique_voiture_id voiture_caracteristique_id INT NOT NULL');
        $this->addSql('ALTER TABLE voiture_caracteristique_voiture ADD CONSTRAINT FK_79C5D62210F60D5B FOREIGN KEY (voiture_caracteristique_id) REFERENCES voiture_caracteristique (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_79C5D62210F60D5B ON voiture_caracteristique_voiture (voiture_caracteristique_id)');
        $this->addSql('ALTER TABLE voiture_caracteristique_voiture ADD PRIMARY KEY (voiture_caracteristique_id, voiture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voiture_caracteristique_voiture DROP FOREIGN KEY FK_79C5D62210F60D5B');
        $this->addSql('CREATE TABLE caracteristique_caracteristique_voiture (caracteristique_id INT NOT NULL, caracteristique_voiture_id INT NOT NULL, INDEX IDX_E48BD0C51704EEB7 (caracteristique_id), INDEX IDX_E48BD0C56DA9EBC7 (caracteristique_voiture_id), PRIMARY KEY(caracteristique_id, caracteristique_voiture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE caracteristique_voiture (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE caracteristique_caracteristique_voiture ADD CONSTRAINT FK_E48BD0C56DA9EBC7 FOREIGN KEY (caracteristique_voiture_id) REFERENCES caracteristique_voiture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE caracteristique_caracteristique_voiture ADD CONSTRAINT FK_E48BD0C51704EEB7 FOREIGN KEY (caracteristique_id) REFERENCES caracteristique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voiture_caracteristique_caracteristique DROP FOREIGN KEY FK_9EE10CAB10F60D5B');
        $this->addSql('ALTER TABLE voiture_caracteristique_caracteristique DROP FOREIGN KEY FK_9EE10CAB1704EEB7');
        $this->addSql('DROP TABLE voiture_caracteristique');
        $this->addSql('DROP TABLE voiture_caracteristique_caracteristique');
        $this->addSql('DROP INDEX IDX_79C5D62210F60D5B ON voiture_caracteristique_voiture');
        $this->addSql('DROP INDEX `PRIMARY` ON voiture_caracteristique_voiture');
        $this->addSql('ALTER TABLE voiture_caracteristique_voiture CHANGE voiture_caracteristique_id caracteristique_voiture_id INT NOT NULL');
        $this->addSql('ALTER TABLE voiture_caracteristique_voiture ADD CONSTRAINT FK_79C5D6226DA9EBC7 FOREIGN KEY (caracteristique_voiture_id) REFERENCES caracteristique_voiture (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_79C5D6226DA9EBC7 ON voiture_caracteristique_voiture (caracteristique_voiture_id)');
        $this->addSql('ALTER TABLE voiture_caracteristique_voiture ADD PRIMARY KEY (voiture_id, caracteristique_voiture_id)');
    }
}
