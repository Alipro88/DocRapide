<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221205223140 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE expertise_ad');
        $this->addSql('ALTER TABLE expertise ADD ad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE expertise ADD CONSTRAINT FK_229ADF8B4F34D596 FOREIGN KEY (ad_id) REFERENCES ad (id)');
        $this->addSql('CREATE INDEX IDX_229ADF8B4F34D596 ON expertise (ad_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE expertise_ad (expertise_id INT NOT NULL, ad_id INT NOT NULL, INDEX IDX_558218F19D5B92F9 (expertise_id), INDEX IDX_558218F14F34D596 (ad_id), PRIMARY KEY(expertise_id, ad_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE expertise_ad ADD CONSTRAINT FK_558218F14F34D596 FOREIGN KEY (ad_id) REFERENCES ad (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE expertise_ad ADD CONSTRAINT FK_558218F19D5B92F9 FOREIGN KEY (expertise_id) REFERENCES expertise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE expertise DROP FOREIGN KEY FK_229ADF8B4F34D596');
        $this->addSql('DROP INDEX IDX_229ADF8B4F34D596 ON expertise');
        $this->addSql('ALTER TABLE expertise DROP ad_id');
    }
}
