<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240407071426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE near_by_group (id INT AUTO_INCREMENT NOT NULL, property_id INT DEFAULT NULL, near_by_id INT DEFAULT NULL, INDEX IDX_3899224A549213EC (property_id), INDEX IDX_3899224ACCFB9442 (near_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE near_by_group ADD CONSTRAINT FK_3899224A549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE near_by_group ADD CONSTRAINT FK_3899224ACCFB9442 FOREIGN KEY (near_by_id) REFERENCES near_by (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE near_by_group DROP FOREIGN KEY FK_3899224A549213EC');
        $this->addSql('ALTER TABLE near_by_group DROP FOREIGN KEY FK_3899224ACCFB9442');
        $this->addSql('DROP TABLE near_by_group');
    }
}
