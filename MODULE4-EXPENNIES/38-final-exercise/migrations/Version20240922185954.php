<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240922185954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Generate random transactions';
    }

    public function up(Schema $schema): void
    {
        $totalTransactions = 1_000_000;
        $batchSize = 1000;  // Adjust this based on your needs

        for ($batchStart = 0; $batchStart < $totalTransactions; $batchStart += $batchSize) {
            for ($i = 0; $i < $batchSize && $batchStart + $i < $totalTransactions; $i++) {
                $description = 'Transaction ' . ($batchStart + $i) . ' Fake Two';
                $amount = rand(-100, 100);
                $categoryId = rand(1, 25);
                $date = date('Y-m-d H:i:s', strtotime('2024-' . rand(1, 12) . '-' . rand(1, 31) . ' ' . rand(0, 23) . ':' . rand(0, 59) . ':' . rand(0, 59)));
                $userId = 2;
                $createdAt = date('Y-m-d H:i:s');
                $updatedAt = date('Y-m-d H:i:s');

                $sql = 'INSERT INTO transactions (description, amount, category_id, date, user_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)';
                $this->connection->executeQuery($sql, [$description, $amount, $categoryId, $date, $userId, $createdAt, $updatedAt]);

                // Optional: Clear the entity manager if you're using one, although not applicable here directly
            }
        }
    }

    public function down(Schema $schema): void
    {
        // This down() migration is auto-generated, please modify it to your needs
        // Consider removing the inserted transactions or truncating the table if needed
        $this->addSql('DELETE FROM transactions WHERE created_at >= :date', ['date' => date('Y-m-d H:i:s', strtotime('2024-01-01'))]);
    }
}
