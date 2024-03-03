<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240130162118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, mother_id INT DEFAULT NULL, father_id INT DEFAULT NULL, title_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, image VARCHAR(2000) NOT NULL, biography LONGTEXT NOT NULL, INDEX IDX_937AB034B78A354D (mother_id), INDEX IDX_937AB0342055B9A2 (father_id), INDEX IDX_937AB034A9F87BD (title_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_house (character_id INT NOT NULL, house_id INT NOT NULL, INDEX IDX_9916DEFF1136BE75 (character_id), INDEX IDX_9916DEFF6BB74515 (house_id), PRIMARY KEY(character_id, house_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE house (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', name VARCHAR(50) NOT NULL, image VARCHAR(2000) NOT NULL, colour VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE title (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034B78A354D FOREIGN KEY (mother_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0342055B9A2 FOREIGN KEY (father_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034A9F87BD FOREIGN KEY (title_id) REFERENCES title (id)');
        $this->addSql('ALTER TABLE character_house ADD CONSTRAINT FK_9916DEFF1136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_house ADD CONSTRAINT FK_9916DEFF6BB74515 FOREIGN KEY (house_id) REFERENCES house (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034B78A354D');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB0342055B9A2');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034A9F87BD');
        $this->addSql('ALTER TABLE character_house DROP FOREIGN KEY FK_9916DEFF1136BE75');
        $this->addSql('ALTER TABLE character_house DROP FOREIGN KEY FK_9916DEFF6BB74515');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE character_house');
        $this->addSql('DROP TABLE house');
        $this->addSql('DROP TABLE title');
    }
}
