<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210716190436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits CHANGE promo_id promo_id INT NOT NULL');
        $this->addSql('ALTER TABLE promo ADD produits_id INT NOT NULL');
        $this->addSql('ALTER TABLE promo ADD CONSTRAINT FK_B0139AFBCD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id)');
        $this->addSql('CREATE INDEX IDX_B0139AFBCD11A2CF ON promo (produits_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits CHANGE promo_id promo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE promo DROP FOREIGN KEY FK_B0139AFBCD11A2CF');
        $this->addSql('DROP INDEX IDX_B0139AFBCD11A2CF ON promo');
        $this->addSql('ALTER TABLE promo DROP produits_id');
    }
}
