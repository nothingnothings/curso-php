<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240912181041 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Generates a lot of dummy category data (100)';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

        // Create first user, with id = 1:

        $this->addSql('INSERT INTO users (name, email, password, created_at, updated_at) VALUES (:name, :email, :password, :created_at, :updated_at)', [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => 'dummy',
            'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
            'updated_at' => (new \DateTime())->format('Y-m-d H:i:s'),
        ]);

        $insertAmount = 200;

        for ($i = 0; $i < $insertAmount; $i++) {
            // set created_at as a little bit earlier than now, for each category.:

            $createdAtEarly = (new \DateTime())->modify('-' . rand(1, 10) . ' days');
            $this->addSql('INSERT INTO categories (name, user_id, created_at, updated_at) VALUES (:name, :user_id, :created_at, :updated_at)', [
                'name' => 'Category ' . $i,
                'user_id' => 1,
                'created_at' => $createdAtEarly->format('Y-m-d H:i:s'),
                'updated_at' => (new \DateTime())->format('Y-m-d H:i:s'),
            ]);
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
