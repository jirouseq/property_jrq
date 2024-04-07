<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240406192439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE property (id INT AUTO_INCREMENT NOT NULL, transaction_type_id INT NOT NULL, type_id INT NOT NULL, condition_property_id INT NOT NULL, energy_id INT NOT NULL, attributes_id INT NOT NULL, near_by_id INT NOT NULL, status_id INT NOT NULL, region_id INT NOT NULL, client_id INT NOT NULL, ownership_id INT NOT NULL, num_rooms VARCHAR(255) DEFAULT NULL, area VARCHAR(255) DEFAULT NULL, price NUMERIC(11, 2) DEFAULT NULL, price_description VARCHAR(255) DEFAULT NULL, heading VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, ku VARCHAR(255) DEFAULT NULL, address LONGTEXT DEFAULT NULL, thumbnail VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, active TINYINT(1) NOT NULL, INDEX IDX_8BF21CDEB3E6B071 (transaction_type_id), INDEX IDX_8BF21CDEC54C8C93 (type_id), INDEX IDX_8BF21CDE6BD4C80C (condition_property_id), INDEX IDX_8BF21CDEEDDF52D (energy_id), INDEX IDX_8BF21CDEBAAF4009 (attributes_id), INDEX IDX_8BF21CDECCFB9442 (near_by_id), INDEX IDX_8BF21CDE6BF700BD (status_id), INDEX IDX_8BF21CDE98260155 (region_id), INDEX IDX_8BF21CDE19EB6921 (client_id), INDEX IDX_8BF21CDE9E9FFAA0 (ownership_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEB3E6B071 FOREIGN KEY (transaction_type_id) REFERENCES transaction_type (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE6BD4C80C FOREIGN KEY (condition_property_id) REFERENCES `condition` (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEEDDF52D FOREIGN KEY (energy_id) REFERENCES energy (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEBAAF4009 FOREIGN KEY (attributes_id) REFERENCES attributes (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDECCFB9442 FOREIGN KEY (near_by_id) REFERENCES near_by (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE98260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE9E9FFAA0 FOREIGN KEY (ownership_id) REFERENCES ownership (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEB3E6B071');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEC54C8C93');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE6BD4C80C');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEEDDF52D');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEBAAF4009');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDECCFB9442');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE6BF700BD');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE98260155');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE19EB6921');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE9E9FFAA0');
        $this->addSql('DROP TABLE property');
    }
}
