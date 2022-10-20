<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221013001026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE direcciones DROP INDEX UNIQ_B0B0BECB58BC1BE0, ADD INDEX IDX_B0B0BECB58BC1BE0 (municipio_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE direcciones DROP INDEX IDX_B0B0BECB58BC1BE0, ADD UNIQUE INDEX UNIQ_B0B0BECB58BC1BE0 (municipio_id)');
    }
}
