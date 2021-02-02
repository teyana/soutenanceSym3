<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210202082730 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD blog_category_id INT DEFAULT NULL, ADD slug VARCHAR(255) NOT NULL, ADD resume LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66CB76011C FOREIGN KEY (blog_category_id) REFERENCES blog_category (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66CB76011C ON article (blog_category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66CB76011C');
        $this->addSql('DROP TABLE blog_category');
        $this->addSql('DROP INDEX IDX_23A0E66CB76011C ON article');
        $this->addSql('ALTER TABLE article DROP blog_category_id, DROP slug, DROP resume');
    }
}
