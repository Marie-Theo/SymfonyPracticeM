<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260922084108 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tbl_image (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE image_credit (image_id INT NOT NULL, credit_id INT NOT NULL, INDEX IDX_B3DC30363DA5256D (image_id), INDEX IDX_B3DC3036CE062FF9 (credit_id), PRIMARY KEY (image_id, credit_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE image_credit ADD CONSTRAINT FK_B3DC30363DA5256D FOREIGN KEY (image_id) REFERENCES tbl_image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_credit ADD CONSTRAINT FK_B3DC3036CE062FF9 FOREIGN KEY (credit_id) REFERENCES tbl_credit (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_credit DROP FOREIGN KEY FK_B3DC30363DA5256D');
        $this->addSql('ALTER TABLE image_credit DROP FOREIGN KEY FK_B3DC3036CE062FF9');
        $this->addSql('DROP TABLE tbl_image');
        $this->addSql('DROP TABLE image_credit');
    }
}
