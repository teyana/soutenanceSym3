<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210201185038 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD blog_category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66CB76011C FOREIGN KEY (blog_category_id) REFERENCES blog_category (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66CB76011C ON article (blog_category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66CB76011C');
        $this->addSql('DROP INDEX IDX_23A0E66CB76011C ON article');
        $this->addSql('ALTER TABLE article DROP blog_category_id');
    }
}
