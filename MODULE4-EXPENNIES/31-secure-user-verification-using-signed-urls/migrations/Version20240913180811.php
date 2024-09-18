<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240913180811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Generates a lot of dummy transaction data';
    }

    public function up(Schema $schema): void
    {
        // Generate random transactions
        $transactions = [];
        $values = [];
        $placeholders = [];

        for ($i = 0; $i < 1000; $i++) {
            $placeholders[] = '(?, ?, ?, ?, ?, ?, ?)';  // Added placeholders for created_at and updated_at
            $values[] = "Transaction $i";
            $values[] = rand(1, 100);
            $values[] = 3;  // Default category ID
            $values[] = date('Y-m-d H:i:s');  // date for the transaction
            $values[] = 1;  // Default user_id value
            $values[] = date('Y-m-d H:i:s');  // created_at timestamp
            $values[] = date('Y-m-d H:i:s');  // updated_at timestamp
        }

        $sql = 'INSERT INTO transactions (description, amount, category_id, date, user_id, created_at, updated_at) VALUES ' . implode(', ', $placeholders);

        $this->addSql($sql, $values);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
