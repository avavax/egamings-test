<?php
session_start();
spl_autoload_register();
error_reporting(E_ALL);

$t = new Transactions();

// Flash message display
$flash_msg = $_SESSION['flash_msg'] ?? "";
if ($flash_msg) {
    unset($_SESSION['flash_msg']);
}

$count = $t->getCount();
$current = $_GET['current'] ?? 0;

if (isset($_GET['move']) && $_GET['move'] == "forward") {
    $current = $current < $count ? $current + 50 : $current;
}

if (isset($_GET['move']) && $_GET['move'] == "backward") {
    $current = $current > 0 ? $current - 50 : $current;
}

$list = $t->getList(50, $current);

?>

<html>
<head>
    <title>Main</title>
    <style type="text/css">
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class="container">
<h3><?=$flash_msg ?></h3>

<h2>Transactions module</h2>

    <p><a href="summary.php">Summary report</a></p>
    <p><a href="top.php">Top report</a></p>

    <div class="count"></div>

    <p>Transactions count: <?=$count ?></p>

    <table style='border-width: 1px;'>
    <tr><td>id</td><td>user</td><td>type</td><td>amount</td></tr>
    <?php
        foreach ($list as $transaction) {
            echo "<tr><td>{$transaction['id']}</td><td>{$transaction['user']}</td><td>{$transaction['type']}</td><td>{$transaction['amount']}</td></tr>";
        }
    ?>
    </table><br><br>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="/?current=0">Start</a></li>
            <li class="page-item"><a class="page-link" href="/?current=<?=$current ?>&move=backward">Previous</a></li>
            <li class="page-item"><a class="page-link" href="/?current=<?=round($count / 50) ?>"><?=round($count / 50); ?></a></li>
            <li class="page-item"><a class="page-link" href="/?current=<?=$current ?>&move=forward">Next</a></li>
            <li class="page-item"><a class="page-link" href="/?current=<?=$count ?>&move=backward">Finish</a></li>
        </ul>
    </nav>

    <h3>Add transaction</h3>
    <form action="create.php" method="POST">
        <div class="form-group">
            <label for="username">Name</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control" id="type" name="type">
                <option>withdraw</option>
                <option>win</option>
                <option>bet</option>
                <option>deposit</option>
            </select>
        </div>
        <div class="form-group">
            <label for="sum">Sum</label>
            <input type="number" class="form-control" id="sum" name="sum" required>
        </div>
        <input type="submit" name="добавить">
    </form>
</div>

</body>
</html>
