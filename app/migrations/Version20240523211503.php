<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240523211503 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE crypto_rate (id INT AUTO_INCREMENT NOT NULL, coin VARCHAR(255) NOT NULL, currency VARCHAR(255) NOT NULL, rate DOUBLE PRECISION NOT NULL, date_time DATETIME NOT NULL, INDEX currency_date_time_idx (currency, date_time), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`'
        );
        $this->addSql(
            'CREATE TABLE currency (id INT AUTO_INCREMENT NOT NULL, ticker VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6956883F7EC30896 (ticker), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE crypto_rate');
        $this->addSql('DROP TABLE currency');
    }
}
