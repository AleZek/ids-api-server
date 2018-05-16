<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180514074251 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE arco (id INT AUTO_INCREMENT NOT NULL, begin_id INT DEFAULT NULL, end_id INT DEFAULT NULL, length DOUBLE PRECISION NOT NULL, width DOUBLE PRECISION NOT NULL, stairs TINYINT(1) NOT NULL, v DOUBLE PRECISION NOT NULL, i DOUBLE PRECISION NOT NULL, c DOUBLE PRECISION NOT NULL, los DOUBLE PRECISION NOT NULL, INDEX IDX_6676B7E9ED48AD21 (begin_id), INDEX IDX_6676B7E9E2BD8A10 (end_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE arco ADD CONSTRAINT FK_6676B7E9ED48AD21 FOREIGN KEY (begin_id) REFERENCES beacon (id)');
        $this->addSql('ALTER TABLE arco ADD CONSTRAINT FK_6676B7E9E2BD8A10 FOREIGN KEY (end_id) REFERENCES beacon (id)');
        $this->addSql('ALTER TABLE beacon ADD x DOUBLE PRECISION NOT NULL, ADD y DOUBLE PRECISION NOT NULL, ADD floor INT NOT NULL, DROP xinizio, DROP xfine, DROP yinizio, DROP yfine');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE arco');
        $this->addSql('ALTER TABLE beacon ADD xinizio DOUBLE PRECISION NOT NULL, ADD xfine DOUBLE PRECISION NOT NULL, ADD yinizio DOUBLE PRECISION NOT NULL, ADD yfine DOUBLE PRECISION NOT NULL, DROP x, DROP y, DROP floor');
    }
}
