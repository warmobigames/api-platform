<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230930161322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer ADD description TEXT NOT NULL');
        $this->addSql('ALTER TABLE offer ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE offer ADD date_created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE offer ADD image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE offer ADD image_updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE offer ADD short_description VARCHAR(1024) DEFAULT NULL');
        $this->addSql('ALTER TABLE offer RENAME COLUMN name TO title');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        
        $this->addSql('ALTER TABLE offer ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE offer DROP title');
        $this->addSql('ALTER TABLE offer DROP description');
        $this->addSql('ALTER TABLE offer DROP slug');
        $this->addSql('ALTER TABLE offer DROP date_created');
        $this->addSql('ALTER TABLE offer DROP image');
        $this->addSql('ALTER TABLE offer DROP image_updated_at');
        $this->addSql('ALTER TABLE offer DROP short_description');
    }
}
