<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220308133445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adopters (id INT NOT NULL, mail VARCHAR(50) DEFAULT NULL, phone VARCHAR(15) DEFAULT NULL, city VARCHAR(50) DEFAULT NULL, department VARCHAR(50) DEFAULT NULL, first_name VARCHAR(50) DEFAULT NULL, surname VARCHAR(50) DEFAULT NULL, child INT DEFAULT NULL, got_animals TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE associations (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dogs_species (dogs_id INT NOT NULL, species_id INT NOT NULL, INDEX IDX_DDDDDAF9D0AFB20A (dogs_id), INDEX IDX_DDDDDAF9B2A1D860 (species_id), PRIMARY KEY(dogs_id, species_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, creation_date DATE NOT NULL, supression_date DATE DEFAULT NULL, is_admin TINYINT(1) NOT NULL, discr VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adopters ADD CONSTRAINT FK_78AE4F08BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dogs_species ADD CONSTRAINT FK_DDDDDAF9D0AFB20A FOREIGN KEY (dogs_id) REFERENCES dogs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dogs_species ADD CONSTRAINT FK_DDDDDAF9B2A1D860 FOREIGN KEY (species_id) REFERENCES species (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE users');
        $this->addSql('ALTER TABLE advertisements ADD association_id INT NOT NULL');
        $this->addSql('ALTER TABLE advertisements ADD CONSTRAINT FK_5C755F1EEFB9C8A5 FOREIGN KEY (association_id) REFERENCES associations (id)');
        $this->addSql('CREATE INDEX IDX_5C755F1EEFB9C8A5 ON advertisements (association_id)');
        $this->addSql('ALTER TABLE dogs ADD advertisement_id INT NOT NULL');
        $this->addSql('ALTER TABLE dogs ADD CONSTRAINT FK_353BEEB3A1FBF71B FOREIGN KEY (advertisement_id) REFERENCES advertisements (id)');
        $this->addSql('CREATE INDEX IDX_353BEEB3A1FBF71B ON dogs (advertisement_id)');
        $this->addSql('ALTER TABLE messages ADD request_id INT NOT NULL');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96427EB8A5 FOREIGN KEY (request_id) REFERENCES requests (id)');
        $this->addSql('CREATE INDEX IDX_DB021E96427EB8A5 ON messages (request_id)');
        $this->addSql('ALTER TABLE pictures ADD id_dog_id INT NOT NULL');
        $this->addSql('ALTER TABLE pictures ADD CONSTRAINT FK_8F7C2FC020036A06 FOREIGN KEY (id_dog_id) REFERENCES dogs (id)');
        $this->addSql('CREATE INDEX IDX_8F7C2FC020036A06 ON pictures (id_dog_id)');
        $this->addSql('ALTER TABLE requests ADD id_adopter_id INT NOT NULL, ADD id_dog_id INT NOT NULL');
        $this->addSql('ALTER TABLE requests ADD CONSTRAINT FK_7B85D65155EF6A4 FOREIGN KEY (id_adopter_id) REFERENCES adopters (id)');
        $this->addSql('ALTER TABLE requests ADD CONSTRAINT FK_7B85D65120036A06 FOREIGN KEY (id_dog_id) REFERENCES dogs (id)');
        $this->addSql('CREATE INDEX IDX_7B85D65155EF6A4 ON requests (id_adopter_id)');
        $this->addSql('CREATE INDEX IDX_7B85D65120036A06 ON requests (id_dog_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE requests DROP FOREIGN KEY FK_7B85D65155EF6A4');
        $this->addSql('ALTER TABLE advertisements DROP FOREIGN KEY FK_5C755F1EEFB9C8A5');
        $this->addSql('ALTER TABLE adopters DROP FOREIGN KEY FK_78AE4F08BF396750');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, creation_date DATE NOT NULL, supression_date DATE DEFAULT NULL, is_admin TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE adopters');
        $this->addSql('DROP TABLE associations');
        $this->addSql('DROP TABLE dogs_species');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_5C755F1EEFB9C8A5 ON advertisements');
        $this->addSql('ALTER TABLE advertisements DROP association_id, CHANGE title title VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE dogs DROP FOREIGN KEY FK_353BEEB3A1FBF71B');
        $this->addSql('DROP INDEX IDX_353BEEB3A1FBF71B ON dogs');
        $this->addSql('ALTER TABLE dogs DROP advertisement_id, CHANGE name name VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE past past LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96427EB8A5');
        $this->addSql('DROP INDEX IDX_DB021E96427EB8A5 ON messages');
        $this->addSql('ALTER TABLE messages DROP request_id, CHANGE description description LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE headers headers LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE queue_name queue_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE pictures DROP FOREIGN KEY FK_8F7C2FC020036A06');
        $this->addSql('DROP INDEX IDX_8F7C2FC020036A06 ON pictures');
        $this->addSql('ALTER TABLE pictures DROP id_dog_id, CHANGE path path VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE requests DROP FOREIGN KEY FK_7B85D65120036A06');
        $this->addSql('DROP INDEX IDX_7B85D65155EF6A4 ON requests');
        $this->addSql('DROP INDEX IDX_7B85D65120036A06 ON requests');
        $this->addSql('ALTER TABLE requests DROP id_adopter_id, DROP id_dog_id');
        $this->addSql('ALTER TABLE species CHANGE name name VARCHAR(25) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
