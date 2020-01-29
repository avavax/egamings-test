<?php

error_reporting(E_ALL);

include 'transactions.php';

$t = new Transactions();
$list = $t->getSummary();

?>

<html>
<head>
    <title>Summary</title>
    <style type="text/css">
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <h2>Transactions module</h2>
    <table style='border-width: 1px;'>
        <tr><td>type</td><td>amount</td></tr>
        <?php
            foreach ($list as $result) {
                echo "<tr><td>{$result['type']}</td><td>{$result['amount']}</td></tr>";
            }
        ?>
    </table>

    <p><a href="index.php">Back</a></p>

</body>
</html>