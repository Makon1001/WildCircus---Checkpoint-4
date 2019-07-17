<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190716212530 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE spectacle_reservation (spectacle_id INT NOT NULL, reservation_id INT NOT NULL, INDEX IDX_84DCF49CC682915D (spectacle_id), INDEX IDX_84DCF49CB83297E7 (reservation_id), PRIMARY KEY(spectacle_id, reservation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE spectacle_reservation ADD CONSTRAINT FK_84DCF49CC682915D FOREIGN KEY (spectacle_id) REFERENCES spectacle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE spectacle_reservation ADD CONSTRAINT FK_84DCF49CB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE ville_spectacle');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ville_spectacle (ville_id INT NOT NULL, spectacle_id INT NOT NULL, INDEX IDX_22ABA19A73F0036 (ville_id), INDEX IDX_22ABA19C682915D (spectacle_id), PRIMARY KEY(ville_id, spectacle_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ville_spectacle ADD CONSTRAINT FK_22ABA19A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ville_spectacle ADD CONSTRAINT FK_22ABA19C682915D FOREIGN KEY (spectacle_id) REFERENCES spectacle (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE spectacle_reservation');
    }
}
