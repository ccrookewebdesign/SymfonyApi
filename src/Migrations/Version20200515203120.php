<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200515203120 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ip (id INT AUTO_INCREMENT NOT NULL, subnet_id INT NOT NULL, ip VARCHAR(255) NOT NULL, address_tag VARCHAR(255) NOT NULL, INDEX IDX_A5E3B32DC9CF9478 (subnet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subnet (id INT AUTO_INCREMENT NOT NULL, subnet VARCHAR(255) NOT NULL, cidr INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ip ADD CONSTRAINT FK_A5E3B32DC9CF9478 FOREIGN KEY (subnet_id) REFERENCES subnet (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ip DROP FOREIGN KEY FK_A5E3B32DC9CF9478');
        $this->addSql('DROP TABLE ip');
        $this->addSql('DROP TABLE subnet');
    }
}
