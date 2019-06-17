<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190617093925 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, ordre INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, souscategory_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, prix INT NOT NULL, description LONGTEXT NOT NULL, image_name VARCHAR(255) NOT NULL, updated_at DATETIME DEFAULT NULL, solde TINYINT(1) DEFAULT NULL, valeursolde DOUBLE PRECISION NOT NULL, INDEX IDX_29A5EC2797753870 (souscategory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE souscategory (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, titre VARCHAR(255) NOT NULL, ordre INT NOT NULL, INDEX IDX_510D80F112469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, localite VARCHAR(255) DEFAULT NULL, compte DOUBLE PRECISION DEFAULT NULL, cat VARCHAR(2) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2797753870 FOREIGN KEY (souscategory_id) REFERENCES souscategory (id)');
        $this->addSql('ALTER TABLE souscategory ADD CONSTRAINT FK_510D80F112469DE2 FOREIGN KEY (category_id) REFERENCES categorie (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE souscategory DROP FOREIGN KEY FK_510D80F112469DE2');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2797753870');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE souscategory');
        $this->addSql('DROP TABLE user');
    }
}
