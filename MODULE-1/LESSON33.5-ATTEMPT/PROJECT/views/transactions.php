<!DOCTYPE html>
<html>

<head>
    <title>Transactions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        table tr th,
        table tr td {
            padding: 5px;
            border: 1px #eee solid;
        }

        tfoot tr th,
        tfoot tr td {
            font-size: 20px;
        }

        tfoot tr th {
            text-align: right;
        }

        .green {
            color: green;
        }

        .red {
            color: red;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Check #</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($transaction_data as $transaction) {
                echo "<tr>";
                echo "<td>" . formatDate($transaction[0]) . "</td>";
                echo "<td>" . $transaction[1] . "</td>";
                echo "<td>" . $transaction[2] . "</td>";
                echo "<td class='" . ((float) str_replace('$', '', $transaction[3]) > 0 ? 'green' : 'red') . "'>" . formatCurrency((float) str_replace('$', '', $transaction[3])) . "</td>";
                echo "</tr>";
            }

            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Income:</th>
                <td><?php
                echo formatCurrency(getTotalIncome($transaction_data));
                ?></td>
            </tr>
            <tr>
                <th colspan="3">Total Expense:</th>
                <td><?php
                echo formatCurrency(getTotalExpense($transaction_data));
                ?></td>
            </tr>
            <tr>
                <th colspan="3">Net Total:</th>
                <td><?php
                echo formatCurrency(getNetTotal($transaction_data));
                ?></td>
            </tr>
        </tfoot>
    </table>
</body>

</html>