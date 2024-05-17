<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240517163434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE t_jobs_offers (id INT AUTO_INCREMENT NOT NULL, hash VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, location VARCHAR(255) DEFAULT NULL, `desc` LONGTEXT DEFAULT NULL, start_date VARCHAR(255) DEFAULT NULL, end_date VARCHAR(255) DEFAULT NULL, dept VARCHAR(255) DEFAULT NULL, position_count VARCHAR(255) DEFAULT NULL, file VARCHAR(255) DEFAULT NULL, published_at VARCHAR(255) DEFAULT NULL, tags VARCHAR(255) DEFAULT NULL, level VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, platform VARCHAR(255) DEFAULT NULL, created DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_published TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE t_jobs_offers');
    }
}
