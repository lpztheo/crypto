<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220711122213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE currency (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evolution ADD currency_id INT NOT NULL');
        $this->addSql('ALTER TABLE evolution ADD CONSTRAINT FK_420C289338248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('CREATE INDEX IDX_420C289338248176 ON evolution (currency_id)');
        $this->addSql('ALTER TABLE owned ADD currency_id INT NOT NULL');
        $this->addSql('ALTER TABLE owned ADD CONSTRAINT FK_3BB4532D38248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('CREATE INDEX IDX_3BB4532D38248176 ON owned (currency_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evolution DROP FOREIGN KEY FK_420C289338248176');
        $this->addSql('ALTER TABLE owned DROP FOREIGN KEY FK_3BB4532D38248176');
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP INDEX IDX_420C289338248176 ON evolution');
        $this->addSql('ALTER TABLE evolution DROP currency_id');
        $this->addSql('DROP INDEX IDX_3BB4532D38248176 ON owned');
        $this->addSql('ALTER TABLE owned DROP currency_id');
    }
}
