<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180501131226 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE beacon DROP INDEX UNIQ_244829E7EB674C18, ADD INDEX IDX_244829E7EB674C18 (mappa_id)');
        $this->addSql('ALTER TABLE mappa CHANGE image image TINYTEXT DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE beacon DROP INDEX IDX_244829E7EB674C18, ADD UNIQUE INDEX UNIQ_244829E7EB674C18 (mappa_id)');
        $this->addSql('ALTER TABLE mappa CHANGE image image TINYTEXT NOT NULL COLLATE utf8_unicode_ci');
    }
}
