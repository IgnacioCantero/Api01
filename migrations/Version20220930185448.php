<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220930185448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alergenos (id INT AUTO_INCREMENT NOT NULL, alergeno VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cantidades_platos_pedidos (id INT AUTO_INCREMENT NOT NULL, plato_id INT NOT NULL, pedido_id INT NOT NULL, cantidad INT NOT NULL, INDEX IDX_8C50A474B0DB09EF (plato_id), INDEX IDX_8C50A4744854653A (pedido_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorias (id INT AUTO_INCREMENT NOT NULL, categoria VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clientes (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, telefono INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE direcciones (id INT AUTO_INCREMENT NOT NULL, clientes_id INT NOT NULL, municipio_id INT NOT NULL, provincia_id INT NOT NULL, calle VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, puerta_piso_escalera VARCHAR(255) DEFAULT NULL, cod_postal INT NOT NULL, INDEX IDX_B0B0BECBFBC3AF09 (clientes_id), UNIQUE INDEX UNIQ_B0B0BECB58BC1BE0 (municipio_id), UNIQUE INDEX UNIQ_B0B0BECB4E7121AF (provincia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estados (id INT AUTO_INCREMENT NOT NULL, estado VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horarios (id INT AUTO_INCREMENT NOT NULL, restaurantes_id INT NOT NULL, dia INT NOT NULL, apertura TIME NOT NULL, cierre TIME NOT NULL, INDEX IDX_5433650AE849FC0F (restaurantes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pedidos (id INT AUTO_INCREMENT NOT NULL, clientes_id INT NOT NULL, direccion_id INT NOT NULL, estado_id INT NOT NULL, restaurante_id INT NOT NULL, total DOUBLE PRECISION NOT NULL, fecha_entrega DATETIME NOT NULL, INDEX IDX_6716CCAAFBC3AF09 (clientes_id), UNIQUE INDEX UNIQ_6716CCAAD0A7BD7 (direccion_id), UNIQUE INDEX UNIQ_6716CCAA9F5A440B (estado_id), INDEX IDX_6716CCAA38B81E49 (restaurante_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE platos (id INT AUTO_INCREMENT NOT NULL, restaurantes_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, imagen_url VARCHAR(255) DEFAULT NULL, precio DOUBLE PRECISION NOT NULL, INDEX IDX_1D29312AE849FC0F (restaurantes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE platos_alergenos (platos_id INT NOT NULL, alergenos_id INT NOT NULL, INDEX IDX_3762847BD77499C5 (platos_id), INDEX IDX_3762847BB1C19196 (alergenos_id), PRIMARY KEY(platos_id, alergenos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurantes (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, logo_url VARCHAR(255) DEFAULT NULL, imagen_url VARCHAR(255) DEFAULT NULL, descripcion VARCHAR(255) DEFAULT NULL, destacado TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurantes_categorias (restaurantes_id INT NOT NULL, categorias_id INT NOT NULL, INDEX IDX_BE475EDAE849FC0F (restaurantes_id), INDEX IDX_BE475EDA5792B277 (categorias_id), PRIMARY KEY(restaurantes_id, categorias_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cantidades_platos_pedidos ADD CONSTRAINT FK_8C50A474B0DB09EF FOREIGN KEY (plato_id) REFERENCES platos (id)');
        $this->addSql('ALTER TABLE cantidades_platos_pedidos ADD CONSTRAINT FK_8C50A4744854653A FOREIGN KEY (pedido_id) REFERENCES pedidos (id)');
        $this->addSql('ALTER TABLE direcciones ADD CONSTRAINT FK_B0B0BECBFBC3AF09 FOREIGN KEY (clientes_id) REFERENCES clientes (id)');
        $this->addSql('ALTER TABLE direcciones ADD CONSTRAINT FK_B0B0BECB58BC1BE0 FOREIGN KEY (municipio_id) REFERENCES municipios (id)');
        $this->addSql('ALTER TABLE direcciones ADD CONSTRAINT FK_B0B0BECB4E7121AF FOREIGN KEY (provincia_id) REFERENCES provincias (id)');
        $this->addSql('ALTER TABLE horarios ADD CONSTRAINT FK_5433650AE849FC0F FOREIGN KEY (restaurantes_id) REFERENCES restaurantes (id)');
        $this->addSql('ALTER TABLE pedidos ADD CONSTRAINT FK_6716CCAAFBC3AF09 FOREIGN KEY (clientes_id) REFERENCES clientes (id)');
        $this->addSql('ALTER TABLE pedidos ADD CONSTRAINT FK_6716CCAAD0A7BD7 FOREIGN KEY (direccion_id) REFERENCES direcciones (id)');
        $this->addSql('ALTER TABLE pedidos ADD CONSTRAINT FK_6716CCAA9F5A440B FOREIGN KEY (estado_id) REFERENCES estados (id)');
        $this->addSql('ALTER TABLE pedidos ADD CONSTRAINT FK_6716CCAA38B81E49 FOREIGN KEY (restaurante_id) REFERENCES restaurantes (id)');
        $this->addSql('ALTER TABLE platos ADD CONSTRAINT FK_1D29312AE849FC0F FOREIGN KEY (restaurantes_id) REFERENCES restaurantes (id)');
        $this->addSql('ALTER TABLE platos_alergenos ADD CONSTRAINT FK_3762847BD77499C5 FOREIGN KEY (platos_id) REFERENCES platos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE platos_alergenos ADD CONSTRAINT FK_3762847BB1C19196 FOREIGN KEY (alergenos_id) REFERENCES alergenos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE restaurantes_categorias ADD CONSTRAINT FK_BE475EDAE849FC0F FOREIGN KEY (restaurantes_id) REFERENCES restaurantes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE restaurantes_categorias ADD CONSTRAINT FK_BE475EDA5792B277 FOREIGN KEY (categorias_id) REFERENCES categorias (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cantidades_platos_pedidos DROP FOREIGN KEY FK_8C50A474B0DB09EF');
        $this->addSql('ALTER TABLE cantidades_platos_pedidos DROP FOREIGN KEY FK_8C50A4744854653A');
        $this->addSql('ALTER TABLE direcciones DROP FOREIGN KEY FK_B0B0BECBFBC3AF09');
        $this->addSql('ALTER TABLE direcciones DROP FOREIGN KEY FK_B0B0BECB58BC1BE0');
        $this->addSql('ALTER TABLE direcciones DROP FOREIGN KEY FK_B0B0BECB4E7121AF');
        $this->addSql('ALTER TABLE horarios DROP FOREIGN KEY FK_5433650AE849FC0F');
        $this->addSql('ALTER TABLE pedidos DROP FOREIGN KEY FK_6716CCAAFBC3AF09');
        $this->addSql('ALTER TABLE pedidos DROP FOREIGN KEY FK_6716CCAAD0A7BD7');
        $this->addSql('ALTER TABLE pedidos DROP FOREIGN KEY FK_6716CCAA9F5A440B');
        $this->addSql('ALTER TABLE pedidos DROP FOREIGN KEY FK_6716CCAA38B81E49');
        $this->addSql('ALTER TABLE platos DROP FOREIGN KEY FK_1D29312AE849FC0F');
        $this->addSql('ALTER TABLE platos_alergenos DROP FOREIGN KEY FK_3762847BD77499C5');
        $this->addSql('ALTER TABLE platos_alergenos DROP FOREIGN KEY FK_3762847BB1C19196');
        $this->addSql('ALTER TABLE restaurantes_categorias DROP FOREIGN KEY FK_BE475EDAE849FC0F');
        $this->addSql('ALTER TABLE restaurantes_categorias DROP FOREIGN KEY FK_BE475EDA5792B277');
        $this->addSql('DROP TABLE alergenos');
        $this->addSql('DROP TABLE cantidades_platos_pedidos');
        $this->addSql('DROP TABLE categorias');
        $this->addSql('DROP TABLE clientes');
        $this->addSql('DROP TABLE direcciones');
        $this->addSql('DROP TABLE estados');
        $this->addSql('DROP TABLE horarios');
        $this->addSql('DROP TABLE pedidos');
        $this->addSql('DROP TABLE platos');
        $this->addSql('DROP TABLE platos_alergenos');
        $this->addSql('DROP TABLE restaurantes');
        $this->addSql('DROP TABLE restaurantes_categorias');
    }
}
