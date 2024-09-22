<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240922041529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE IF NOT EXISTS password_resets (id INT UNSIGNED AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, is_active TINYINT(1) DEFAULT 1 NOT NULL, expiration DATETIME NOT NULL, token VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_9EDAFEA15F37A13B (token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS user_login_codes (id INT UNSIGNED AUTO_INCREMENT NOT NULL, user_id INT UNSIGNED DEFAULT NULL, code VARCHAR(6) NOT NULL, is_active TINYINT(1) NOT NULL, expiration DATETIME NOT NULL, INDEX IDX_4AC6CF4CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_login_codes DROP FOREIGN KEY FK_4AC6CF4CA76ED395');
        $this->addSql('DROP TABLE password_resets');
        $this->addSql('DROP TABLE user_login_codes');
        $this->addSql('ALTER TABLE users DROP verified_at');
        $this->addSql('ALTER TABLE transactions DROP was_reviewed');
        $this->addSql('ALTER TABLE receipts DROP media_type');
    }
}
