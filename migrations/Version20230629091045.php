<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230629091045 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE imei_device CHANGE screen_size screen_size INT DEFAULT NULL, CHANGE year_manufacture year_manufacture INT DEFAULT NULL, CHANGE network_speed network_speed VARCHAR(25) DEFAULT NULL, CHANGE stockage_number stockage_number INT DEFAULT NULL, CHANGE ram_number ram_number INT DEFAULT NULL');
        $this->addSql('ALTER TABLE smartphone CHANGE estimate_at estimate_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE smartphone CHANGE estimate_at estimate_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE imei_device CHANGE screen_size screen_size INT NOT NULL, CHANGE year_manufacture year_manufacture INT NOT NULL, CHANGE network_speed network_speed VARCHAR(25) NOT NULL, CHANGE stockage_number stockage_number INT NOT NULL, CHANGE ram_number ram_number INT NOT NULL');
    }
}
