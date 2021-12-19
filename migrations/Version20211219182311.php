<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211219182311 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE client_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE employee_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE employee_info_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE food_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE food_ingridients_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE food_order_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE hotel_info_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ingridients_order_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE position_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reservation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, name VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE employee (id INT NOT NULL, name VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE employee_info (id INT NOT NULL, employee_id INT DEFAULT NULL, hiring_date DATE NOT NULL, firing_date DATE DEFAULT NULL, salary DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7E507B108C03F15C ON employee_info (employee_id)');
        $this->addSql('CREATE TABLE food (id INT NOT NULL, name VARCHAR(255) NOT NULL, cost DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE food_food_order (food_id INT NOT NULL, food_order_id INT NOT NULL, PRIMARY KEY(food_id, food_order_id))');
        $this->addSql('CREATE INDEX IDX_630DE6D3BA8E87C4 ON food_food_order (food_id)');
        $this->addSql('CREATE INDEX IDX_630DE6D3A5D24A7A ON food_food_order (food_order_id)');
        $this->addSql('CREATE TABLE food_ingridients (id INT NOT NULL, name VARCHAR(255) NOT NULL, count INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE food_ingridients_food (food_ingridients_id INT NOT NULL, food_id INT NOT NULL, PRIMARY KEY(food_ingridients_id, food_id))');
        $this->addSql('CREATE INDEX IDX_C69E09147781628B ON food_ingridients_food (food_ingridients_id)');
        $this->addSql('CREATE INDEX IDX_C69E0914BA8E87C4 ON food_ingridients_food (food_id)');
        $this->addSql('CREATE TABLE food_order (id INT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE hotel_info (id INT NOT NULL, hotel_id INT DEFAULT NULL, cost DOUBLE PRECISION NOT NULL, number_class VARCHAR(255) NOT NULL, number_floor INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7C4CE7DF3243BB18 ON hotel_info (hotel_id)');
        $this->addSql('CREATE TABLE ingridients_order (id INT NOT NULL, date DATE NOT NULL, count INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE ingridients_order_food_ingridients (ingridients_order_id INT NOT NULL, food_ingridients_id INT NOT NULL, PRIMARY KEY(ingridients_order_id, food_ingridients_id))');
        $this->addSql('CREATE INDEX IDX_871245E65B6EB0B9 ON ingridients_order_food_ingridients (ingridients_order_id)');
        $this->addSql('CREATE INDEX IDX_871245E67781628B ON ingridients_order_food_ingridients (food_ingridients_id)');
        $this->addSql('CREATE TABLE position (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE position_employee (position_id INT NOT NULL, employee_id INT NOT NULL, PRIMARY KEY(position_id, employee_id))');
        $this->addSql('CREATE INDEX IDX_79B82716DD842E46 ON position_employee (position_id)');
        $this->addSql('CREATE INDEX IDX_79B827168C03F15C ON position_employee (employee_id)');
        $this->addSql('CREATE TABLE reservation (id INT NOT NULL, client_id INT DEFAULT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_42C8495519EB6921 ON reservation (client_id)');
        $this->addSql('CREATE TABLE reservation_hotel (reservation_id INT NOT NULL, hotel_id INT NOT NULL, PRIMARY KEY(reservation_id, hotel_id))');
        $this->addSql('CREATE INDEX IDX_402C8E7EB83297E7 ON reservation_hotel (reservation_id)');
        $this->addSql('CREATE INDEX IDX_402C8E7E3243BB18 ON reservation_hotel (hotel_id)');
        $this->addSql('ALTER TABLE employee_info ADD CONSTRAINT FK_7E507B108C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE food_food_order ADD CONSTRAINT FK_630DE6D3BA8E87C4 FOREIGN KEY (food_id) REFERENCES food (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE food_food_order ADD CONSTRAINT FK_630DE6D3A5D24A7A FOREIGN KEY (food_order_id) REFERENCES food_order (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE food_ingridients_food ADD CONSTRAINT FK_C69E09147781628B FOREIGN KEY (food_ingridients_id) REFERENCES food_ingridients (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE food_ingridients_food ADD CONSTRAINT FK_C69E0914BA8E87C4 FOREIGN KEY (food_id) REFERENCES food (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hotel_info ADD CONSTRAINT FK_7C4CE7DF3243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ingridients_order_food_ingridients ADD CONSTRAINT FK_871245E65B6EB0B9 FOREIGN KEY (ingridients_order_id) REFERENCES ingridients_order (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ingridients_order_food_ingridients ADD CONSTRAINT FK_871245E67781628B FOREIGN KEY (food_ingridients_id) REFERENCES food_ingridients (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE position_employee ADD CONSTRAINT FK_79B82716DD842E46 FOREIGN KEY (position_id) REFERENCES position (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE position_employee ADD CONSTRAINT FK_79B827168C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495519EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation_hotel ADD CONSTRAINT FK_402C8E7EB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation_hotel ADD CONSTRAINT FK_402C8E7E3243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hotel ADD employee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hotel ADD CONSTRAINT FK_3535ED98C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_3535ED98C03F15C ON hotel (employee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C8495519EB6921');
        $this->addSql('ALTER TABLE employee_info DROP CONSTRAINT FK_7E507B108C03F15C');
        $this->addSql('ALTER TABLE hotel DROP CONSTRAINT FK_3535ED98C03F15C');
        $this->addSql('ALTER TABLE position_employee DROP CONSTRAINT FK_79B827168C03F15C');
        $this->addSql('ALTER TABLE food_food_order DROP CONSTRAINT FK_630DE6D3BA8E87C4');
        $this->addSql('ALTER TABLE food_ingridients_food DROP CONSTRAINT FK_C69E0914BA8E87C4');
        $this->addSql('ALTER TABLE food_ingridients_food DROP CONSTRAINT FK_C69E09147781628B');
        $this->addSql('ALTER TABLE ingridients_order_food_ingridients DROP CONSTRAINT FK_871245E67781628B');
        $this->addSql('ALTER TABLE food_food_order DROP CONSTRAINT FK_630DE6D3A5D24A7A');
        $this->addSql('ALTER TABLE ingridients_order_food_ingridients DROP CONSTRAINT FK_871245E65B6EB0B9');
        $this->addSql('ALTER TABLE position_employee DROP CONSTRAINT FK_79B82716DD842E46');
        $this->addSql('ALTER TABLE reservation_hotel DROP CONSTRAINT FK_402C8E7EB83297E7');
        $this->addSql('DROP SEQUENCE client_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE employee_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE employee_info_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE food_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE food_ingridients_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE food_order_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE hotel_info_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ingridients_order_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE position_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reservation_id_seq CASCADE');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE employee_info');
        $this->addSql('DROP TABLE food');
        $this->addSql('DROP TABLE food_food_order');
        $this->addSql('DROP TABLE food_ingridients');
        $this->addSql('DROP TABLE food_ingridients_food');
        $this->addSql('DROP TABLE food_order');
        $this->addSql('DROP TABLE hotel_info');
        $this->addSql('DROP TABLE ingridients_order');
        $this->addSql('DROP TABLE ingridients_order_food_ingridients');
        $this->addSql('DROP TABLE position');
        $this->addSql('DROP TABLE position_employee');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reservation_hotel');
        $this->addSql('DROP INDEX IDX_3535ED98C03F15C');
        $this->addSql('ALTER TABLE hotel DROP employee_id');
    }
}
