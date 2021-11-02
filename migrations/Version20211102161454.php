<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211102161454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, promo_id INT DEFAULT NULL, nom_prod VARCHAR(255) NOT NULL, desc_prod LONGTEXT NOT NULL, prix_ht INT NOT NULL, prix_ttc INT NOT NULL, etat VARCHAR(255) NOT NULL, produit_img VARCHAR(255) NOT NULL, INDEX IDX_BE2DDF8CBCF5E72D (categorie_id), INDEX IDX_BE2DDF8CD0C07AFF (promo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promo (id INT AUTO_INCREMENT NOT NULL, produits_id INT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, desc_promo LONGTEXT NOT NULL, prix_promo INT NOT NULL, INDEX IDX_B0139AFBCD11A2CF (produits_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, phone INT NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8CD0C07AFF FOREIGN KEY (promo_id) REFERENCES promo (id)');
        $this->addSql('ALTER TABLE promo ADD CONSTRAINT FK_B0139AFBCD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8CBCF5E72D');
        $this->addSql('ALTER TABLE promo DROP FOREIGN KEY FK_B0139AFBCD11A2CF');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8CD0C07AFF');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP TABLE promo');
        $this->addSql('DROP TABLE user');
    }
}