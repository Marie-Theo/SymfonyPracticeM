<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261012122930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tbl_answer (id INT AUTO_INCREMENT NOT NULL, text LONGTEXT NOT NULL, is_correct TINYINT DEFAULT NULL, question_id INT NOT NULL, INDEX IDX_577B239A1E27F6BF (question_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE tbl_question (id INT AUTO_INCREMENT NOT NULL, text LONGTEXT NOT NULL, explication LONGTEXT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE tbl_answer ADD CONSTRAINT FK_577B239A1E27F6BF FOREIGN KEY (question_id) REFERENCES tbl_question (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tbl_answer DROP FOREIGN KEY FK_577B239A1E27F6BF');
        $this->addSql('DROP TABLE tbl_answer');
        $this->addSql('DROP TABLE tbl_question');
    }
}
