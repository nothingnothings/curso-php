<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240828190734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // This up() will create the users table, with the following columns:
        $users = $schema->createTable('users');

        $users->addColumn('id', Types::INTEGER, ['autoincrement' => true]);
        $users->addColumn('user_name', Types::STRING);
        $users->addColumn('created_at', Types::DATETIME_MUTABLE);
        $users->setPrimaryKey(['id']);
    }

    public function down(Schema $schema): void
    {
        // In the 'down()' method, we revert everything that we did in the 'up()' method:
        $schema->dropTable('users');
    }
}
