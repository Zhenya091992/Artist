<?php
include __DIR__ . '/functions/autoload.php';
$err = [];

if (!empty($_POST['login']) && !empty($_POST['password'])) {
    $admin = new \Models\Admin();
    if ($admin->signIn($_POST['login'], $_POST['password'])) {
        //если пользователь вошел, открываем сессию и записываем в нее случайне число.
        // так же это число записываем в базу данных что бы проверять осуществил ли пользователь вход.
        $random = rand(1000000, 10000000);
        if ($admin->openSession($_POST['login'], $random)) {
            $_SESSION['session'] = $random;
            $_SESSION['login'] = $_POST['login'];

            $viev = new \Viev();
            $viev->display(__DIR__ . '/templates/tempAdmin.html');
            die();
        } else {
            $err[] = 'error authorisation';
        }
    } else {
        $err[] = 'invalid username or password';
    }
}
$viev = new \Viev();
$viev->assign('err', $err);
$viev->display(__DIR__ . '/templates/tempSignIn.html');

