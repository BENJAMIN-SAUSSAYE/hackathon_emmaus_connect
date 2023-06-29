<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230629075532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE imei_device ADD screen_size INT NOT NULL, ADD year_manufacture INT NOT NULL, ADD network_speed VARCHAR(25) NOT NULL, ADD stockage_number INT NOT NULL, ADD ram_number INT NOT NULL');
        $this->addSql('ALTER TABLE model DROP screen_size, DROP year_manufacture, DROP network_speed, DROP stockage_number, DROP ram_number');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE model ADD screen_size INT NOT NULL, ADD year_manufacture INT NOT NULL, ADD network_speed VARCHAR(25) NOT NULL, ADD stockage_number INT NOT NULL, ADD ram_number INT NOT NULL');
        $this->addSql('ALTER TABLE imei_device DROP screen_size, DROP year_manufacture, DROP network_speed, DROP stockage_number, DROP ram_number');
    }
}
