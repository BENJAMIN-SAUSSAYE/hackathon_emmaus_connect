<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230629081240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE smartphone DROP FOREIGN KEY FK_26B07E2E8BEC65E1');
        $this->addSql('DROP INDEX IDX_26B07E2E8BEC65E1 ON smartphone');
        $this->addSql('ALTER TABLE smartphone DROP device_state_id, CHANGE estimate_at estimate_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE smartphone ADD device_state_id INT DEFAULT NULL, CHANGE estimate_at estimate_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE smartphone ADD CONSTRAINT FK_26B07E2E8BEC65E1 FOREIGN KEY (device_state_id) REFERENCES device_state (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_26B07E2E8BEC65E1 ON smartphone (device_state_id)');
    }
}
