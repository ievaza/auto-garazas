<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210130114001 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE trucks ADD CONSTRAINT FK_FB16EAE69A67DB00 FOREIGN KEY (mechanic_id) REFERENCES mechanics (id)');
        $this->addSql('CREATE INDEX IDX_FB16EAE69A67DB00 ON trucks (mechanic_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE trucks DROP FOREIGN KEY FK_FB16EAE69A67DB00');
        $this->addSql('DROP INDEX IDX_FB16EAE69A67DB00 ON trucks');
    }
}
