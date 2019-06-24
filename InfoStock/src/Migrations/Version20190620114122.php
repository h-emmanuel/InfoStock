<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190620114122 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_6EEAA67D19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE detail ADD commande_id INT NOT NULL, ADD produit_id INT NOT NULL, ADD qcom INT NOT NULL');
        $this->addSql('ALTER TABLE detail ADD CONSTRAINT FK_2E067F9382EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE detail ADD CONSTRAINT FK_2E067F93F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_2E067F9382EA2E54 ON detail (commande_id)');
        $this->addSql('CREATE INDEX IDX_2E067F93F347EFB ON detail (produit_id)');
        $this->addSql('ALTER TABLE panier ADD idproduit_id INT DEFAULT NULL, ADD session VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF2C29D63C1 FOREIGN KEY (idproduit_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_24CC0DF2C29D63C1 ON panier (idproduit_id)');
        $this->addSql('ALTER TABLE payement ADD numcarte INT NOT NULL, ADD dateexpiration DATETIME NOT NULL, ADD codesecurite INT NOT NULL, ADD adress VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE detail DROP FOREIGN KEY FK_2E067F9382EA2E54');
        $this->addSql('DROP TABLE commande');
        $this->addSql('ALTER TABLE detail DROP FOREIGN KEY FK_2E067F93F347EFB');
        $this->addSql('DROP INDEX IDX_2E067F9382EA2E54 ON detail');
        $this->addSql('DROP INDEX IDX_2E067F93F347EFB ON detail');
        $this->addSql('ALTER TABLE detail DROP commande_id, DROP produit_id, DROP qcom');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF2C29D63C1');
        $this->addSql('DROP INDEX IDX_24CC0DF2C29D63C1 ON panier');
        $this->addSql('ALTER TABLE panier DROP idproduit_id, DROP session');
        $this->addSql('ALTER TABLE payement DROP numcarte, DROP dateexpiration, DROP codesecurite, DROP adress');
    }
}
