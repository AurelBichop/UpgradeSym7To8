<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260622092330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add User';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__starship AS SELECT id, name, class, captain, status, arrived_at, slug, created_at, updated_at FROM starship');
        $this->addSql('DROP TABLE starship');
        $this->addSql('CREATE TABLE starship (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, class VARCHAR(255) NOT NULL, captain VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, arrived_at DATETIME NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO starship (id, name, class, captain, status, arrived_at, slug, created_at, updated_at) SELECT id, name, class, captain, status, arrived_at, slug, created_at, updated_at FROM __temp__starship');
        $this->addSql('DROP TABLE __temp__starship');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C414E64A989D9B62 ON starship (slug)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__starship_droid AS SELECT id, droid_id, starship_id, assigned_at FROM starship_droid');
        $this->addSql('DROP TABLE starship_droid');
        $this->addSql('CREATE TABLE starship_droid (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, droid_id INTEGER NOT NULL, starship_id INTEGER NOT NULL, assigned_at DATETIME NOT NULL, CONSTRAINT FK_1C7FBE88AB064EF FOREIGN KEY (droid_id) REFERENCES droid (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1C7FBE889B24DF5 FOREIGN KEY (starship_id) REFERENCES starship (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO starship_droid (id, droid_id, starship_id, assigned_at) SELECT id, droid_id, starship_id, assigned_at FROM __temp__starship_droid');
        $this->addSql('DROP TABLE __temp__starship_droid');
        $this->addSql('CREATE INDEX IDX_1C7FBE889B24DF5 ON starship_droid (starship_id)');
        $this->addSql('CREATE INDEX IDX_1C7FBE88AB064EF ON starship_droid (droid_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__starship AS SELECT id, name, class, captain, status, arrived_at, slug, created_at, updated_at FROM starship');
        $this->addSql('DROP TABLE starship');
        $this->addSql('CREATE TABLE starship (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, class VARCHAR(255) NOT NULL, captain VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, arrived_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO starship (id, name, class, captain, status, arrived_at, slug, created_at, updated_at) SELECT id, name, class, captain, status, arrived_at, slug, created_at, updated_at FROM __temp__starship');
        $this->addSql('DROP TABLE __temp__starship');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C414E64A989D9B62 ON starship (slug)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__starship_droid AS SELECT id, assigned_at, droid_id, starship_id FROM starship_droid');
        $this->addSql('DROP TABLE starship_droid');
        $this->addSql('CREATE TABLE starship_droid (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, assigned_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , droid_id INTEGER NOT NULL, starship_id INTEGER NOT NULL, CONSTRAINT FK_1C7FBE88AB064EF FOREIGN KEY (droid_id) REFERENCES droid (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1C7FBE889B24DF5 FOREIGN KEY (starship_id) REFERENCES starship (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO starship_droid (id, assigned_at, droid_id, starship_id) SELECT id, assigned_at, droid_id, starship_id FROM __temp__starship_droid');
        $this->addSql('DROP TABLE __temp__starship_droid');
        $this->addSql('CREATE INDEX IDX_1C7FBE88AB064EF ON starship_droid (droid_id)');
        $this->addSql('CREATE INDEX IDX_1C7FBE889B24DF5 ON starship_droid (starship_id)');
    }
}
