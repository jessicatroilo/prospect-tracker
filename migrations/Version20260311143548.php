<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260311143548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prospect (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, entreprise VARCHAR(255) NOT NULL, phone NUMERIC(10, 0) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, potentiel NUMERIC(10, 0) DEFAULT NULL, notes VARCHAR(500) DEFAULT NULL, statuts_id INT DEFAULT NULL, INDEX IDX_C9CE8C7DE0EA5904 (statuts_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE statuts (id INT AUTO_INCREMENT NOT NULL, principal VARCHAR(255) NOT NULL, secondary VARCHAR(255) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE prospect ADD CONSTRAINT FK_C9CE8C7DE0EA5904 FOREIGN KEY (statuts_id) REFERENCES statuts (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prospect DROP FOREIGN KEY FK_C9CE8C7DE0EA5904');
        $this->addSql('DROP TABLE prospect');
        $this->addSql('DROP TABLE statuts');
    }
}
