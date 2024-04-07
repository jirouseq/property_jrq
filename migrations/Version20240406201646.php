<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240406201646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property ADD condition_property_id INT NOT NULL');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE6BD4C80C FOREIGN KEY (condition_property_id) REFERENCES condition_property (id)');
        $this->addSql('CREATE INDEX IDX_8BF21CDE6BD4C80C ON property (condition_property_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE6BD4C80C');
        $this->addSql('DROP INDEX IDX_8BF21CDE6BD4C80C ON property');
        $this->addSql('ALTER TABLE property DROP condition_property_id');
    }
}
