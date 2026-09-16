<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260916090925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tbl_author (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(50) DEFAULT NULL, name VARCHAR(50) NOT NULL, zip VARCHAR(10) DEFAULT NULL, town VARCHAR(50) DEFAULT NULL, country_id INT DEFAULT NULL, INDEX IDX_3009B177F92F3E70 (country_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE tbl_book (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, nbrpages INT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE book_author (book_id INT NOT NULL, author_id INT NOT NULL, INDEX IDX_9478D34516A2B381 (book_id), INDEX IDX_9478D345F675F31B (author_id), PRIMARY KEY (book_id, author_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE tbl_country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE tbl_author ADD CONSTRAINT FK_3009B177F92F3E70 FOREIGN KEY (country_id) REFERENCES tbl_country (id)');
        $this->addSql('ALTER TABLE book_author ADD CONSTRAINT FK_9478D34516A2B381 FOREIGN KEY (book_id) REFERENCES tbl_book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_author ADD CONSTRAINT FK_9478D345F675F31B FOREIGN KEY (author_id) REFERENCES tbl_author (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tbl_author DROP FOREIGN KEY FK_3009B177F92F3E70');
        $this->addSql('ALTER TABLE book_author DROP FOREIGN KEY FK_9478D34516A2B381');
        $this->addSql('ALTER TABLE book_author DROP FOREIGN KEY FK_9478D345F675F31B');
        $this->addSql('DROP TABLE tbl_author');
        $this->addSql('DROP TABLE tbl_book');
        $this->addSql('DROP TABLE book_author');
        $this->addSql('DROP TABLE tbl_country');
    }
}
