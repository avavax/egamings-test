<?php

class Helper {

    public static function addFromRequest($t) {
        if (isset($_POST['username'])
            && isset($_POST['type'])
            && isset($_POST['sum'])) {

            $name = htmlspecialchars($_POST['username']);
            $type = htmlspecialchars($_POST['type']);
            $sum = htmlspecialchars($_POST['sum']);

            $flash_msg = $t->addTransaction($name, $type, $sum) ?
                "Запись добавлена" : "Ошибка базы данных";
            $_SESSION['flash_msg'] = $flash_msg;
        }
    }
}