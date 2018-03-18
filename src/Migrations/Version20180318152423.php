<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180318152423 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE beacon ADD mappa_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE beacon ADD CONSTRAINT FK_244829E7EB674C18 FOREIGN KEY (mappa_id) REFERENCES mappa (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_244829E7EB674C18 ON beacon (mappa_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE beacon DROP FOREIGN KEY FK_244829E7EB674C18');
        $this->addSql('DROP INDEX UNIQ_244829E7EB674C18 ON beacon');
        $this->addSql('ALTER TABLE beacon DROP mappa_id');
    }
}
