<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230628154746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE smartphone (id INT AUTO_INCREMENT NOT NULL, imei_number VARCHAR(255) DEFAULT NULL, ram_number INT NOT NULL, stockage_number INT NOT NULL, screen_size INT DEFAULT NULL, network_speed VARCHAR(25) DEFAULT NULL, year_manufacture INT DEFAULT NULL, base_price NUMERIC(5, 2) NOT NULL, device_picture_path VARCHAR(255) DEFAULT NULL, rate_co2 DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE smartphone');
    }
}
