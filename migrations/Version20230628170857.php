<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230628170857 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE imei_device ADD model_id INT NOT NULL');
        $this->addSql('ALTER TABLE imei_device ADD CONSTRAINT FK_D02767997975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('CREATE INDEX IDX_D02767997975B7E7 ON imei_device (model_id)');
        $this->addSql('ALTER TABLE model ADD brand_id INT NOT NULL');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D944F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('CREATE INDEX IDX_D79572D944F5D008 ON model (brand_id)');
        $this->addSql('ALTER TABLE smartphone ADD device_state_id INT DEFAULT NULL, ADD operator_id INT NOT NULL, ADD model_id INT NOT NULL');
        $this->addSql('ALTER TABLE smartphone ADD CONSTRAINT FK_26B07E2E8BEC65E1 FOREIGN KEY (device_state_id) REFERENCES device_state (id)');
        $this->addSql('ALTER TABLE smartphone ADD CONSTRAINT FK_26B07E2E584598A3 FOREIGN KEY (operator_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE smartphone ADD CONSTRAINT FK_26B07E2E7975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('CREATE INDEX IDX_26B07E2E8BEC65E1 ON smartphone (device_state_id)');
        $this->addSql('CREATE INDEX IDX_26B07E2E584598A3 ON smartphone (operator_id)');
        $this->addSql('CREATE INDEX IDX_26B07E2E7975B7E7 ON smartphone (model_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE smartphone DROP FOREIGN KEY FK_26B07E2E8BEC65E1');
        $this->addSql('ALTER TABLE smartphone DROP FOREIGN KEY FK_26B07E2E584598A3');
        $this->addSql('ALTER TABLE smartphone DROP FOREIGN KEY FK_26B07E2E7975B7E7');
        $this->addSql('DROP INDEX IDX_26B07E2E8BEC65E1 ON smartphone');
        $this->addSql('DROP INDEX IDX_26B07E2E584598A3 ON smartphone');
        $this->addSql('DROP INDEX IDX_26B07E2E7975B7E7 ON smartphone');
        $this->addSql('ALTER TABLE smartphone DROP device_state_id, DROP operator_id, DROP model_id');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D944F5D008');
        $this->addSql('DROP INDEX IDX_D79572D944F5D008 ON model');
        $this->addSql('ALTER TABLE model DROP brand_id');
        $this->addSql('ALTER TABLE imei_device DROP FOREIGN KEY FK_D02767997975B7E7');
        $this->addSql('DROP INDEX IDX_D02767997975B7E7 ON imei_device');
        $this->addSql('ALTER TABLE imei_device DROP model_id');
    }
}
