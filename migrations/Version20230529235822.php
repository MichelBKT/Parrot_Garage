<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230529235822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voiture_caracteristique_caracteristique DROP FOREIGN KEY FK_9EE10CAB1704EEB7');
        $this->addSql('ALTER TABLE voiture_caracteristique_caracteristique DROP FOREIGN KEY FK_9EE10CAB10F60D5B');
        $this->addSql('ALTER TABLE voiture_caracteristique_voiture DROP FOREIGN KEY FK_79C5D62210F60D5B');
        $this->addSql('ALTER TABLE voiture_caracteristique_voiture DROP FOREIGN KEY FK_79C5D622181A8BA');
        $this->addSql('DROP TABLE voiture_caracteristique_caracteristique');
        $this->addSql('DROP TABLE voiture_caracteristique_voiture');
        $this->addSql('ALTER TABLE voiture_caracteristique MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON voiture_caracteristique');
        $this->addSql('ALTER TABLE voiture_caracteristique ADD voiture_id INT NOT NULL, ADD caracteristique_id INT NOT NULL, DROP id');
        $this->addSql('ALTER TABLE voiture_caracteristique ADD CONSTRAINT FK_12CE44C9181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
        $this->addSql('ALTER TABLE voiture_caracteristique ADD CONSTRAINT FK_12CE44C91704EEB7 FOREIGN KEY (caracteristique_id) REFERENCES caracteristique (id)');
        $this->addSql('CREATE INDEX IDX_12CE44C9181A8BA ON voiture_caracteristique (voiture_id)');
        $this->addSql('CREATE INDEX IDX_12CE44C91704EEB7 ON voiture_caracteristique (caracteristique_id)');
        $this->addSql('ALTER TABLE voiture_caracteristique ADD PRIMARY KEY (voiture_id, caracteristique_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE voiture_caracteristique_caracteristique (voiture_caracteristique_id INT NOT NULL, caracteristique_id INT NOT NULL, INDEX IDX_9EE10CAB1704EEB7 (caracteristique_id), INDEX IDX_9EE10CAB10F60D5B (voiture_caracteristique_id), PRIMARY KEY(voiture_caracteristique_id, caracteristique_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE voiture_caracteristique_voiture (voiture_id INT NOT NULL, voiture_caracteristique_id INT NOT NULL, INDEX IDX_79C5D622181A8BA (voiture_id), INDEX IDX_79C5D62210F60D5B (voiture_caracteristique_id), PRIMARY KEY(voiture_caracteristique_id, voiture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE voiture_caracteristique_caracteristique ADD CONSTRAINT FK_9EE10CAB1704EEB7 FOREIGN KEY (caracteristique_id) REFERENCES caracteristique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voiture_caracteristique_caracteristique ADD CONSTRAINT FK_9EE10CAB10F60D5B FOREIGN KEY (voiture_caracteristique_id) REFERENCES voiture_caracteristique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voiture_caracteristique_voiture ADD CONSTRAINT FK_79C5D62210F60D5B FOREIGN KEY (voiture_caracteristique_id) REFERENCES voiture_caracteristique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voiture_caracteristique_voiture ADD CONSTRAINT FK_79C5D622181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voiture_caracteristique DROP FOREIGN KEY FK_12CE44C9181A8BA');
        $this->addSql('ALTER TABLE voiture_caracteristique DROP FOREIGN KEY FK_12CE44C91704EEB7');
        $this->addSql('DROP INDEX IDX_12CE44C9181A8BA ON voiture_caracteristique');
        $this->addSql('DROP INDEX IDX_12CE44C91704EEB7 ON voiture_caracteristique');
        $this->addSql('ALTER TABLE voiture_caracteristique ADD id INT AUTO_INCREMENT NOT NULL, DROP voiture_id, DROP caracteristique_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
