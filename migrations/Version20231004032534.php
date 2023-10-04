<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231004032534 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE characteristic_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE characteristic_variant_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE offer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_characteristic_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE characteristic (id INT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE characteristic_category (characteristic_id INT NOT NULL, category_id INT NOT NULL, PRIMARY KEY(characteristic_id, category_id))');
        $this->addSql('CREATE INDEX IDX_976F01F9DEE9D12B ON characteristic_category (characteristic_id)');
        $this->addSql('CREATE INDEX IDX_976F01F912469DE2 ON characteristic_category (category_id)');
        $this->addSql('CREATE TABLE characteristic_variant (id INT NOT NULL, characteristic_id INT DEFAULT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B63710E3DEE9D12B ON characteristic_variant (characteristic_id)');
        $this->addSql('CREATE TABLE offer (id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, slug VARCHAR(255) NOT NULL, date_created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, image VARCHAR(255) DEFAULT NULL, image_updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, short_description VARCHAR(1024) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, price INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE product_category (product_id INT NOT NULL, category_id INT NOT NULL, PRIMARY KEY(product_id, category_id))');
        $this->addSql('CREATE INDEX IDX_CDFC73564584665A ON product_category (product_id)');
        $this->addSql('CREATE INDEX IDX_CDFC735612469DE2 ON product_category (category_id)');
        $this->addSql('CREATE TABLE product_characteristic (id INT NOT NULL, product_id INT NOT NULL, characteristic_id INT NOT NULL, value_object_id INT DEFAULT NULL, value_int INT DEFAULT NULL, value_decimal NUMERIC(10, 0) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_146D77C4584665A ON product_characteristic (product_id)');
        $this->addSql('CREATE INDEX IDX_146D77CDEE9D12B ON product_characteristic (characteristic_id)');
        $this->addSql('CREATE INDEX IDX_146D77C66BF539D ON product_characteristic (value_object_id)');
        $this->addSql('ALTER TABLE characteristic_category ADD CONSTRAINT FK_976F01F9DEE9D12B FOREIGN KEY (characteristic_id) REFERENCES characteristic (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE characteristic_category ADD CONSTRAINT FK_976F01F912469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE characteristic_variant ADD CONSTRAINT FK_B63710E3DEE9D12B FOREIGN KEY (characteristic_id) REFERENCES characteristic (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC73564584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_characteristic ADD CONSTRAINT FK_146D77C4584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_characteristic ADD CONSTRAINT FK_146D77CDEE9D12B FOREIGN KEY (characteristic_id) REFERENCES characteristic (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_characteristic ADD CONSTRAINT FK_146D77C66BF539D FOREIGN KEY (value_object_id) REFERENCES characteristic_variant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE characteristic_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE characteristic_variant_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE offer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_characteristic_id_seq CASCADE');
        $this->addSql('ALTER TABLE characteristic_category DROP CONSTRAINT FK_976F01F9DEE9D12B');
        $this->addSql('ALTER TABLE characteristic_category DROP CONSTRAINT FK_976F01F912469DE2');
        $this->addSql('ALTER TABLE characteristic_variant DROP CONSTRAINT FK_B63710E3DEE9D12B');
        $this->addSql('ALTER TABLE product_category DROP CONSTRAINT FK_CDFC73564584665A');
        $this->addSql('ALTER TABLE product_category DROP CONSTRAINT FK_CDFC735612469DE2');
        $this->addSql('ALTER TABLE product_characteristic DROP CONSTRAINT FK_146D77C4584665A');
        $this->addSql('ALTER TABLE product_characteristic DROP CONSTRAINT FK_146D77CDEE9D12B');
        $this->addSql('ALTER TABLE product_characteristic DROP CONSTRAINT FK_146D77C66BF539D');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE characteristic');
        $this->addSql('DROP TABLE characteristic_category');
        $this->addSql('DROP TABLE characteristic_variant');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE product_characteristic');
    }
}
