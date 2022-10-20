<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221014005644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurantes ADD municipio_id INT NOT NULL');
        $this->addSql('ALTER TABLE restaurantes ADD CONSTRAINT FK_3B381D7A58BC1BE0 FOREIGN KEY (municipio_id) REFERENCES municipios (id)');
        $this->addSql('CREATE INDEX IDX_3B381D7A58BC1BE0 ON restaurantes (municipio_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurantes DROP FOREIGN KEY FK_3B381D7A58BC1BE0');
        $this->addSql('DROP INDEX IDX_3B381D7A58BC1BE0 ON restaurantes');
        $this->addSql('ALTER TABLE restaurantes DROP municipio_id');
    }
}
