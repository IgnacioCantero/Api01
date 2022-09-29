<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220929195533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cantidades_platos_pedidos (id INT AUTO_INCREMENT NOT NULL, plato_id INT NOT NULL, pedido_id INT NOT NULL, cantidad INT NOT NULL, INDEX IDX_8C50A474B0DB09EF (plato_id), INDEX IDX_8C50A4744854653A (pedido_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cantidades_platos_pedidos ADD CONSTRAINT FK_8C50A474B0DB09EF FOREIGN KEY (plato_id) REFERENCES platos (id)');
        $this->addSql('ALTER TABLE cantidades_platos_pedidos ADD CONSTRAINT FK_8C50A4744854653A FOREIGN KEY (pedido_id) REFERENCES pedidos (id)');
        $this->addSql('ALTER TABLE pedidos DROP FOREIGN KEY FK_6716CCAAD77499C5');
        $this->addSql('DROP INDEX IDX_6716CCAAD77499C5 ON pedidos');
        $this->addSql('ALTER TABLE pedidos DROP platos_id, DROP cantidad');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cantidades_platos_pedidos DROP FOREIGN KEY FK_8C50A474B0DB09EF');
        $this->addSql('ALTER TABLE cantidades_platos_pedidos DROP FOREIGN KEY FK_8C50A4744854653A');
        $this->addSql('DROP TABLE cantidades_platos_pedidos');
        $this->addSql('ALTER TABLE pedidos ADD platos_id INT NOT NULL, ADD cantidad INT NOT NULL');
        $this->addSql('ALTER TABLE pedidos ADD CONSTRAINT FK_6716CCAAD77499C5 FOREIGN KEY (platos_id) REFERENCES platos (id)');
        $this->addSql('CREATE INDEX IDX_6716CCAAD77499C5 ON pedidos (platos_id)');
    }
}
