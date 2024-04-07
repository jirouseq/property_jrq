<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240407063340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attribute_enable (id INT AUTO_INCREMENT NOT NULL, property_id INT DEFAULT NULL, attributes_id INT DEFAULT NULL, INDEX IDX_D141E668549213EC (property_id), INDEX IDX_D141E668BAAF4009 (attributes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attribute_enable ADD CONSTRAINT FK_D141E668549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE attribute_enable ADD CONSTRAINT FK_D141E668BAAF4009 FOREIGN KEY (attributes_id) REFERENCES attributes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribute_enable DROP FOREIGN KEY FK_D141E668549213EC');
        $this->addSql('ALTER TABLE attribute_enable DROP FOREIGN KEY FK_D141E668BAAF4009');
        $this->addSql('DROP TABLE attribute_enable');
    }
}
