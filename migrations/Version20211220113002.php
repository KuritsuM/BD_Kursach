<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211220113002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hotel_food_order (hotel_id INT NOT NULL, food_order_id INT NOT NULL, PRIMARY KEY(hotel_id, food_order_id))');
        $this->addSql('CREATE INDEX IDX_719CBC9F3243BB18 ON hotel_food_order (hotel_id)');
        $this->addSql('CREATE INDEX IDX_719CBC9FA5D24A7A ON hotel_food_order (food_order_id)');
        $this->addSql('ALTER TABLE hotel_food_order ADD CONSTRAINT FK_719CBC9F3243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hotel_food_order ADD CONSTRAINT FK_719CBC9FA5D24A7A FOREIGN KEY (food_order_id) REFERENCES food_order (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE hotel_food_order');
    }
}
