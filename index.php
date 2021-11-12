<?php

include __DIR__ . '/functions/autoload.php';

if (isset($_GET['exit'])) {        //проверка на нажатие кнопки выход, для закрытия сессии
    unset($_SESSION['login']);
}

if (!empty($_POST['login']) && !empty($_POST['password'])) {
    $admin = new \Models\Admin();
    if ($admin->signIn($_POST['login'], $_POST['password'])) {
        //если пользователь вошел, открываем сессию
        $_SESSION['login'] = $_POST['login'];
        $viev = new \Viev();
        $viev->display(__DIR__ . '/adminAlbums.php');

    } else {
        $err = 'invalid username or password';
        goto viev;
    }
} else {
    $album = new \Models\Album();
    $albums = $album->getAll();

    $photo = new Models\Photo();
    $photos = $photo->getAll();
    viev:
    $viev = new \Viev();
    $viev->assign('album', $albums);
    $viev->assign('photo', $photos);
    $viev->assign('err', $err);
    $viev->display(__DIR__ . '/templates/tempIndex.php');
}
