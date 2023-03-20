<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230320095833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etape DROP FOREIGN KEY FK_285F75DD873DBB5F');
        $this->addSql('ALTER TABLE etape ADD fin_aventure_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DDC3DCFBBF FOREIGN KEY (fin_aventure_id) REFERENCES aventure (id)');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DD873DBB5F FOREIGN KEY (aventure_id) REFERENCES aventure (id)');
        $this->addSql('CREATE INDEX IDX_285F75DDC3DCFBBF ON etape (fin_aventure_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etape DROP FOREIGN KEY FK_285F75DDC3DCFBBF');
        $this->addSql('ALTER TABLE etape DROP FOREIGN KEY FK_285F75DD873DBB5F');
        $this->addSql('DROP INDEX IDX_285F75DDC3DCFBBF ON etape');
        $this->addSql('ALTER TABLE etape DROP fin_aventure_id');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DD873DBB5F FOREIGN KEY (aventure_id) REFERENCES avatar (id)');
    }
}
