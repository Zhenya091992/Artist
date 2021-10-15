<?php
include __DIR__ . '/functions/autoload.php';
$err = [];

if (!empty($_POST['login']) && !empty($_POST['password'])) {
    $admin = new \Models\Admin();
    if ($admin->signIn($_POST['login'], $_POST['password'])) {
        //если пользователь вошел, открываем сессию
        $_SESSION['login'] = $_POST['login'];
        $viev = new \Viev();
        $viev->display(__DIR__ . '/templates/tempAdmin.html');
        die();
    } else {
        $err[] = 'invalid username or password';
    }
}
$viev = new \Viev();
$viev->assign('err', $err);
$viev->display(__DIR__ . '/templates/tempSignIn.html');
