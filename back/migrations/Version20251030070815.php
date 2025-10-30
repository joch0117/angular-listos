<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251030070815 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE account_deletion (id UUID NOT NULL, user_id_id UUID DEFAULT NULL, requested_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, processed_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_55133B939D86650F ON account_deletion (user_id_id)');
        $this->addSql('COMMENT ON COLUMN account_deletion.requested_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN account_deletion.processed_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE board (id UUID NOT NULL, owner_id_id UUID NOT NULL, title VARCHAR(120) NOT NULL, type VARCHAR(255) NOT NULL, pasition INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_58562B478FDDAB70 ON board (owner_id_id)');
        $this->addSql('COMMENT ON COLUMN board.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN board.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN board.deleted_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE legal_consent (id UUID NOT NULL, user_id_id UUID DEFAULT NULL, scope VARCHAR(50) NOT NULL, version VARCHAR(20) NOT NULL, consented_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, ip_hash VARCHAR(128) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A429967E9D86650F ON legal_consent (user_id_id)');
        $this->addSql('COMMENT ON COLUMN legal_consent.consented_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE list_entity (id UUID NOT NULL, id_board_id UUID NOT NULL, title VARCHAR(120) NOT NULL, postion INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_97F88646B737BB10 ON list_entity (id_board_id)');
        $this->addSql('COMMENT ON COLUMN list_entity.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN list_entity.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN list_entity.deleted_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE task (id UUID NOT NULL, list_id_id UUID NOT NULL, created_by_id UUID NOT NULL, updated_by_id UUID DEFAULT NULL, title VARCHAR(120) NOT NULL, description TEXT NOT NULL, due_date DATE DEFAULT NULL, id_completed BOOLEAN NOT NULL, position INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_527EDB25A6D70A54 ON task (list_id_id)');
        $this->addSql('CREATE INDEX IDX_527EDB25B03A8386 ON task (created_by_id)');
        $this->addSql('CREATE INDEX IDX_527EDB25896DBBDE ON task (updated_by_id)');
        $this->addSql('COMMENT ON COLUMN task.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN task.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN task.deleted_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "user" (id UUID NOT NULL, email VARCHAR(254) NOT NULL, password VARCHAR(255) NOT NULL, display_name VARCHAR(80) NOT NULL, role JSON NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, is_active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN "user".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "user".updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "user".deleted_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE account_deletion ADD CONSTRAINT FK_55133B939D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE board ADD CONSTRAINT FK_58562B478FDDAB70 FOREIGN KEY (owner_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE legal_consent ADD CONSTRAINT FK_A429967E9D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE list_entity ADD CONSTRAINT FK_97F88646B737BB10 FOREIGN KEY (id_board_id) REFERENCES board (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25A6D70A54 FOREIGN KEY (list_id_id) REFERENCES list_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25896DBBDE FOREIGN KEY (updated_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE account_deletion DROP CONSTRAINT FK_55133B939D86650F');
        $this->addSql('ALTER TABLE board DROP CONSTRAINT FK_58562B478FDDAB70');
        $this->addSql('ALTER TABLE legal_consent DROP CONSTRAINT FK_A429967E9D86650F');
        $this->addSql('ALTER TABLE list_entity DROP CONSTRAINT FK_97F88646B737BB10');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB25A6D70A54');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB25B03A8386');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT FK_527EDB25896DBBDE');
        $this->addSql('DROP TABLE account_deletion');
        $this->addSql('DROP TABLE board');
        $this->addSql('DROP TABLE legal_consent');
        $this->addSql('DROP TABLE list_entity');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE "user"');
    }
}
