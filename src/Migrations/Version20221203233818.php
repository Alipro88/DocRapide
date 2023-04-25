<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221203233818 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE expertise DROP FOREIGN KEY FK_229ADF8B4F34D596');
        $this->addSql('DROP INDEX IDX_229ADF8B4F34D596 ON expertise');
        $this->addSql('ALTER TABLE expertise DROP ad_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE expertise ADD ad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE expertise ADD CONSTRAINT FK_229ADF8B4F34D596 FOREIGN KEY (ad_id) REFERENCES ad (id)');
        $this->addSql('CREATE INDEX IDX_229ADF8B4F34D596 ON expertise (ad_id)');
    }
}
