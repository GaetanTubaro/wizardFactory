<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220310105731 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adopters (id INT NOT NULL, mail VARCHAR(50) DEFAULT NULL, phone VARCHAR(15) DEFAULT NULL, city VARCHAR(50) DEFAULT NULL, department VARCHAR(50) DEFAULT NULL, first_name VARCHAR(50) DEFAULT NULL, surname VARCHAR(50) DEFAULT NULL, child INT DEFAULT NULL, got_animals TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE advertisements (id INT AUTO_INCREMENT NOT NULL, association_id INT NOT NULL, title VARCHAR(255) NOT NULL, creation_date DATE NOT NULL, modification_date DATE DEFAULT NULL, suppression_date DATE DEFAULT NULL, INDEX IDX_5C755F1EEFB9C8A5 (association_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE associations (id INT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dogs (id INT AUTO_INCREMENT NOT NULL, advertisement_id INT NOT NULL, name VARCHAR(30) NOT NULL, birth_date DATE NOT NULL, past LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, is_lof TINYINT(1) NOT NULL, other_animals TINYINT(1) NOT NULL, is_adopted TINYINT(1) NOT NULL, INDEX IDX_353BEEB3A1FBF71B (advertisement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dogs_species (dogs_id INT NOT NULL, species_id INT NOT NULL, INDEX IDX_DDDDDAF9D0AFB20A (dogs_id), INDEX IDX_DDDDDAF9B2A1D860 (species_id), PRIMARY KEY(dogs_id, species_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, request_id INT NOT NULL, description LONGTEXT NOT NULL, creation_date DATE NOT NULL, suppression_date DATE DEFAULT NULL, is_read TINYINT(1) NOT NULL, INDEX IDX_DB021E96427EB8A5 (request_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pictures (id INT AUTO_INCREMENT NOT NULL, dog_id INT NOT NULL, path VARCHAR(255) NOT NULL, INDEX IDX_8F7C2FC0634DFEB (dog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE requests (id INT AUTO_INCREMENT NOT NULL, adopter_id INT NOT NULL, dog_id INT NOT NULL, INDEX IDX_7B85D651A0D47673 (adopter_id), INDEX IDX_7B85D651634DFEB (dog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE species (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, creation_date DATE NOT NULL, supression_date DATE DEFAULT NULL, is_admin TINYINT(1) NOT NULL, discr VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adopters ADD CONSTRAINT FK_78AE4F08BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE advertisements ADD CONSTRAINT FK_5C755F1EEFB9C8A5 FOREIGN KEY (association_id) REFERENCES associations (id)');
        $this->addSql('ALTER TABLE associations ADD CONSTRAINT FK_8921C4B1BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dogs ADD CONSTRAINT FK_353BEEB3A1FBF71B FOREIGN KEY (advertisement_id) REFERENCES advertisements (id)');
        $this->addSql('ALTER TABLE dogs_species ADD CONSTRAINT FK_DDDDDAF9D0AFB20A FOREIGN KEY (dogs_id) REFERENCES dogs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dogs_species ADD CONSTRAINT FK_DDDDDAF9B2A1D860 FOREIGN KEY (species_id) REFERENCES species (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96427EB8A5 FOREIGN KEY (request_id) REFERENCES requests (id)');
        $this->addSql('ALTER TABLE pictures ADD CONSTRAINT FK_8F7C2FC0634DFEB FOREIGN KEY (dog_id) REFERENCES dogs (id)');
        $this->addSql('ALTER TABLE requests ADD CONSTRAINT FK_7B85D651A0D47673 FOREIGN KEY (adopter_id) REFERENCES adopters (id)');
        $this->addSql('ALTER TABLE requests ADD CONSTRAINT FK_7B85D651634DFEB FOREIGN KEY (dog_id) REFERENCES dogs (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE requests DROP FOREIGN KEY FK_7B85D651A0D47673');
        $this->addSql('ALTER TABLE dogs DROP FOREIGN KEY FK_353BEEB3A1FBF71B');
        $this->addSql('ALTER TABLE advertisements DROP FOREIGN KEY FK_5C755F1EEFB9C8A5');
        $this->addSql('ALTER TABLE dogs_species DROP FOREIGN KEY FK_DDDDDAF9D0AFB20A');
        $this->addSql('ALTER TABLE pictures DROP FOREIGN KEY FK_8F7C2FC0634DFEB');
        $this->addSql('ALTER TABLE requests DROP FOREIGN KEY FK_7B85D651634DFEB');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96427EB8A5');
        $this->addSql('ALTER TABLE dogs_species DROP FOREIGN KEY FK_DDDDDAF9B2A1D860');
        $this->addSql('ALTER TABLE adopters DROP FOREIGN KEY FK_78AE4F08BF396750');
        $this->addSql('ALTER TABLE associations DROP FOREIGN KEY FK_8921C4B1BF396750');
        $this->addSql('DROP TABLE adopters');
        $this->addSql('DROP TABLE advertisements');
        $this->addSql('DROP TABLE associations');
        $this->addSql('DROP TABLE dogs');
        $this->addSql('DROP TABLE dogs_species');
        $this->addSql('DROP TABLE messages');
        $this->addSql('DROP TABLE pictures');
        $this->addSql('DROP TABLE requests');
        $this->addSql('DROP TABLE species');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
