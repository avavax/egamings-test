<?php
session_start();
error_reporting(E_ALL);

include 'transactions.php';
include 'helper.php';

Helper::addFromRequest(new Transactions);

header("Location: index.php");